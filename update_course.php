<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['Course_ID'];
    $course_name = $_POST['CourseName'];
    $description = $_POST['Description'];
    $start_date = $_POST['Start_Date'];
    $end_date = $_POST['End_Date'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "learning_platform");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the course details
    $sql = "UPDATE Course SET CourseName = ?, Description = ?, Start_Date = ?, End_Date = ? WHERE Course_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $course_name, $description, $start_date, $end_date, $course_id);

    if ($stmt->execute()) {
        echo "Course updated successfully.";
        // Redirect back to the view course page
        header("Location: view_course.php");
        exit;
    } else {
        echo "Error updating course: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
