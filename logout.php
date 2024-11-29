<?php
// Start the session
session_start();

// Destroy the session and clear session variables
session_unset();
session_destroy();

// Clear the cache to prevent back button access
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redirect to login page
header("Location: login.html");
exit();
?>
