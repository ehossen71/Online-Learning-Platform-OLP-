<?php
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

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.html");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected course and student
    if (isset($_POST['Course_ID']) && isset($_POST['Student_ID'])) {
        $course_id = $_POST['Course_ID'];
        $student_id = $_POST['Student_ID'];

        // Fetch the student's score for the selected course
        $sql = "SELECT qr.Score, u.First_Name, u.Last_Name 
                FROM quiz_result qr 
                JOIN userinfo u ON qr.Student_ID = u.UserID 
                WHERE qr.Course_ID = ? AND qr.Student_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $course_id, $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a result is found
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $score = $row['Score'];
            $student_name = $row['First_Name'] . ' ' . $row['Last_Name'];
            $course_name = "Course Name";  // You can fetch the course name from the database too if needed

            // Insert into Certificates table
            $sql_insert = "INSERT INTO Certificates (Course_ID, Student_ID, Score) VALUES (?, ?, ?)";
            $insert_stmt = $conn->prepare($sql_insert);
            $insert_stmt->bind_param("sss", $course_id, $student_id, $score);
            $insert_stmt->execute();

            // Redirect to certificate.php with data
            header("Location: certificate.php?student=" . urlencode($student_name) . "&score=" . urlencode($score) . "&course=" . urlencode($course_name));
            exit();
        } else {
            echo "<p>No results found for the selected student and course.</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Error: Course or Student ID missing.</p>";
    }
}

$conn->close();
?>
