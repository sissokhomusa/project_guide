<?php
// Connect to your database
$pdo = new PDO('mysql:host=localhost;dbname=project_guide', 'root', '');

// Fetch the most recent notification
$stmt = $pdo->query("SELECT message, time FROM notification ORDER BY time DESC LIMIT 1");
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Return the result as JSON
header('Content-Type: application/json');
echo json_encode($result);
?>
