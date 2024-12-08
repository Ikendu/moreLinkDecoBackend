<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $postId = $_GET['postId'];

    $postStmt = $conn->prepare("SELECT * FROM posts WHERE id = :id");
    $postStmt->bindParam(':id', $postId);
    $postStmt->execute();
    $post = $postStmt->fetch(PDO::FETCH_ASSOC);

    $likeStmt = $conn->prepare("SELECT type, COUNT(*) as count FROM likes WHERE post_id = :postId GROUP BY type");
    $likeStmt->bindParam(':postId', $postId);
    $likeStmt->execute();
    $likes = $likeStmt->fetchAll(PDO::FETCH_KEY_PAIR);

    echo json_encode(["post" => $post, "likes" => $likes]);
}
?>
