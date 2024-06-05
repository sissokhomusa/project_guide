<?php
// Database connection parameters
$servername = "localhost"; // Change to your database server name
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "project_guide"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve student_id, status, and student_name from submission_details and registration tables
$sql = "SELECT sd.student_id, sd.status, r.student_name 
        FROM submission_details sd
        INNER JOIN registration r ON sd.student_id = r.student_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    // Convert data to JSON format
    echo json_encode($rows);
} else {
    echo "0 results";
}
$conn->close();
?>
