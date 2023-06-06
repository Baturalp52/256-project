<?php

class UsersModel{
    private $db;
    public function __construct($db){
    $this->db = $db;
    }
    public function findOne($id){
        $find = $this->db->query("SELECT * FROM users WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
        return $find;
    }
    public function delete($id){
        $success = $this->db->query("DELETE FROM users WHERE id = $id"); 
        return $success;
    }
    public function create($name, $last_name, $email, $birth_date, $picture, $password){
        $sql = "INSERT INTO users (name,last_name, email, birth_date, picture, password) values (?,?,?,?,?,?)" ;
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name, $last_name, $email, $birth_date, $picture, $password]);
    }
    
}
?>