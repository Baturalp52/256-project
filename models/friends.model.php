<?php

class FriendsModel
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function findOne($id)
    {
        $sql = "SELECT * FROM friends WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function delete($id)
    {
        $success = $this->db->query("DELETE FROM friends WHERE id = $id");
        return $success;
    }
    public function create($inviter_id, $invited_id)
    {
        $sql = "INSERT INTO friends (inviter_id, invited_id) values (?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$inviter_id, $invited_id]);
        return $this->db->lastInsertId();
    }
    public function update($inviter_id, $invited_id, $status)
    {
        $sql = "UPDATE friends SET status = ? WHERE inviter_id IN ($inviter_id,$invited_id) AND invited_id IN ($inviter_id,$invited_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$status]);
        return $this->db->lastInsertId();
    }
    public function findstatus($inviter_id, $invited_id)
    {
        $sql = "SELECT * FROM friends WHERE inviter_id IN ($inviter_id,$invited_id) AND invited_id IN ($inviter_id,$invited_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $fship = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fship)
            return $fship["status"];
        return -1;
    }
    public function findRequests($user_id)
    {
        $sql = "SELECT users.id \"users.id\",
        users.name \"users.name\", users.last_name \"users.last_name\",
        users.picture \"users.picture\"
        FROM friends f
        JOIN users ON users.id = f.inviter_id
        WHERE f.invited_id = ? AND f.status = 2 LIMIT 3";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>