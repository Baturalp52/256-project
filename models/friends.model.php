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
    public function create($inviter_id, $invited_id, $status)
    {
        $sql = "INSERT INTO friends (inviter_id, invited_id, status) values (?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$inviter_id, $invited_id, $status]);
        return $this->db->lastInsertId();
    }
    public function findstatus($inviter_id, $invited_id)
    {
        $sql = "SELECT * FROM friends WHERE inviter_id IN ($inviter_id,$invited_id) AND invited_id IN ($inviter_id,$invited_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $fship = $stmt->fetch(PDO::FETCH_ASSOC);

        return $fship["status"];
    }
}
?>