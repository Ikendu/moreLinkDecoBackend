<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $postId = $data['postId'];
    $userId = $data['userId'];
    $type = $data['type'];

    $stmt = $conn->prepare("INSERT INTO likes (post_id, user_id, type) VALUES (:postId, :userId, :type)");
    $stmt->bindParam(':postId', $postId);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':type', $type);

    try {
        $stmt->execute();
        echo json_encode(["message" => ucfirst($type) . " reaction added successfully"]);
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode(["error" => "Reaction failed: " . $e->getMessage()]);
    }
}
?>
