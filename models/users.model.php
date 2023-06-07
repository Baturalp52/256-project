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
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
        return $this->db->lastInsertId();
    }

    public function update_User($userId, $name, $last_name, $email, $birthday, $bio)
    {
        $sql = "UPDATE users SET name=?, last_name=?, email=?, birth_date=?, bio=? WHERE id=?";

        // Assuming you have a database connection object stored in the variable $conn
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name, $last_name, $email, $birthday, $bio, $userId]);


        // Additional code if needed, such as error handling or success messages
    }


    public function searchUsers($text)
    {
        $sql = "SELECT * FROM users WHERE name LIKE ? OR last_name LIKE ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["%" . $text . "%", "%" . $text . "%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    public function findAllWithNoFriend($user_id)
    {
        $sql = "SELECT * FROM users u 
        LEFT JOIN friends f1 ON u.id = f1.inviter_id 
        LEFT JOIN friends f2 ON u.id = f2.invited_id
        WHERE NOT u.id = ?
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function checkUserAuth($email, $rawPass)
    {
        $stmt = $this->db->prepare("select * from users where email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount()) {
            // email exists
            $user = $stmt->fetch();
            if (password_verify($rawPass, $user["password"]))
                return $user;
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
    public function changePassword($id, $newPass)
    {
        $query = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $hashPassw = password_hash($newPass, PASSWORD_BCRYPT);
        $stmt->execute([$hashPassw, $id]);
        return true;
    }
}
?>