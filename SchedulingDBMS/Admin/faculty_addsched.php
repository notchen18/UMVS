<?php include 'db.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="faculty_addsched.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>USeP Mintal Virtual Scheduling</title>
</head>
<body>
    <header>
        <img src="img/CDMlogo1.png" alt="University Logo" id="university-logo"/>
        <div class="header-title">
            <h1>USeP Mintal Virtual Scheduling</h1>
        </div>
        <div class="header-main">
            <nav>
                <ul>
                    <li><a href="schedule_add.php">Room Schedules</a></li>
                    <li class="active"><a href="faculty_addsched.php">Faculty Loads</a></li>
                </ul>
            </nav>
            <div class="user-greeting" onclick="toggleDropdown()">
                <i class="fa fa-user-circle" aria-hidden="true"></i>
                <p>Hi, <strong>Admin</strong>!</p>
                <div id="logout-dropdown" class="dropdown-content">
                    <a href="../LoginForm/login.php">Logout</a>
                </div>              
        </div>
    </header>

    <!-- Breadcrumbs -->
    <div class="main">
        <ul class="breadcrumb">
            <li><a href="#" class="breadcrumb-item active">Faculty Loads</a></li>
            <li><a href="#" class="breadcrumb-item">Faculty</a></li>
        </ul>
    </div>

     <!-- Search bar container -->
     <div class="search-container">
        <input type="text" id="search-box" placeholder="Search...">
        <button onclick="searchFunction()" id="search-btn">
            <i class="fa fa-search"></i>
        </button>
    </div>

    <!-- Trigger/Open The Modal -->
    <button id="add-schedule-btn">Add Faculty</button>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="iframe-container">
            <iframe src="manage_faculty.php" frameborder="0"></iframe>
        </div>
    </div>
    </div>

    <div class="filter-dropdown-container">
        <label for="semester-dropdown">Semester:</label>
        <select id="semester-dropdown" name="semester">
            <option value="">Select Semester</option>
            <!-- Add semester options here -->
        </select>
    
        <label for="year-dropdown">School Year:</label>
        <select id="year-dropdown" name="school_year">
            <option value="">Select School Year</option>
            <!-- Add school year options here -->
        </select>
    
        <button onclick="applyFilters()">Filter</button>
    </div>

    <!-- Container to display the filtered data -->
    <div class="room">
    <div id="data-container">
        <!-- Data will be displayed here -->
    </div>
    </div> 
    <div class="faculty-loads">
        <div id="data-container">
            <!-- Data will be displayed here -->
        </div>
        </div> 
    <!-- Display -->
    <div class="display">
    </div>
    
    

<!--JS Script -->
    <script>
        function searchFunction() {
            var query = document.getElementById('search-box').value.trim();
            if (query) {
                // Perform search operation here
                console.log("Searching for:", query);
                // You may want to call a backend service or filter content on the page.
            }
        }

        function searchFunction() {
    // Existing search function code
}

// Toggle the dropdown
function toggleDropdown() {
    var dropdown = document.getElementById("logout-dropdown");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("add-schedule-btn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}




</script>
</body>
</html>