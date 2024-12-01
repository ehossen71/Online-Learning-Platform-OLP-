<?php
// quiz_result.php

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

// SQL query to fetch quiz results along with student names
$sql = "SELECT qr.Course_ID, qr.Quiz_NO, qr.Score, u.UserID AS StudentID, u.First_Name, u.Last_Name
        FROM quiz_result qr
        JOIN student s ON qr.Student_ID = s.StudentID
        JOIN userinfo u ON s.UserID = u.UserID
        ORDER BY qr.Course_ID, qr.Quiz_NO, s.StudentID";

// Execute the query
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output the results in a table
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Quiz Results</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            table, th, td {
                border: 1px solid black;
            }
            th, td {
                padding: 10px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            h1 {
                text-align: center;
                font-size: 24px;
            }
            .publish-btn {
                background-color: #007bff;
                color: white;
                padding: 10px 20px;
                font-size: 16px;
                border: none;
                cursor: pointer;
                display: block;
                margin: 20px auto;
                text-align: center;
                border-radius: 5px;
            }
            .publish-btn:hover {
                background-color: #0056b3;
            }
            .back-btn {
                background-color: #f41371;
                color: white;
                padding: 10px 20px;
                font-size: 16px;
                border: none;
                cursor: pointer;
                display: block;
                margin: 20px auto;
                text-align: center;
                border-radius: 5px;
            }
            .back-btn:hover {
                background-color: #ff5252;
            }
            .message {
                color: green;
                font-weight: bold;
                text-align: center;
                display: none;
            }
        </style>
    </head>
    <body>
        <h1>Quiz Results</h1>
        <table>
            <tr>
                <th>Course ID</th>
                <th>Quiz Number</th>
                <th>Student Name</th>
                <th>Score</th>
            </tr>";
    
    // Fetch and display the rows from the query result
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["Course_ID"]. "</td>
                <td>" . $row["Quiz_NO"]. "</td>
                <td>" . $row["First_Name"] . " " . $row["Last_Name"] . "</td>
                <td>" . $row["Score"] . "</td>
              </tr>";
    }

    echo "</table>";

    // Publish Button
    echo "<button class='publish-btn' onclick='publishResults()'>Publish</button>";

    // Back to Dashboard Button
    echo "<button class='back-btn' onclick='window.location.href=\"instructor_dashboard.html\"'>Back to Dashboard</button>";

    // Success message (hidden by default)
    echo "<div class='message' id='successMessage'>Success!!</div>";

    // JavaScript to show the success message
    echo "<script>
        function publishResults() {
            // Show the success message
            document.getElementById('successMessage').style.display = 'block';
        }
    </script>";

    echo "</body>
    </html>";
} else {
    echo "<p>No results found</p>";
}

// Close the database connection
$conn->close();
?>
