<?php
// Database connection parameters
$servername = "localhost"; // MySQL server
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "learning_platform"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $course_id = $_POST['Course_ID'];
    $course_name = $_POST['CourseName'];
    $description = $_POST['Description'];
    $user_id = $_POST['UserID'];  // Updated field name here
    $start_date = $_POST['Start_Date'];
    $end_date = $_POST['End_Date'];

    // Check if all fields are filled
    if (empty($course_id) || empty($course_name) || empty($description) || empty($user_id) || empty($start_date) || empty($end_date)) {
        echo "Error: All fields are required.";
    } else {
        // Prepare the SQL query to insert the new course
        $sql = "INSERT INTO Course (Course_ID, CourseName, Description, UserID, Start_Date, End_Date) VALUES (?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $course_id, $course_name, $description, $user_id, $start_date, $end_date);

        // Execute the query
        if ($stmt->execute()) {
            echo "New course added successfully!";
            // Redirect back to the instructor dashboard after a short delay
            header("Location: instructor_dashboard.html");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>

