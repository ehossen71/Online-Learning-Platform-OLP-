<?php
session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: login.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "learning_platform");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$score = $_POST['score']; 
$course_id = $_POST['course_id'];
$quiz_no = $_POST['quiz_no'];
$user_id = $_SESSION['userID'];

// Fetch student ID and course name
$query = "SELECT StudentID FROM Student WHERE UserID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$student_id = $student['StudentID'];

$query = "SELECT CourseName FROM Course WHERE Course_ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $course_id);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();
$course_name = $course['CourseName'];

// Insert into quiz_result table
$query = "INSERT INTO quiz_result (Course_ID, Quiz_NO, Score, Student_ID, CourseName) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("siiss", $course_id, $quiz_no, $score, $student_id, $course_name);
$stmt->execute();

// Close connections
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Submission</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Quiz Submitted Successfully</h1>
        <p>Thank you for completing the quiz. Your submission has been recorded.</p>
        <button onclick="window.location.href='student_dashboard.html'">Go to Dashboard</button>
    </div>
</body>
</html>
