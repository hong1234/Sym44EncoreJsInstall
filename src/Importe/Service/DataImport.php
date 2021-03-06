<?php
namespace App\Importe\Service;

use App\Importe\Entity\XmlData;
use App\Importe\Dao\ImmoDao;
use App\Importe\Service\LocationSolution;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class DataImport
{
    public $locationSolution;
    public $dao;
    public $bilder;

    function __construct(LocationSolution $locationSolution, ImmoDao $dao, ContainerBagInterface $params) {
        $this->locationSolution = $locationSolution;
        $this->dao = $dao;
        $this->bilder = $params->get('image_depot');
    }

    function dataHandling(XmlData $data, String $path){
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
                
                if(count($this->dao->getImmoByObjectHash(['objecthash' => $immo->hashcode]))==0){

                    // import images
                    foreach ($immo->anhang as $ah){
                        echo "Image: $ah\n";
                        rename($path.'/'.$ah, $this->bilder.'/'.$ah);
                    }

                    // import object-data INSERT
                    $this->dao->insertImmo([
                        'objectnr' => $immo->objektnr, 
                        'objecthash' => $immo->hashcode, 
                        'todo' => $immo->action, 
                        'ort' => $immo->geo['ort']
                    ]);

                    // import object-data UPDATE

                    // location solution
                    $locationId = $this->locationSolution->setLocation($immo->geo['ort']);
                    echo "locationId-of-object: $locationId \n";
                }

                echo "-------------\n";
            }
        }
    }
}