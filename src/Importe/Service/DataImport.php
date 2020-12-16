<?php
namespace App\Importe\Service;

use App\Importe\Entity\XmlData;
use App\Importe\Dao\ImmoDao;
//use App\Importe\Utils\Config;

class DataImport
{
    public $dao;
    public $bilder;
    //public $ipConfig;

    function __construct(ImmoDao $dao, String $bilder) {
        $this->dao = $dao;
        $this->bilder = $bilder;
        //$this->ipConfig = $config->get('win_import');
    }

    function dataHandling(XmlData $data, $path){
        //echo "=====================\n";
        //echo $path."\n";
        //echo "UnZipp-odner = $path \n";
        if($data->umfang == 'TEIL'){
            echo "Do Something \n";
            //foreach ($this->getFiles($path) as $file) {
            //    echo $file."\n";
            //}
            $az = 0;
            foreach ($data->immobilien as $immo){
                 $az++;
                 echo "Immo #$az\n";
                
                 foreach ($immo->anhang as $ah){
                    echo "Image: $ah\n";
                    rename($path.'/'.$ah, $this->bilder.'/'.$ah);
                 }
                 echo "-------------\n";
                 if(count($this->dao->getImmoByObjectHash([$immo->hashcode]))==0){
                     $this->dao->insertImmo([
                         $immo->objektnr, 
                         $immo->hashcode, 
                         $immo->action, 
                         $immo->ort
                     ]);
                }
            }
        }
    }
}