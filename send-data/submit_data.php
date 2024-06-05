<?php

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Update with your MySQL password if needed
$database = "project_guide";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data from POST request
$student_id = $_POST['student_id'];
$statement = $_POST['statement'];
$objectives = $_POST['objectives'];
$significance = $_POST['significance'];
$scope = $_POST['scope'];
$result = $_POST['result'];

// Insert data into submission_details table
$sql = "INSERT INTO submission_details (student_id, statement, objectives, significance, scope, result) 
        VALUES ('$student_id', '$statement', '$objectives', '$significance', '$scope', '$result')";

if ($conn->query($sql) === TRUE) {
    echo "Form submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
