<?php
namespace App\Location\Dao;

use Doctrine\ORM\EntityManagerInterface;
//use App\Location\Entity\Result;

class BaseDao {
    
    public $conn;

    public function __construct(EntityManagerInterface $manager) {
        $this->conn = $manager->getConnection();
    }

    public function doQuery($sql, $values){
        $stmt = $this->conn->prepare($sql);
        $rt = $stmt->execute($values);

        if(!$rt){
            //return false;
            throw new \Exception("Query faild!");
        }    
        
        //$objects = $stmt->fetchAll(\PDO::FETCH_CLASS, Result::class);
        //return $objects;
        return $stmt->fetchAllAssociative();
    }

    public function doSQL($sql, $values){
        $stmt = $this->conn->prepare($sql);
        //echo $this->db->lastInsertId(). "\n";
        $rt = $stmt->execute($values);
        if(!$rt){
            //return false;
            throw new \Exception("Insert faild!");
        } 
        //return $stmt->execute($values);
        //return true;
        return $rt;
    }

    public function showResult($objects){
        foreach ($objects as $object) {
            echo $object;
        }
    }

}