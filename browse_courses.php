<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.html");
    exit();
}

$userID = $_SESSION['userID']; // Get the logged-in user's ID
$conn = new mysqli("localhost", "root", "", "learning_platform");

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch available courses
$sql = "SELECT Course_ID, CourseName, Description, Start_Date, End_Date FROM Course";
$result = $conn->query($sql);

// Check if courses are available
if ($result->num_rows > 0) {
    $courses = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $courses = [];
}

// Check if the user has clicked on 'Enroll' for a specific course
if (isset($_GET['enroll']) && isset($_GET['course_id'])) {
    $courseID = $_GET['course_id'];
    $enrollDate = date("Y-m-d");

    // Insert the enrollment record into the Enrollment table
    $enrollSQL = "INSERT INTO Enrollment (studentId, course_ID, enrollmentDate) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($enrollSQL);
    $stmt->bind_param("sss", $userID, $courseID, $enrollDate);

    if ($stmt->execute()) {
        echo "<p>You have successfully enrolled in the course!</p>";
    } else {
        echo "<p>Error enrolling in the course. Please try again.</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Courses - OLP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="browse-courses-container" style="max-width: 800px; margin: 0 auto; text-align: center;">
        <h1>Available Courses</h1>

        <?php if (count($courses) > 0): ?>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Enroll</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $course): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($course['Course_ID']); ?></td>
                            <td><?php echo htmlspecialchars($course['CourseName']); ?></td>
                            <td><?php echo htmlspecialchars($course['Description']); ?></td>
                            <td><?php echo htmlspecialchars($course['Start_Date']); ?></td>
                            <td><?php echo htmlspecialchars($course['End_Date']); ?></td>
                            <td>
                                <a href="browse_courses.php?enroll=true&course_id=<?php echo $course['Course_ID']; ?>">
                                    <button>Enroll</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No courses available at the moment.</p>
        <?php endif; ?>

        <a href="student_dashboard.php"><button style="margin-top: 20px;">Back to Dashboard</button></a>
    </div>
</body>
</html>
