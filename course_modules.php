<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "learning_platform");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get logged-in user's ID
$userID = $_SESSION['userID'];

// Get the course ID from the URL parameter
if (isset($_GET['course_id'])) {
    $courseID = $_GET['course_id'];
} else {
    echo "Course ID not specified.";
    exit();
}

// Fetch course details from the database
$courseQuery = "
    SELECT Course.Course_ID, Course.CourseName, Course.Description 
    FROM Course
    WHERE Course.Course_ID = ?";
$stmt = $conn->prepare($courseQuery);
$stmt->bind_param("i", $courseID); // Use integer type for Course_ID
$stmt->execute();
$course = $stmt->get_result()->fetch_assoc();

if (!$course) {
    echo "Course not found.";
    exit();
}

// Fetch modules for the course
$modulesQuery = "
    SELECT ModuleID, ModuleName, ModuleDescription 
    FROM Modules  -- Check that the table name is correct here
    WHERE Course_ID = ?";
$stmt = $conn->prepare($modulesQuery);
$stmt->bind_param("i", $courseID);
$stmt->execute();
$modulesResult = $stmt->get_result();

if ($modulesResult->num_rows > 0) {
    $modules = [];
    while ($module = $modulesResult->fetch_assoc()) {
        $modules[] = $module;
    }
} else {
    $modules = [];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Modules - <?php echo htmlspecialchars($course['CourseName']); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <main class="content">
            <h1>Modules for <?php echo htmlspecialchars($course['CourseName']); ?></h1>

            <?php if (!empty($modules)): ?>
                <ul>
                    <?php foreach ($modules as $module): ?>
                        <li>
                            <h2><?php echo htmlspecialchars($module['ModuleName']); ?></h2>
                            <p><?php echo nl2br(htmlspecialchars($module['ModuleDescription'])); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No modules available for this course.</p>
            <?php endif; ?>

            <div class="back-btn-container">
                <a href="show_courses.php"><button class="back-btn"><i class="fas fa-arrow-left"></i> Back to Courses</button></a>
            </div>
        </main>
    </div>
</body>
</html>
