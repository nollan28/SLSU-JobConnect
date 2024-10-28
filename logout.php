<?php
session_start(); // Start the session
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
header("Location: login.php"); // Redirect to the login page
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="logout-message">
        <h2>You have been logged out successfully.</h2>
        <p><a href="login.php">Click here to login again.</a></p>
    </div>
</body>
</html>
