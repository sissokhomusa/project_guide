<?php
header('Content-Type: application/json');

// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "project_guide"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the required parameters are provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_id'])) {
    $studentId = $_POST['student_id'];

    // Update the status to "Approved" in the submission_details table
    $sql = "UPDATE submission_details SET status = 'Approved' WHERE student_id = '$studentId'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Proposal approved successfully"));
    } else {
        echo json_encode(array("error" => "Error updating status: " . $conn->error));
    }
} else {
    echo json_encode(array("error" => "Missing parameters"));
}

$conn->close();
?>
