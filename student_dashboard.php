<?php
// student_dashboard.php

session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_platform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the logged-in student's ID
$student_id = $_SESSION['userId'];  // Dynamically fetch from session

// Example course IDs (could be dynamically fetched based on enrolled courses)
$course_ids = ['CSE115.2', 'HIS101', 'MAT202'];  // Example course IDs

// Initialize an array to store progress data for each course
$progress_data = [];

// Loop through each course to fetch and calculate progress
foreach ($course_ids as $course_id) {
    // Query to get total number of quizzes in the course
    $sql_total_quizzes = "SELECT COUNT(*) AS total_quizzes FROM quiz_description WHERE Course_ID = '$course_id'";
    $result_total_quizzes = $conn->query($sql_total_quizzes);
    $row_total = $result_total_quizzes->fetch_assoc();
    $total_quizzes = $row_total['total_quizzes'];

    // Query to get the number of quizzes completed by the student
    $sql_completed_quizzes = "SELECT COUNT(*) AS completed_quizzes FROM quiz_result WHERE Student_ID = $student_id AND Course_ID = '$course_id'";
    $result_completed_quizzes = $conn->query($sql_completed_quizzes);
    $row_completed = $result_completed_quizzes->fetch_assoc();
    $completed_quizzes = $row_completed['completed_quizzes'];

    // Calculate the progress percentage
    if ($total_quizzes > 0) {
        $progress_percentage = ($completed_quizzes / $total_quizzes) * 100;
    } else {
        $progress_percentage = 0;  // No quizzes in the course
    }

    // Store the progress data for each course
    $progress_data[] = [
        'course_id' => $course_id,
        'progress_percentage' => $progress_percentage,
        'total_quizzes' => $total_quizzes,
        'completed_quizzes' => $completed_quizzes
    ];
}

$conn->close();

// Store the progress data in the session to pass it to HTML
$_SESSION['progress_data'] = $progress_data;
?>
