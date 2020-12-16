<?php
namespace App\Importe\Dao;

class ImmoDao extends BaseDao {
    // public $db;

    // public function __construct(\PDO $db) {
    //     $this->db = $db;
    // }

    public function getImmoByObjectHash(iterable $values) {
        $sql = 'SELECT * FROM immo WHERE objecthash = ?';
        return $this->doQuery($sql, $values);
    }

    public function getImmoByObjectNr(iterable $values) {
        $sql = 'SELECT * FROM immo WHERE objectnr = ?';
        return $this->doQuery($sql, $values);
    }

    public function insertImmo(iterable $values){
        $sql = 'INSERT INTO immo (objectnr, objecthash, todo, ort) VALUES (?, ?, ?, ?)';
        return $this->doSQL($sql, $values);
    }

    public function updateLog(iterable $values){
        $sql = 'UPDATE logging SET titel=?, content=? WHERE id=?';
        return $this->doSQL($sql, $values);
    }

    // public function doQuery($query, $values){
    //     $stmt = $this->db->prepare($query);
    //     if(!$stmt->execute($values))
    //         return false;
    //     return $stmt->fetchAll();
    // }

    // public function doSQL($query, $values){
    //     $stmt = $this->db->prepare($query);
    //     //echo $this->db->lastInsertId(). "\n";
    //     return $stmt->execute($values);
    // }
}
