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
$name = $_POST['name'];
$studentId = $_POST['student_id'];
$course = $_POST['course'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check if student ID already exists
$sql = "SELECT * FROM registration WHERE student_id = '$studentId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Student ID already exists!";
} else {
    // If student ID does not exist, register the student
    $sql = "INSERT INTO registration (student_name, student_id, student_course, email, password) VALUES ('$name', '$studentId', '$course', '$email', '$hashedPassword')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error registering student!";
    }
}

$conn->close();

?>
