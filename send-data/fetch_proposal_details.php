<?php

$servername = "localhost";
$username = "root";
$password = ""; // Update with your MySQL password if needed
$database = "project_guide";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the student_id parameter is provided in the POST request
if (isset($_POST['student_id'])) {
    $studentId = $_POST['student_id'];

    // Query to fetch proposal details based on student_id
    $sql = "SELECT * FROM submission_details WHERE student_id = '$studentId'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the first row (assuming student_id is unique)
        $row = $result->fetch_assoc();

        // Return the proposal details as JSON response
        echo json_encode($row);
    } else {
        // No proposal found with the provided student_id
        echo json_encode(array('error' => 'No proposal found with the provided student_id'));
    }
} else {
    // student_id parameter is not provided
    echo json_encode(array('error' => 'student_id parameter is not provided'));
}

$conn->close();

?>
