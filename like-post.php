<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/__init__.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["post_id"]) && $_SESSION["user_id"]) {
    $likeModel = new PostLikesModel($db);
    $likeModel->toggleLike($_POST["post_id"], $_SESSION["user_id"]);
    header("HTTP/1.1 200 OK");
    exit();
}


header("Location: /index.php");



?>