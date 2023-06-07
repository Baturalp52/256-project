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

    public function findOne($id, $user_id = 0)
    {
        $query = "SELECT p.*, u.picture as \"user.picture\", u.name as \"user.name\",
        u.last_name as \"user.last_name\"
          FROM posts p 
        JOIN users u ON p.user_id = u.id
        WHERE p.id = $id";

        if ($user_id) {
            $query = "SELECT p.*, u.picture as \"user.picture\", u.name as \"user.name\",
        u.last_name as \"user.last_name\",
        EXISTS(SELECT * FROM post_likes WHERE post_id = $id AND user_id = $user_id) \"is_liked\"
          FROM posts p 
        JOIN users u ON p.user_id = u.id
        WHERE p.id = $id";
        }

        $stmt = $this->db->prepare($query);
        $post = $stmt->execute();
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
    public function getUserPosts($user_id)
    {
        $query = "SELECT *, EXISTS(SELECT * FROM post_likes WHERE post_id = p.id AND user_id = $user_id) \"is_liked\" FROM posts p WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$user_id]);
        $postsArr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $postsArr;
    }
    public function checkUserOwnPost($user_id, $post_id)
    {
        $query = "SELECT id FROM posts WHERE user_id = ? AND id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$user_id, $post_id]);
        $rowCount = $stmt->fetchColumn();
        if ($rowCount > 0)
            return true;
        return false;
    }
}
?>