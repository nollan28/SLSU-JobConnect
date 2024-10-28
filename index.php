<?php
session_start();

// Database configuration
$host = "localhost"; // Your database host
$db_username = "root"; // Your actual database username
$db_password = ""; // Your actual database password
$db_name = "SLSU";

// Create a connection
$conn = new mysqli($host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$name = $db_username = $email = $student_id = $department = $year_level = $major = "";
$password = $confirm_password = "";
$error_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $db_username = $_POST['username'];
    $email = $_POST['email'];
    $student_id = $_POST['student_id'];
    $department = $_POST['department'];
    $year_level = $_POST['year_level'];
    $major = $_POST['major'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Simple validation
    if (empty($name) || empty($db_username) || empty($email) || empty($student_id) ||
        empty($department) || empty($year_level) || empty($major) || 
        empty($password) || empty($confirm_password)) {
        $error_message = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Check if username or email already exists
        $stmt = $conn->prepare("SELECT * FROM jobcon WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $db_username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error_message = "Username or email already exists.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO jobcon (username, name, email, student_id, department, year_level, major, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $db_username, $name, $email, $student_id, $department, $year_level, $major, $hashed_password);

            // Execute the statement
            if ($stmt->execute()) {
                $_SESSION['registered'] = true;
                $_SESSION['username'] = $db_username;
                header("Location: login.php"); // Redirect to login page
                exit();
            } else {
                $error_message = "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="indexstyle.css">

    <style>
        label {
            font-weight: bold; /* Make all labels bold */
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Register</h2>
            <?php if ($error_message): ?>
                <p style="color:red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form method="post" action="">
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                </div>
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($db_username); ?>" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div>
                    <label for="student_id">Student ID:</label>
                    <input type="text" id="student_id" name="student_id" value="<?php echo htmlspecialchars($student_id); ?>" required>
                </div>
                <div class="textbox">
                    <label for="department">Department:</label>
                    <select id="department" name="department" required>
                        <option value="" disabled selected>Select your department</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Business">Business</option>
                        <option value="Mathematics">Mathematics</option>
                    </select>
                </div>
                <div class="textbox">
                    <label for="year_level">Year Level:</label>
                    <select id="year_level" name="year_level" required>
                        <option value="" disabled selected>Select your year level</option>
                        <option value="Freshman">Freshman</option>
                        <option value="Sophomore">Sophomore</option>
                        <option value="Junior">Junior</option>
                        <option value="Senior">Senior</option>
                    </select>
                </div>
                <div class="textbox">
                    <label for="major">Major:</label>
                    <select id="major" name="major" required>
                        <option value="" disabled selected>Select your major</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Electrical Engineering">Electrical Engineering</option>
                        <option value="Business Administration">Business Administration</option>
                        <option value="Mathematics">Mathematics</option>
                    </select>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <div>
                    <br>
                    <button type="submit">Register</button>
                </div>
            </form>
            <p>Log in as Admin <a href="admin.php">Login</a>.</p>
            <p>Already have an account? <a href="login.php">Login</a>.</p>
        </div>
    </div>
</body>
</html>
