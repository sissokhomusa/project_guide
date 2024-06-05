<?php

$servername = "localhost";
$username = "root";
$password = ""; // Update with your MySQL password if needed
$database = "project_guide";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT s.student_id, r.student_name
        FROM submission_details s
        INNER JOIN registration r ON s.student_id = r.student_id";

$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $student_data = array();
        while ($row = $result->fetch_assoc()) {
            $student_data[] = $row;
        }
        echo json_encode($student_data);
    } else {
        echo json_encode(array()); // Return empty array if no results
    }
} else {
    echo json_encode(array('error' => $conn->error)); // Return error message as JSON
}

$conn->close();

?>
