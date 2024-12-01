<?php
// quiz_result_insert.php

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

// Data from the quiz submission form (example values)
$course_id = 'CSE115.2';  // Course ID
$quiz_no = 1;              // Quiz number
$student_id = 2;           // Student ID
$score = 5;                // Student's score

// SQL query to insert quiz result into quizresult table
$sql = "INSERT INTO `quizresult` (`Course_ID`, `Quiz_NO`, `Student_ID`, `Score`) 
        VALUES ('$course_id', $quiz_no, $student_id, $score)";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
