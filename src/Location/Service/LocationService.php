<?php
namespace App\Location\Service;

use App\Location\Entity\Location;
use App\Location\Dao\LocationDao;

class LocationService
{
    public $dao;

    function __construct(LocationDao $dao) {
        $this->dao = $dao;  
    }

    function getLocationByName(String $ortName) {

        $locations = $this->dao->getLocationByName([
            'locName' => $ortName
        ]);
        if(count($locations)==1){
            return $locations[0];
        } else {
            return ["l_id" => "0"];
        }
    }

    // function insertLocation(Location $loc) {
    //     $this->dao->insertLocation([
    //         $loc->name,
    //         $loc->parentid,
    //         $loc->level
    //     ]);
    // }

    function insertLocation(iterable $location) {
        $status = $this->dao->insertLocation($location);
        return ["status" => (int)$status];
    }
}