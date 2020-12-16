<?php
namespace App\Importe\Service;

use App\Importe\Service\XmlParser;
use App\Importe\Service\DataImport;

class Importer
{
    public $parser;
    public $dim;

    function __construct(XmlParser $parser, DataImport $dim) {
        $this->parser = $parser;
        $this->dim = $dim;
    }

    function deleteDirectory($dirname)
    {
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);

        if (!$dir_handle)
            return false;

        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . "/" . $file))
                    unlink($dirname . "/" . $file);
                else
                    $this->deleteDirectory($dirname . '/' . $file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        echo "UnZipp-odner = $dirname deleted!!\n";
        return true;
    }


    function zipFileHandling($zipfile)
    {
        // unzip file
        $unzipdir = $this->unZip($zipfile);
        echo "=====================\n";
        echo "UnZipp-odner = $unzipdir\n";
        // handling the  unzip_dir
        $this->dirHandling($unzipdir);

        return $unzipdir;
    }

    function unZip($zipfile)
    {
        $unzipdir = preg_replace('/.zip/', '', $zipfile);

        $zip = new \ZipArchive;
        $res = $zip->open($zipfile);

        if ($res === TRUE) {
            $zip->extractTo($unzipdir);
            $zip->close();
            return $unzipdir;
        }

        return '';
    }

    // function backUp($path, $file)
    // {
    //     $dir = preg_replace('/\/ftp\//', '', $path);

    //     //$target = '/ftp/archiv/' . $dir;
    //     $target = 'C:/PHPtest/HONG/test1/ftp/archiv/' . $dir;
    //     if (!is_dir($target)) {
    //         mkdir($target);
    //     }

    //     rename($path . '/' . $file, $target . '/' . $file);
    //     return 1;
    // }

    function getFiles($path)
    {
        return array_diff(scandir($path), array('..', '.'));
    }

    function dirHandling($path, $root = false)
    {
        // handling all firm-directory
        $files = $this->getFiles($path); //array of names
        //if(count($files)==0)
        //return false;

        foreach ($files as $file) {

            //path to the file or dir
            $path2 = $path . '/' . $file;

            //handling dir if file is one dir
            if (is_dir($path2)) {
                $this->dirHandling($path2);
                //if ($root) { // archiv all under firm-dir
                //$this->backUp($path, $file);
                //}
            }

            // handling zip-file
            if (preg_match("/.zip/", $file)) {
                $zipfile = $path . '/' . $file;
                $unzipdir = $this->zipFileHandling($zipfile);
                $this->deleteDirectory($unzipdir);
                if ($root) { // archiv all under firm-dir
                    /// backUp($path, $file);
                }
            }

            // handling xml-file
            if (preg_match("/.xml/", $file)) {
                $xmlfile = $path . '/' . $file;
                $data = $this->parser->xmlParser($xmlfile);
                $this->dim->dataHandling($data, $path);
            }
        }
    }

}