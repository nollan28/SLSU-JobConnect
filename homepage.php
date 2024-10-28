<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

// Set the timezone
date_default_timezone_set('America/New_York');

// Get the current date
$currentDate = date('l, F j, Y');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Jobconnect</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('background.png'); /* Replace with your image URL */
            background-size: cover;
            background-position: center;
            color: #333;
        }
        header {
            background: rgba(0, 123, 255, 0.8);
            color: white;
            padding: 10px 0;
            text-align: center;
            position: relative;
        }
        .menu-icon {
            display: block;
            font-size: 30px;
            cursor: pointer;
            position: absolute;
            left: 20px;
            top: 10px;
            z-index: 1000;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        footer {
            text-align: center;
            padding: 10px 0;
            background: rgba(0, 123, 255, 0.8);
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        img.profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 20px 0;
        }
        .welcome-message {
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        .nav-menu {
            display: none;
            position: absolute;
            top: 50px;
            left: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 999;
            width: 200px; /* Adjust width as needed */
        }
        .nav-menu a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
        }
        .nav-menu a:hover {
            background: rgba(0, 123, 255, 0.1);
        }
        @media (max-width: 768px) {
            .menu-icon {
                display: block;
            }
            .nav-menu {
                width: 100%;
            }
        }
    </style>
    <script>
        function toggleMenu() {
            const menu = document.getElementById('nav-menu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</head>
<body>

<header>
    <div class="menu-icon" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
    <h1>Welcome to Jobconnect</h1>
    <div id="nav-menu" class="nav-menu">
        <a href="#">Home</a>
        <a href="profile.php">Profile</a>
        <a href="settings.php">Settings</a>
        <a href="login.php">Logout</a>
    </div>
</header>

<div class="container">
    <h2 class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    
    <img src="profile-placeholder.png" alt="Profile Picture" class="profile-pic"> <!-- Placeholder for user image -->

    <h2>Current Date</h2>
    <p><?php echo $currentDate; ?></p>

    <h2>About Me</h2>
    <p>This is a simple homepage built using PHP. You can customize this section to include more information about yourself or your projects. Consider adding your skills, experiences, and links to your work.</p>

    <h2>Contact</h2>
    <p>If you'd like to get in touch, feel free to reach out via email at <a href="mailto:example@example.com">example@example.com</a>.</p>

    <h2>Recent Activities</h2>
    <ul>
        <li>Completed a project on web development.</li>
        <li>Attended a seminar on PHP best practices.</li>
        <li>Contributed to open-source projects.</li>
    </ul>
</div>

<footer>
    <p>&copy; <?php echo date('Y'); ?> JobConnect</p>
</footer>

</body>
</html>
