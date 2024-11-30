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

$course_id = $_GET['course_id'];
$quiz_no = $_GET['quiz_no'];
$user_id = $_SESSION['userID'];

// Check if the student has already taken the quiz
$query = "SELECT 1 FROM quiz_result WHERE Course_ID = ? AND Quiz_NO = ? AND Student_ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sis", $course_id, $quiz_no, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Quiz already taken
    $_SESSION['message'] = "You have already taken this quiz. You are not eligible to take it again.";
    header("Location: take_quiz.php?course_id=$course_id&quiz_no=$quiz_no");
    exit();
}

$stmt->close();

// Fetch the quiz questions
$query = "SELECT Que_NO, Question, Choice1, Choice2, Choice3, Choice4, Correct_Ans
          FROM quiz_question
          WHERE Course_ID = ? AND Quiz_NO = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $course_id, $quiz_no);
$stmt->execute();
$questions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Quiz</title>
    <link rel="stylesheet" href="style.css">
    <script>
        let score = 0;
        let currentQuestion = 0;
        const questions = <?php echo json_encode($questions); ?>;

        function disableBackButton() {
            // Disable browser back button
            window.history.pushState(null, "", location.href);
            window.onpopstate = function () {
                // Submit quiz with 0 score if user tries to go back
                document.getElementById('quiz-container').innerHTML = `
                    <h1>Submitting Quiz...</h1>
                    <form id="quiz-form" method="POST" action="submit_quiz.php">
                        <input type="hidden" name="score" value="0">
                        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                        <input type="hidden" name="quiz_no" value="<?php echo $quiz_no; ?>">
                    </form>
                `;
                document.getElementById('quiz-form').submit();
            };
        }

        function loadQuestion() {
            if (currentQuestion >= questions.length) {
                // Automatically submit the quiz
                document.getElementById('quiz-container').innerHTML = `
                    <h1>Submitting Quiz...</h1>
                    <form id="quiz-form" method="POST" action="submit_quiz.php">
                        <input type="hidden" name="score" value="${score}">
                        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                        <input type="hidden" name="quiz_no" value="<?php echo $quiz_no; ?>">
                    </form>
                `;
                document.getElementById('quiz-form').submit();
                return;
            }

            const question = questions[currentQuestion];
            document.getElementById('quiz-container').innerHTML = `
                <h2>Question ${currentQuestion + 1}</h2>
                <p>${question.Question}</p>
                <form onsubmit="return checkAnswer(event)">
                    <label><input type="radio" name="answer" value="choice1"> 1. ${question.Choice1}</label><br>
                    <label><input type="radio" name="answer" value="choice2"> 2. ${question.Choice2}</label><br>
                    <label><input type="radio" name="answer" value="choice3"> 3. ${question.Choice3}</label><br>
                    <label><input type="radio" name="answer" value="choice4"> 4. ${question.Choice4}</label><br>
                    <button type="submit">Next</button>
                </form>
            `;
        }

        function checkAnswer(event) {
            event.preventDefault();
            const selected = document.querySelector('input[name="answer"]:checked');
            if (selected && selected.value === questions[currentQuestion].Correct_Ans) {
                score++;
            }
            currentQuestion++;
            loadQuestion();
        }

        document.addEventListener('DOMContentLoaded', () => {
            disableBackButton();
            loadQuestion();
        });
    </script>
</head>
<body>
    <div id="quiz-container"></div>
</body>
</html>