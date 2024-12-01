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

$user_id = $_SESSION['userID'];

// Fetch announcements created by the logged-in instructor
$sql = "SELECT Announce_ID, Course_ID, Title, Content, Created_At FROM Announcement WHERE UserID = ?";
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
    <title>Manage Announcements - OLP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="announcement-container">
        <h1>Your Announcements</h1>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Course ID</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['Course_ID']); ?></td>
                            <td><?php echo htmlspecialchars($row['Title']); ?></td>
                            <td><?php echo htmlspecialchars($row['Content']); ?></td>
                            <td><?php echo htmlspecialchars($row['Created_At']); ?></td>
                            <td>
                                <form action="delete_announcement.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="Announce_ID" value="<?php echo $row['Announce_ID']; ?>">
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this announcement?');">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No announcements found.</p>
        <?php endif; ?>

        <a href="instructor_dashboard.html"><button>Back to Dashboard</button></a>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
