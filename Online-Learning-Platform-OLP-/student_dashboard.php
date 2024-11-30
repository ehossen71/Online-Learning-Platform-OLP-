<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['userId'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.html");
    exit();
}

// Fetch user details using the session UserID
$userId = $_SESSION['userId']; // Retrieve the session's userID

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

// Fetch user details from the database
$query = "SELECT * FROM Userinfo WHERE UserID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Check if user data was found
if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    // Handle the case if user data is not found
    echo "User not found!";
    exit();
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
