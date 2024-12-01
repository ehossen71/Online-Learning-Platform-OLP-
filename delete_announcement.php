<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_platform";

// Create a connection
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

// Get the Announcement ID from the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Announce_ID'])) {
    $announcement_id = $_POST['Announce_ID'];
    $user_id = $_SESSION['userID'];

    // Ensure that the announcement belongs to the logged-in instructor
    $sql = "DELETE FROM Announcement WHERE Announce_ID = ? AND UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $announcement_id, $user_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Announcement deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete announcement. Please try again.";
    }

    $stmt->close();
}

$conn->close();

// Redirect back to the manage announcements page
header("Location: manage_announcements.php");
exit();
?>
