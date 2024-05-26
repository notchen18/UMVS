<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

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

header .nav-links .active {
    font-weight: bold;
    text-decoration: underline;
}

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

.dropdown-content a:hover {
    background-color: #f1f1f1;
}

.dropdown-content.show {
    display: block;
}

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
    border: 1px solid var(--primary-color);
}

</style>
</head>
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
            <a href="schedule_add.php" class="active">Room Schedules</a>
            <a href="faculty_addsched.php">Faculty Loads</a>
            <div class="dropdown">
                <button class="dropbtn" onclick="toggleDropdown()">Hi, Admin!</button>
                <div class="dropdown-content" id="dropdownContent">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="welcome-section">
    <h1>Welcome, Admin!</h1>
    <p>Welcome to your Admin Dashboard. Here you can manage room schedules and faculty loads efficiently. Use the tools provided to update, add, or remove entries, ensuring a smooth operational flow within our educational environment.</p>
    <button onclick="location.href='schedule_add.php'">Manage Room Schedule</button>
    <button onclick="location.href='faculty_addsched.php'">Manage Faculty Loads</button>
</section>

<script>
function toggleDropdown() {
    var dropdownContent = document.getElementById("dropdownContent");
    dropdownContent.classList.toggle('show');
}

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

</script>
</body>
</html>
