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

// Fetch postpone details
$sql = "SELECT * FROM postpone";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $postpone_details = array();
    while($row = $result->fetch_assoc()) {
        $postpone_details[] = $row;
    }
    echo json_encode($postpone_details);
} else {
    echo "0 results";
}
$conn->close();
?>
