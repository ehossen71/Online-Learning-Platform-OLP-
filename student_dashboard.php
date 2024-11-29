<?php
<<<<<<< HEAD
session_start(); // Start the session

// Check if the user is logged in
=======
session_start();

// Check if the user is logged in by verifying session
>>>>>>> b9eb794b53d60706d031c9a447b0586caae462af
if (!isset($_SESSION['userId'])) {
    // If not logged in, redirect to the login page
    header("Location: login.html");
    exit();
}

// Fetch user details using the session UserID
$userId = $_SESSION['userId'];

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
