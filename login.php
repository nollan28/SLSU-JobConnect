<?php
session_start();

// Database configuration
$host = "localhost"; // Database host
$db_username = "root"; // Database username
$db_password = ""; // Database password
$db_name = "SLSU"; // Database name

// Create a connection
$conn = new mysqli($host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$db_username = "";
$password = "";
$error_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db_username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare statement to check if the user exists
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $db_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user's hashed password from the database
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $db_username;
            header("Location: homepage.php"); // Redirect to welcome page
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        // No such username found in the database
        $error_message = "Username or password does not exist.";
    }

    // Close statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to the CSS file -->

    <style>
        label {
            font-weight: bold; /* Make all labels bold */
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Login</h2>
            <?php if ($error_message): ?>
                <p style="color:red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form method="post" action="">
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <br>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <br>
                    <br>
                    <button type="submit">Login</button>
                </div>
            
            </form>
            <p>Log in as Admin <a href="admin.php">Login</a>.</p>
            <p>Don't have an account? <a href="index.php">Register</a>.</p>
        </div>
    </div>
</body>
</html>
