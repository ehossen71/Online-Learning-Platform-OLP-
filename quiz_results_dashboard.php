<?php
// quiz_results_dashboard.php

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

// Fetch quiz results for a specific student
$student_id = 2;  // Example student ID, replace with dynamic ID

$sql = "SELECT qr.Course_ID, qr.Quiz_NO, qr.Score, c.CourseName
        FROM `quizresult` qr
        JOIN `course` c ON qr.Course_ID = c.Course_ID
        WHERE qr.Student_ID = $student_id
        ORDER BY qr.Quiz_NO";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Your Quiz Results</h1>";
    echo "<table border='1'>
            <tr>
                <th>Course Name</th>
                <th>Quiz Number</th>
                <th>Score</th>
            </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["CourseName"]. "</td>
                <td>" . $row["Quiz_NO"]. "</td>
                <td>" . $row["Score"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No quiz results found</p>";
}

$conn->close();
?>
