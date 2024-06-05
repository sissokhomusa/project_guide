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

// Get the student ID from POST request
$studentId = $_POST['student_id'];

// Query to check if the student ID exists in the postpone table
$sql = "SELECT * FROM postpone WHERE student_id = '$studentId'";
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Student ID exists in the postpone table
    echo "not eligible";
} else {
    // Student ID does not exist in the postpone table
    echo "eligible";
}

$conn->close();

?>
