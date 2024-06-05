<?php

// Connect to your database (replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_guide";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(array("error" => "Connection failed: " . $conn->connect_error)));
}

// Prepare the SQL query to select student_id and status
$sql = "SELECT student_id, status FROM submission_details";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Append each row to the data array
    }
    // Output JSON data
    echo json_encode($data);
} else {
    echo json_encode(array("error" => "No results found"));
}

// Close the database connection
$conn->close();
?>
