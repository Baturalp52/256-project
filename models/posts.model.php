<?php

class PostsModel
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function deletePost($id)
    {
        $query = "DELETE FROM posts WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
    }
    public function addPost($user_id, $text, $image)
    {
        $query = "INSERT INTO posts (text, image, user_id) VALUES (?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$text, $image, $user_id]);
    }
    public function updatePost($id, $text, $image)
    {
        $query = "UPDATE posts SET text = ?, image = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$text, $image, $id]);
    }

    public function findOne($id)
    {
        $query = "SELECT * FROM posts WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $post = $stmt->execute([$id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        return $post;
    }

    public function findAll($user_id)
    {
        $query = "SELECT * FROM posts WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$user_id]);
        $postsArr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $postsArr;
    }
}
?>