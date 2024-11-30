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

$userID = $_SESSION['userID'];
$studentQuery = "SELECT StudentID FROM Student WHERE UserID = ?";
$stmt = $conn->prepare($studentQuery);
$stmt->bind_param("s", $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
    $studentID = $student['StudentID'];

    $query = "
        SELECT qd.Course_ID, qd.Quiz_NO, qd.Description_Quiz, c.CourseName 
        FROM quiz_description qd
        INNER JOIN Enrollment e ON qd.Course_ID = e.course_ID
        INNER JOIN Course c ON qd.Course_ID = c.Course_ID
        WHERE e.StudentID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $studentID);
    $stmt->execute();
    $quizzes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} else {
    $quizzes = [];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Quizzes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <main class="content">
            <section id="quiz-list">
                <h1>Available Quizzes</h1>
                <?php if (empty($quizzes)): ?>
                    <p>No quizzes available.</p>
                <?php else: ?>
                    <?php foreach ($quizzes as $quiz): ?>
                        <div class="quiz-card">
                            <h2><?php echo htmlspecialchars($quiz['CourseName']); ?> - Quiz <?php echo htmlspecialchars($quiz['Quiz_NO']); ?></h2>
                            <p><?php echo htmlspecialchars($quiz['Description_Quiz']); ?></p>
                            <a href="take_quiz.php?course_id=<?php echo $quiz['Course_ID']; ?>&quiz_no=<?php echo $quiz['Quiz_NO']; ?>">
                                <button>Take Quiz</button>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>
            <a href="student_dashboard.html"><button class="back-btn">Back to Dashboard</button></a>
        </main>
    </div>
</body>
</html>
