<?php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdfPath = $_POST['pdf_path'];

    // Insert the PDF path into the database
    $sql = "INSERT INTO recently_project (pdf_path) VALUES ('$pdfPath')";
    
    if ($conn->query($sql) === TRUE) {
        echo "PDF path stored successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Move the uploaded file to the desired directory
    $uploadDir = "recently_projects_available/";
    $uploadedFilePath = $uploadDir . basename($_FILES['pdf_file']['name']);
    if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $uploadedFilePath)) {
        echo "File uploaded successfully.";
    } else {
        echo "Failed to upload file.";
    }
}

$conn->close();
?>
