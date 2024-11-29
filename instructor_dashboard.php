<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit();
}

// Fetch courses from the database
$conn = new mysqli("localhost", "root", "", "learning_platform");
$sql = "SELECT Course_ID, CourseName FROM Course";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="course-card">';
        echo '<h2>' . $row['CourseName'] . '</h2>';
        echo '<a href="view_course.php"><button>View Courses</button></a>';
        echo '<a href="edit_course.php?Course_ID=' . $row['Course_ID'] . '"><button>Edit Course</button></a>';
        echo '</div>';
    }
}
$conn->close();
?>
