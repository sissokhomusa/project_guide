<?php

// Connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "project_guide";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    // Return error response
    http_response_code(500);
    die("Connection failed: " . $conn->connect_error);
}

// Fetch recently completed projects from the database
$sql = "SELECT project_id FROM recently_project";
$result = $conn->query($sql);

$projects = array();
if ($result) {
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $project = array();
            $project['project_id'] = $row['project_id'];
            // Generate secure URL with a token and timestamp
            $token = generateToken(); // Function to generate a unique token
            $timestamp = time(); // Current timestamp
            // Append token and timestamp as query parameters
            $project['pdf_path'] = "http://192.168.206.24/send-data/recently_projects_available/recently_projects_available.pdf?token=$token&timestamp=$timestamp";
            $projects[] = $project;
        }
    } else {
        // No projects found
        http_response_code(404);
        die("No projects found");
    }
} else {
    // Error executing SQL query
    http_response_code(500);
    die("Error executing SQL query: " . $conn->error);
}

// Close connection
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($projects);

// Function to generate a unique token
function generateToken() {
    return bin2hex(random_bytes(16)); // Generate a random token (you may need to adjust this depending on your requirements)
}
?>
