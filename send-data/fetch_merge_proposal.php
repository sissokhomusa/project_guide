<?php
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "project_guide"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT first_student_id, second_student_id, project_name, project_type FROM merge_proposal";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $mergeProposals = array();
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $mergeProposals[] = $row;
    }
    echo json_encode($mergeProposals);
} else {
    echo "0 results";
}
$conn->close();
?>
