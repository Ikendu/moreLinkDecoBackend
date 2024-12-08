<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $postId = $_GET['postId'];

    $stmt = $conn->prepare("
        SELECT c.id, c.comment, u.username 
        FROM comments c 
        JOIN users u ON c.user_id = u.id 
        WHERE c.post_id = :postId
        ORDER BY c.created_at DESC
    ");
    $stmt->bindParam(':postId', $postId);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["comments" => $comments]);
}
?>
