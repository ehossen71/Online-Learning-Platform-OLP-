<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.html");
    exit();
}

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
    $start_date = $_POST['Start_Date'];
    $end_date = $_POST['End_Date'];

    // Get logged-in user's ID from the session
    $user_id = $_SESSION['userID'];

    // Extract the section ID from the Course_ID
    $parts = explode('.', $course_id);
    if (count($parts) !== 2) {
        echo "Error: Invalid Course_ID format. Please use the format 'CourseCode.SectionNumber' (e.g., CSE231.6).";
        exit();
    }
    $sec_id = $parts[1]; // Section ID is the part after the dot

    // Check if all fields are filled
    if (empty($course_id) || empty($course_name) || empty($description) || empty($start_date) || empty($end_date)) {
        echo "Error: All fields are required.";
    } else {
        // Start a transaction
        $conn->begin_transaction();

        try {
            // Insert into Course table
            $sql = "INSERT INTO Course (Course_ID, CourseName, Description, UserID, Start_Date, End_Date) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $course_id, $course_name, $description, $user_id, $start_date, $end_date);
            $stmt->execute();

            // Insert into Section table
            $sql_section = "INSERT INTO Section (Sec_ID, Course_ID) VALUES (?, ?)";
            $stmt_section = $conn->prepare($sql_section);
            $stmt_section->bind_param("ss", $sec_id, $course_id);
            $stmt_section->execute();

            // Commit the transaction
            $conn->commit();

            echo "New course and section added successfully!";
            header("Location: instructor_dashboard.html");
            exit();
        } catch (Exception $e) {
            // Rollback the transaction on error
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
    }
}

$conn->close();
?>
