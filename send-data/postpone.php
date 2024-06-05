<?php

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "project_guide";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data from POST request
$studentId = $_POST['student_id'];
$reason = $_POST['reason'];

// Insert into postpone table
$sql = "INSERT INTO postpone (student_id, reason) VALUES ('$studentId', '$reason')";
if ($conn->query($sql) === TRUE) {
    echo "Postponement request submitted successfully!";
} else {
    echo "Error submitting postponement request: " . $conn->error;
}

$conn->close();

?>
