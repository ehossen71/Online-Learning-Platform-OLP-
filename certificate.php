<?php
// Start session to ensure user is logged in
session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: login.html");
    exit();
}

// Capture the passed parameters
if (isset($_GET['student'], $_GET['score'], $_GET['course'])) {
    $student_name = $_GET['student'];
    $score = $_GET['score'];
    $course_name = $_GET['course'];
} else {
    die("Missing data.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff;
        }

        .certificate-container {
            width: 80%;
            margin: 0 auto;
            padding: 40px;
            border: 10px solid #4CAF50;
            background-color: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .certificate-container h1 {
            font-size: 36px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .student-name {
            font-size: 28px;
            color: #333;
            margin: 20px 0;
        }

        .course-name {
            font-size: 24px;
            color: #333;
            margin: 20px 0;
        }

        .score {
            font-size: 22px;
            margin: 20px 0;
            font-weight: bold;
            color: #333;
        }

        .footer {
            margin-top: 40px;
            font-size: 18px;
            color: #777;
        }

        .signature {
            margin-top: 50px;
            font-size: 24px;
            font-weight: bold;
            color: #4CAF50;
        }
    </style>
</head>
<body>

    <div class="certificate-container">
        <h1>Certificate of Achievement</h1>
        <p class="student-name">This is to certify that</p>
        <p class="student-name"><?php echo htmlspecialchars($student_name); ?></p>
        <p class="course-name">has successfully completed the course:</p>
        <p class="course-name"><?php echo htmlspecialchars($course_name); ?></p>
        <p class="score">with a score of: <?php echo htmlspecialchars($score); ?>%</p>

        <div class="footer">
            <p>Instructor: Your Instructor Name</p>
            <p>Online Learning Platform</p>
        </div>

        <div class="signature">
            <p>Signature</p>
        </div>
    </div>

</body>
</html>
