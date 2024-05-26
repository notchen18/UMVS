<?php
session_start();

// Check if the user is logged in and if their role is 'faculty'
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'faculty') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href="faculty.css">
</head>
<style>
:root {
    --primary-color: #6c1606; 
    --secondary-color: #f0ad4e;
    --tertiary-color: #dadada; 
}

body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-image: url('img/BG3.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    color: var(--primary-color);
}

header .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0px 50px;
    background: var(--secondary-color);
}

.logo-and-title {
    display: flex;
    align-items: center;
}

.logo img {
    width: 100px;
    height: auto;
}

.header-title {
    margin-left: 20px;
    color: white;
    font-size: 24px;
    font-weight: bold;
}

header .nav-links a {
    text-decoration: none;
    color: var(--primary-color);
    margin: 0 15px;
    font-size: 16px;
}

header .nav-links a:hover {
    color: #ffffff;
}
/* Dropdown Button */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropbtn {
    background-color: var(--secondary-color);
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

/* Dropdown Content - hidden initially */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}
.welcome-section {
    max-width: 600px;
    margin: 100px auto;
    text-align: center;
    background: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.50);
}

.welcome-section h1 {
    color: var(--primary-color);
}

.welcome-section p {
    font-size: 16px;
    color: var(--primary-color);
    line-height: 1.6;
}

button {
    padding: 10px 20px;
    margin-top: 20px;
    border: none;
    background-color: var(--primary-color);
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #ffffff;
    color: var(--primary-color);
}
</style>
<body>
<header>
    <div class="navbar">
        <div class="logo-and-title">
            <a href="#home" class="logo">
                <img src="img/CDMlogo1.png" alt="Home Logo" style="height: auto; width: 100px;">
            </a>
            <span class="header-title">USeP Mintal Virtual Scheduling</span>
        </div>
        <div class="nav-links">
            <a href="room_schedule_view.php">Room Schedule</a>
            <a href="faculty_loads_view.php">Faculty Loads</a>
            <!-- Clickable Dropdown Menu for Logout -->
            <div class="dropdown">
                <button class="dropbtn" onclick="toggleDropdown()">Hi, Faculty <i class="arrow down"></i></button>
                <div class="dropdown-content" id="dropdownContent">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>
    <section class="welcome-section">
        <h1>Welcome, Faculty Member!</h1>
        <p>Welcome to your Faculty Dashboard. This is your hub for accessing room schedules and your specific faculty loads. Here you can view up-to-date information on your class timings and locations, helping you plan your schedule effectively.</p>
        <button onclick="location.href='room_schedule_view.php'">View Room Schedule</button> 
        <button onclick="location.href='faculty_loads_view.php'">View Faculty Loads</button>

<script>
function toggleDropdown() {
    var dropdownContent = document.getElementById("dropdownContent");
    if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
    } else {
        dropdownContent.style.display = "block";
    }
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === "block") {
                openDropdown.style.display = "none";
            }
        }
    }
}
</script>
</body>
</html>