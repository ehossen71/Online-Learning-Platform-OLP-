<?php
// leaderboard.php

// Start the session
session_start();



// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_platform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection

    // SQL query to fetch leaderboard data
    $sql = "SELECT qr.Course_ID, u.First_Name, u.Last_Name, SUM(qr.Score) AS Total_Score
            FROM quiz_result qr
            JOIN student s ON qr.Student_ID = s.StudentID
            JOIN userinfo u ON s.UserID = u.UserID
            GROUP BY qr.Course_ID, qr.Student_ID
            ORDER BY qr.Course_ID, Total_Score DESC";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Start outputting the HTML
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Leaderboard</title>
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
            </style>
        </head>
        <body>
            <h1>Leaderboard</h1>
            <table>
                <tr>
                    <th>Course ID</th>
                    <th>Student Name</th>
                    <th>Total Score</th>
                </tr>";

        // Fetch and display the rows from the query result
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["Course_ID"] . "</td>
                    <td>" . $row["First_Name"] . " " . $row["Last_Name"] . "</td>
                    <td>" . $row["Total_Score"] . "</td>
                  </tr>";
        }

        echo "</table>";

        // Back to Dashboard Button
        echo "<button class='back-btn' onclick='window.location.href=\"student_dashboard.html\"'>Back to Dashboard</button>";

        echo "</body>
        </html>";
    } else {
        echo "<p>No leaderboard data available</p>";
    }

    // Close the database connection
    $conn->close();

?>
