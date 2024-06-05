<?php
// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=project_guide', 'root', '');

// Retrieve data from POST request
$ownStudentId = $_POST['own_student_id'];
$fellowStudentId = $_POST['fellow_student_id'];
$projectName = $_POST['project_name'];
$projectType = $_POST['project_type'];

// Insert data into database
$stmt = $pdo->prepare("INSERT INTO merge_proposal (first_student_id, second_student_id, project_name, project_type) VALUES (?, ?, ?, ?)");
$stmt->execute([$ownStudentId, $fellowStudentId, $projectName, $projectType]);

// Check if insertion was successful
if ($stmt->rowCount() > 0) {
    // Data inserted successfully
    echo json_encode(array("message" => "Merge proposal submitted successfully."));
} else {
    // Failed to insert data
    echo json_encode(array("message" => "Failed to submit merge proposal."));
}
?>
