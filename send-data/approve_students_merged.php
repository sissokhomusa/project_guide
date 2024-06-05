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
    // Ensure 'first_student_id' and 'second_student_id' are set and not empty
    if(isset($_POST['first_student_id']) && !empty($_POST['first_student_id']) && isset($_POST['second_student_id']) && !empty($_POST['second_student_id'])) {
        // Sanitize the inputs to prevent SQL injection
        $firstStudentId = mysqli_real_escape_string($conn, $_POST['first_student_id']);
        $secondStudentId = mysqli_real_escape_string($conn, $_POST['second_student_id']);

        // Prepare and execute SQL query to update status to "Approved"
        $sql = "UPDATE merge_proposal SET status = 'Approved' WHERE first_student_id = ? AND second_student_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $firstStudentId, $secondStudentId); // Assuming both IDs are integers, adjust data type if necessary
        $stmt->execute();
        
        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            // Update successful
            echo json_encode(array("message" => "Merge proposal approved successfully"));
        } else {
            // Update failed
            echo json_encode(array("message" => "Failed to approve merge proposal"));
        }
    } else {
        // 'first_student_id' or 'second_student_id' parameter is missing or empty
        http_response_code(400); // Bad Request
        echo json_encode(array("message" => "Missing or empty 'first_student_id' or 'second_student_id' parameter"));
    }
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("message" => "Method Not Allowed"));
}

// Close connection
$conn->close();
?>
