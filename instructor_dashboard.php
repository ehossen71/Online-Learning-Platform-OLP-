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

// Fetch courses for the logged-in instructor
$user_id = $_SESSION['userID'];
$sql = "SELECT Course_ID, CourseName FROM Course WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if courses are found
if ($result->num_rows > 0) {
    echo "<h2>Select a Course and Student to Issue Certificate</h2>";
    echo "<form action='issue_certificate_action.php' method='POST'>";

    // Dropdown to select a course
    echo "<label for='course'>Select Course: </label>";
    echo "<select name='Course_ID' id='course' required>";
    echo "<option value=''>Select a Course</option>";

    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['Course_ID'] . "'>" . htmlspecialchars($row['CourseName']) . "</option>";
    }

    echo "</select><br><br>";

    // Dropdown to select a student
    echo "<label for='student'>Select Student: </label>";
    echo "<select name='Student_ID' id='student' required>";
    echo "<option value=''>Select a Student</option>";

    // Fetch all students
    $sql_students = "SELECT u.UserID, u.First_Name, u.Last_Name FROM userinfo u JOIN student s ON u.UserID = s.UserID";
    $result_students = $conn->query($sql_students);

    while ($row_student = $result_students->fetch_assoc()) {
        echo "<option value='" . $row_student['UserID'] . "'>" . $row_student['First_Name'] . " " . $row_student['Last_Name'] . "</option>";
    }

    echo "</select><br><br>";

    echo "<input type='submit' value='Next' />";
    echo "</form>";
} else {
    echo "<p>No courses available to issue certificates.</p>";
}

$stmt->close();
$conn->close();
?>
