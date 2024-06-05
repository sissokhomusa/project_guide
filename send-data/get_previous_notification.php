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

// SQL query to fetch notifications
$sql = "SELECT time, message FROM notification ORDER BY time DESC"; // Assuming 'notifications' is your table name

$result = $conn->query($sql);

$notifications = array(); // Array to store notifications

if ($result->num_rows > 0) {
    // Fetch each row from the result set
    while($row = $result->fetch_assoc()) {
        // Add each notification to the array
        $notifications[] = $row;
    }
}

// Close connection
$conn->close();

// Output notifications as JSON
header('Content-Type: application/json');
echo json_encode($notifications);
?>
