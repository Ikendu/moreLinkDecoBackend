<?php
$host = "localhost";
$db_name = "deco";
$username = "root"; // Change if your DB username is different
$password = "";     // Add your password if needed

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
echo("Done")
?>
