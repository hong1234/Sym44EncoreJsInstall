<?php
namespace App\Location\Service;

use App\Location\Entity\Location;
use App\Location\Dao\LocationDao;

class SearchService
{
    public $dao;
    
    function __construct(LocationDao $dao) {
        $this->dao = $dao;  
    }

    function searchLocationByName(String $searchkey) {
        return $this->dao->searchLocationByName([
            'searchkey' => '%'.$searchkey.'%'
        ]);
    }
}