<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit();
}

// Fetch courses for the logged-in instructor from the database
$conn = new mysqli("localhost", "root", "", "learning_platform");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['userID']; // Fetch logged-in user's ID

$sql = "SELECT Course_ID, CourseName FROM Course WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id); // Securely bind the user ID to prevent SQL injection
$stmt->execute();
$result = $stmt->get_result();

// Display the courses associated with the logged-in instructor
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="course-card">';
        echo '<h2>' . htmlspecialchars($row['CourseName']) . '</h2>';
        echo '<a href="view_course.php?Course_ID=' . $row['Course_ID'] . '"><button>View Course</button></a>';
        echo '<a href="edit_course.php?Course_ID=' . $row['Course_ID'] . '"><button>Edit Course</button></a>';
        echo '</div>';
    }
} else {
    echo "<p>No courses found.</p>";
}

$stmt->close();
$conn->close();
?>
