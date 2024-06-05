<?php
// Database configuration
$servername = "localhost"; // Change this to your MySQL server name
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "project_guide"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure 'student_id' is set and not empty
    if(isset($_POST['student_id']) && !empty($_POST['student_id'])) {
        // Sanitize the input to prevent SQL injection
        $studentId = mysqli_real_escape_string($conn, $_POST['student_id']);

        // Prepare and execute SQL query to check if the student ID exists in the merge proposal table
        $sql = "SELECT status FROM merge_proposal WHERE first_student_id = ? OR second_student_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $studentId, $studentId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the student ID exists in the merge proposal table
        if ($result->num_rows > 0) {
            // Student ID exists, fetch the status
            $row = $result->fetch_assoc();
            $status = $row['status'];
            
            // Return status as JSON response
            echo json_encode(array("status" => $status));
        } else {
            // Student ID not found
            echo json_encode(array("status" => "Not found"));
        }
    } else {
        // 'student_id' parameter is missing or empty
        http_response_code(400); // Bad Request
        echo json_encode(array("message" => "Missing or empty 'student_id' parameter"));
    }
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("message" => "Method Not Allowed"));
}

// Close connection
$conn->close();
?>
