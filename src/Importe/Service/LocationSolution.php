<?php
namespace App\Importe\Service;

use App\Importe\Service\LocationClient;

class LocationSolution
{
    public $locationClient;

    function __construct(LocationClient $locationClient) {
        $this->locationClient = $locationClient;
    }

    function setLocation(String $ortName) {
        $locationId = $this->locationClient->getLocationByName($ortName);
        if($locationId == 0){
            $rs = $this->locationClient->insertLocation([
                "name" => $ortName, 
                "parentid" => 1,
                "level" => 2
            ]);
            if($rs['status']==201)
                $locationId = (int)$rs['locationId']; 
        }
        return $locationId;
    }

}