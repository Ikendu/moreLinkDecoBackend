<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"));

$name = $data->name;
$email = $data->email;
$phone = $data->phone;
$message = $data->message;

// Save to MySQL
$host = "localhost";
$dbname = "moredeco_link";
$username = "moredeco_link";
$password = "11111234Aa@!~";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "Database connection failing"]));
} else{
    echo("Hello we are connected");
}

$sql = "INSERT INTO users (fullname, email, phone, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss",$name, $email, $phone, $message,);

if (!$stmt->execute()) {
    echo json_encode(["status" => "Failed to save message"]);
    exit;
}

// Send Email via Gmail
// $to = "service@moredeco.com.ng";
// $subject = "New Contact Us Message from $name";
// $body = "You have received a new message:\n\nName: $name\nEmail: $email\nPhone Number: $phone\nMessage:\n$message";
// // $body = wordwrap($body, 70);
// $headers = "From: $email";

// if (mail($to, $subject, $body, $headers)) {
//     echo json_encode(["status" => "Message sent successfully"]);
// } else {
//     echo json_encode(["status" => "Failed to send email"]);
// }

$conn->close();
?>
