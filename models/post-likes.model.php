<?php

class PostLikesModel
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }


    public function toggleLike($post_id, $user_id)
    {
        $query = "SELECT * FROM post_likes WHERE post_id = $post_id AND user_id = $user_id";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $rowCount = $stmt->fetchColumn();

        if ($rowCount > 0) {
            $query = "DELETE FROM post_likes WHERE post_id = ? AND user_id = ?";
        } else {
            $query = "INSERT INTO post_likes (post_id, user_id) VALUES (?,?)";
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute([$post_id, $user_id]);
    }


}
?>