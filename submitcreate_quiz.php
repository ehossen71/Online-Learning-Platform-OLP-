<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "learning_platform");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$course_id = $_POST['Course_ID'];
$quiz_no = $_POST['Quiz_NO'];
$description = $_POST['Description_Quiz'];
$questions = $_POST['questions'];

// Validate that Course_ID and Quiz_NO do not already exist in Quiz_Description
$sql = "SELECT * FROM Quiz_Description WHERE Course_ID = ? AND Quiz_NO = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $course_id, $quiz_no);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    die("Error: A quiz with the same Course_ID and Quiz_NO already exists.");
}
$stmt->close();

// Insert into Quiz_Description table
$sql = "INSERT INTO Quiz_Description (Quiz_NO, Course_ID, Description_Quiz) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $quiz_no, $course_id, $description);
if (!$stmt->execute()) {
    die("Error inserting into Quiz_Description: " . $stmt->error);
}
$stmt->close();

// Insert questions into quiz_question table
foreach ($questions as $que_no => $question) {
    $sql = "INSERT INTO quiz_question (Course_ID, Quiz_NO, Que_NO, Question, Choice1, Choice2, Choice3, Choice4, Correct_Ans) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "siissssss",
        $course_id,
        $quiz_no,
        $que_no,
        $question['text'],
        $question['choice1'],
        $question['choice2'],
        $question['choice3'],
        $question['choice4'],
        $question['correct']
    );
    if (!$stmt->execute()) {
        die("Error inserting into quiz_question: " . $stmt->error);
    }
    $stmt->close();
}

// Redirect back to dashboard with success message
header("Location: instructor_dashboard.html?success=Quiz created successfully");
$conn->close();
?>
