<?php

namespace App\Repository;

use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
//use Doctrine\ORM\EntityManagerInterface;

class LocationRepository extends ServiceEntityRepository
{ 
    //private $manager;

    //public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    //{
    //    parent::__construct($registry, Location::class);
    //    $this->manager = $manager;
    //}

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Location::class);
    }

    public function addLocation(Location $location)
    {
	    $this->getEntityManager()->persist($location);
        $this->getEntityManager()->flush();
    }

    public function searchLocation(String $searchkey)
    {
        return $this->createQueryBuilder('l')
        ->leftJoin('l.parent', 'p')
        ->select('l.id as l_id')
        ->addSelect('l.name as l_name')
        ->addSelect('p.id as p_id')
        ->addSelect('p.name as p_name')
        ->where('l.name LIKE :searchkey')
        ->setParameter('searchkey', '%'.$searchkey.'%')
        ->orderBy('l.id', 'ASC')
        ->getQuery()
        ->getResult();      
    }

    public function searchLocation2(String $searchkey)
    {   
        $sql = 'SELECT l1.id as l_id, l1.name as l_name, l2.id as p_id, l2.name as p_name 
               FROM location as l1 LEFT JOIN location as l2 ON l1.parentid = l2.id
               WHERE l1.name LIKE :searchkey 
               UNION 
               SELECT l1.id as l_id, l1.name as l_name, l2.id as p_id, l2.name as p_name 
               FROM location as l1 LEFT JOIN location as l2 ON l1.parentid = l2.id 
               WHERE l1.parentid IN (SELECT l1.id FROM location as l1 WHERE l1.name LIKE :searchkey)';

        //$conn = $this->manager->getConnection();
        $conn = $this->getEntityManager()->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('searchkey' => '%'.$searchkey.'%'));
        return $stmt->fetchAllAssociative();//fetchAll();          
    }
}
