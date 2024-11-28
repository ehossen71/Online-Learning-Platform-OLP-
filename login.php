<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Adjust if you have a different username
$password = ""; // Adjust if you have a password
$dbname = "learning_platform";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = trim($_POST['userID']);
    $password = trim($_POST['password']);

    // Check if the user exists
    $query = "SELECT UserID, Password, Role FROM Userinfo WHERE UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['Password'])) {
            // Check the role and redirect to the appropriate dashboard
            if ($row['Role'] === 'Student') {
                header("Location: student_dashboard.html");
                exit();
            } elseif ($row['Role'] === 'Instructor') {
                header("Location: instructor_dashboard.html");
                exit();
            } else {
                echo "Error: Invalid role. Please contact support.";
            }
        } else {
            echo "<script>alert('Invalid Password'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid User ID'); window.location.href='login.html';</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
