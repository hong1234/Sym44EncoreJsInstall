<?php
namespace App\Importe\Dao;

class Logg extends BaseDao {
    // public $db;

    // public function __construct(\PDO $db) {
    //     $this->db = $db;
    // }

    public function insertLogg(iterable $values){
        $sql = 'INSERT INTO logging (catid, titel, content) VALUES (?, ?, ?)';
        return $this->doSQL($sql, $values);
    }

    // public function updateLog(iterable $values){
    //     $query = 'UPDATE logging SET titel=?, content=? WHERE id=?';
    //     return $this->doSQL($query, $values);
    // }

    // public function doSQL($query, $values){
    //     $stmt = $this->db->prepare($query);
    //     return $stmt->execute($values);
    // }

}