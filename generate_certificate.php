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

// Initialize variables
$course_id = $student_id = null;

// Check if the form was submitted and the required keys exist
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Course_ID']) && isset($_POST['Student_ID'])) {
        $course_id = $_POST['Course_ID'];
        $student_id = $_POST['Student_ID'];

        // Prepare the SQL query to insert data into the certificates table
        $sql = "INSERT INTO certificates (Course_ID, Student_ID, Date_issued) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Set the date of issuance
        $date_issued = date('Y-m-d'); // Get today's date in Y-m-d format

        // Bind parameters to the SQL query
        $stmt->bind_param("sss", $course_id, $student_id, $date_issued);

        // Execute the query
        if ($stmt->execute()) {
            echo "<p>Certificate generated successfully.</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Close the prepared statement
        $stmt->close();
    }
}

// Fetch courses for the logged-in instructor
$user_id = $_SESSION['userID'];
$sql = "SELECT Course_ID, CourseName FROM Course WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        label {
            font-size: 18px;
            margin-bottom: 10px;
            display: block;
        }
        select, input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .back-button {
            background-color: #ff8c00; /* Orange color */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
            display: block;
            width: 200px;
            margin: 20px auto;
        }
        .back-button:hover {
            background-color: #e07b00; /* Darker orange for hover effect */
        }
    </style>
</head>
<body>

<h2>Select Course and Student to Issue Certificate</h2>

<?php
if ($result->num_rows > 0) {
    echo "<form action='' method='POST'>";
    echo "<label for='course'>Select Course</label>";
    echo "<select name='Course_ID' id='course' required>";
    echo "<option value=''>Select a Course</option>";

    // Display courses
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['Course_ID'] . "'>" . htmlspecialchars($row['CourseName']) . "</option>";
    }

    echo "</select>";

    // Fetch students for the logged-in instructor
    $sql_students = "SELECT u.UserID, u.First_Name, u.Last_Name FROM userinfo u JOIN student s ON u.UserID = s.UserID";
    $result_students = $conn->query($sql_students);

    echo "<label for='student'>Select Student</label>";
    echo "<select name='Student_ID' id='student' required>";
    echo "<option value=''>Select a Student</option>";

    // Display students
    while ($row_student = $result_students->fetch_assoc()) {
        echo "<option value='" . $row_student['UserID'] . "'>" . $row_student['First_Name'] . " " . $row_student['Last_Name'] . "</option>";
    }

    echo "</select>";

    echo "<input type='submit' value='Generate Certificate'>";
    echo "</form>";
} else {
    echo "<p>No courses available for issuing certificates.</p>";
}

$stmt->close();
$conn->close();
?>

<!-- Back to Dashboard Button -->
<a href="instructor_dashboard.html">
    <button class="back-button">Back to Dashboard</button>
</a>

</body>
</html>
