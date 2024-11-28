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


// Check if the form is submitted
/*if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if all fields are filled
    if (empty($_POST['Course_ID']) || empty($_POST['CourseName']) || empty($_POST['Description']) || empty($_POST['UserID']) || empty($_POST['Start_Date']) || empty($_POST['End_Date'])) {
        echo "Error: All fields are required.";
    } else {
        // Get form data
        $course_id = $conn->real_escape_string($_POST['Course_ID']);
        $course_name = $conn->real_escape_string($_POST['CourseName']);
        $course_description = $conn->real_escape_string($_POST['Description']);
        $ins_user_id = $conn->real_escape_string($_POST['UserID']);
        $course_start = $conn->real_escape_string($_POST['Start_Date']);
        $course_end = $conn->real_escape_string($_POST['End_Date']);

        // Insert into database
        $query = "INSERT INTO Course (Course_ID, CourseName, Description, UserID, Start_Date, End_Date) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssss", $course_id, $course_name, $course_description, $ins_user_id, $course_start, $course_end);

        if ($stmt->execute()) {
            // Success message
            echo "<script>alert('Course added successfully!'); window.location.href='instructor_dashboard.html';</script>";
        } else {
            // Error message
            echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='add_course.html';</script>";
        }

        // Close statement
        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>
*/