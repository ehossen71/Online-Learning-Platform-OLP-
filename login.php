<?php
// Start the session to store login status and role
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root"; // Adjust if you have a different username
$password = ""; // Adjust if you have a password
$dbname = "learning_platform";
$logFile = 'debug_log.txt';
$logData = "";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = trim($_POST['UserID']);
    $password = trim($_POST['Password']);


    // Check if the user exists
    $query = "SELECT UserID, Password, Role FROM Userinfo WHERE UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $userId);
    
    $stmt->execute();
    $result = $stmt->get_result();

    
    // file_put_contents($logFile, $logData, FILE_APPEND);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        
        $logData .= "Database Password: " . $row['Password'] . "\n";
        $logData .= "User Role: " . $password . "\n";
        

        file_put_contents($logFile, $logData, FILE_APPEND);

        if (password_verify($password, $row['Password'])) {
            // Set session variables for logged-in user
            $_SESSION['userID'] = $row['UserID'];
            $_SESSION['role'] = $row['Role'];

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
