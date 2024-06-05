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
$studentId = $_POST['student_id'];
$password = $_POST['password'];

// Query the database to check if student ID and password match
$sql = "SELECT * FROM registration WHERE student_id = '$studentId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Student ID exists, check password
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Password is correct, return sign-in successful along with role
        $role = $row['role']; // Assuming 'role' is the column name for the role
        echo json_encode(["result" => "Sign-in successful!", "role" => $role]);
    } else {
        // Incorrect password
        echo "Incorrect password!";
    }
} else {
    // Student ID does not exist
    echo "Student ID not found!";
}

$conn->close();

?>
