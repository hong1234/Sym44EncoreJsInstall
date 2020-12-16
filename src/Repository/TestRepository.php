<?php
namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
<<<<<<< HEAD
//use App\Entity\Result;
=======
use App\Entity\Result;
>>>>>>> 7e2956e489ab67741d3dfec0caf2ecfd0cd5e478


class TestRepository
{
    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function searchLocation2(String $searchkey)
    {   $conn = $this->manager->getConnection();

        $sql= 'SELECT l1.id as l_id, l1.name as l_name, l2.id as p_id, l2.name as p_name 
               FROM location as l1 LEFT JOIN location as l2 ON l1.parentid = l2.id
               WHERE l1.name LIKE :searchkey 
               UNION 
               SELECT l1.id as l_id, l1.name as l_name, l2.id as p_id, l2.name as p_name 
               FROM location as l1 LEFT JOIN location as l2 ON l1.parentid = l2.id 
               WHERE l1.parentid IN (SELECT l1.id FROM location as l1 WHERE l1.name LIKE :searchkey)';

         $stmt = $conn->prepare($sql);
         $stmt->execute([
             'searchkey' => '%'.$searchkey.'%',
             ]);
        
        // $sql = 'SELECT l1.id as l_id2, l1.name as l_name2 FROM location as l1 WHERE l1.name LIKE ?';
        // $stmt = $conn->prepare($sql);
        // $stmt->execute(['%'.$searchkey.'%']);

        return $stmt->fetchAllAssociative();//->fetchAll(); 
        //return $stmt->fetchAll(\PDO::FETCH_CLASS, Result::class);         
    }
<<<<<<< HEAD

    public function getObjectsOfLocation(Int $locationId)
    {   
        $conn = $this->manager->getConnection();
        $sql= 'SELECT id, objecthash FROM immo WHERE id IN (SELECT immo_id FROM immo_location WHERE location_id = :locationId)';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
                'locationId' => $locationId,
            ]);

        return $stmt->fetchAllAssociative();//->fetchAll(); 
        //return $stmt->fetchAll(\PDO::FETCH_CLASS, Result::class);         
    }

    public function getLocationByName(String $lname)
    {   
        $conn = $this->manager->getConnection();
        //$sql= 'SELECT * FROM location as l WHERE l.name LIKE :lName';
        $sql= 'SELECT * FROM location WHERE name = :lName';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
                'lName' => $lname,
            ]);
        //return $stmt->fetchAllAssociative();
        return ['yn'=>(String)count($stmt->fetchAllAssociative())];//->fetchAll(); 
        //return $stmt->fetchAll(\PDO::FETCH_CLASS, Result::class);         
    }

    
}
=======
}
>>>>>>> 7e2956e489ab67741d3dfec0caf2ecfd0cd5e478
