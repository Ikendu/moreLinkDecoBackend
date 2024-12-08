<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $postId = $data['postId'];
    $userId = $data['userId'];
    $comment = $data['comment'];

    $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (:postId, :userId, :comment)");
    $stmt->bindParam(':postId', $postId);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':comment', $comment);

    try {
        $stmt->execute();
        echo json_encode(["message" => "Comment added successfully"]);
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode(["error" => "Failed to add comment: " . $e->getMessage()]);
    }
}
?>
