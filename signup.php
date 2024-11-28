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
    $userId = $_POST['UserID'];
    $firstName = $_POST['First_Name'];
    $lastName = $_POST['Last_Name'];
    $role = $_POST['Role'];
    $email = $_POST['Email'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // Hash the password for security

    // Check if the user ID or email already exists
    $checkQuery = "SELECT * FROM Userinfo WHERE UserID = ? OR Email = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ss", $userId, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Error: User ID or Email already exists. Please try again with different credentials.";
    } else {
        // Insert the new user data into the database
        $insertQuery = "INSERT INTO Userinfo (UserID, First_Name, Last_Name, Role, Email, Password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssssss", $userId, $firstName, $lastName, $role, $email, $password);

        if ($stmt->execute()) {
            echo "Sign-up successful! Redirecting to the login..";
            // Redirect to the login (optional)
            header("Location: login.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
