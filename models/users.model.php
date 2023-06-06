<?php

class UsersModel
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function findOne($id)
    {
        $find = $this->db->query("SELECT * FROM users WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
        return $find;
    }
    public function delete($id)
    {
        $success = $this->db->query("DELETE FROM users WHERE id = $id");
        return $success;
    }
    public function create($name, $last_name, $email, $password)
    {
        $sql = "INSERT INTO users (name,last_name, email, password) values (?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name, $last_name, $email, $password]);
    }

    public function checkUserAuth($email, $rawPass)
    {
        $stmt = $this->db->prepare("select * from users where email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount()) {
            // email exists
            $user = $stmt->fetch();
            return password_verify($rawPass, $user["password"]);
        }
        return false;
    }
    public function checkUserExists($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount()) {
            // email already exists in the database
            return false;
        }

        return true;
    }

}
?>