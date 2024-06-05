<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_guide";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the message and the time from the request
$message = $_POST['message'];
$time = $_POST['time'];

// Check if a message for the given time already exists in the database
$stmt = $conn->prepare("SELECT * FROM notification WHERE time = ?");
$stmt->bind_param("s", $time);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // If a message exists for the given time, update it
    $stmt = $conn->prepare("UPDATE notification SET message = ? WHERE time = ?");
    $stmt->bind_param("ss", $message, $time);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Message updated successfully
        echo json_encode(array("success" => true, "message" => "Message updated successfully"));
    } else {
        // Failed to update message
        echo json_encode(array("success" => false, "message" => "Failed to update message"));
    }
} else {
    // If no message exists for the given time, insert a new record
    $stmt = $conn->prepare("INSERT INTO notification (message, time) VALUES (?, ?)");
    $stmt->bind_param("ss", $message, $time);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Message inserted successfully
        echo json_encode(array("success" => true, "message" => "Message inserted successfully"));
    } else {
        // Failed to insert message
        echo json_encode(array("success" => false, "message" => "Failed to insert message"));
    }
}

// Close prepared statement and connection
$stmt->close();
$conn->close();
?>
