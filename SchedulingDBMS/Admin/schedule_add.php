
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="schedule_add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Room Schedules</title>
    <style>
    
    .display {
  background-color: var(--primary-color);
  padding: 20px;
  margin: 20px 45px;
  border-radius: 8px;
  opacity: 0.8;
  display: inline-block; /* Allow div to fit its content */
}

  .schedule-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 100px; 
    background-color: white;
  }

  .schedule-table th,
  .schedule-table td {
    border: 1px solid #000;
    padding: 8px;
    text-align: left;
  }

  .schedule-table th {
    background-color: #f2f2f2; /* Light gray background for header */
  }

  /* Faculty name row */
  .schedule-table th[colspan="11"] {
  background-color: #ccc; /* Dark gray background for faculty name */
  font-weight: bold;
  text-align: center; /* Center the content */
}
</style>
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
                    <li class="active"><a href="schedule_add.php">Room Schedules</a></li>
                    <li><a href="faculty_addsched.php">Faculty Loads</a></li>
                </ul>
            </nav>
            <div class="user-greeting" onclick="toggleDropdown()">
                <i class="fa fa-user-circle" aria-hidden="true"></i>
                <p>Hi, <strong>Admin</strong>!</p>
                <div id="logout-dropdown" class="dropdown-content">
                    <a href="http://localhost/schedulingdbms/LoginForm/login.php">Logout</a>
                </div>              
        </div>
    </header>

    <!-- Breadcrumbs -->
    <div class="main">
        <ul class="breadcrumb">
            <li><a href="#" class="breadcrumb-item active">Room Schedules</a></li>
            <li><a href="#" class="breadcrumb-item">Room</a></li>
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
        <button id="add-schedule-btn">Add Schedule</button>

        <!-- The Modal -->
        <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <iframe src="manage_schedule.php" frameborder="0" style="width:100%; height:100%;"></iframe>
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
    


    <!---Added Schedule -->
    <div class="add-schedule">
        
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

    <!-- Schedule Display -->
    <?php
include 'db.php';

$sql = "SELECT schedule.ScheduleID, rooms.RoomName, subjects.SubjectCode, subjects.SubjectName, sections.SectionCode, schedule.LaboratoryUnits, schedule.LectureUnits, faculty.FacultyName, faculty.Position, schedule.DayOfWeek, schedule.TimeStart, schedule.TimeEnd
        FROM schedule
        INNER JOIN rooms ON schedule.RoomID = rooms.RoomID
        INNER JOIN subjects ON schedule.SubjectID = subjects.SubjectID
        INNER JOIN sections ON schedule.SectionID = sections.SectionID
        INNER JOIN faculty ON schedule.FacultyID = faculty.FacultyID
        ORDER BY faculty.FacultyName"; // Sort by faculty name

$result = mysqli_query($conn, $sql);

$currentFaculty = null; // Track the current faculty
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row["FacultyName"] !== $currentFaculty) {
            // Start a new div container for each table
            if ($currentFaculty !== null) {
                echo "</table>"; // Close previous table if not the first iteration
                echo "</div>"; // Close previous div container
            }
            $currentFaculty = $row["FacultyName"]; // Update current faculty
            echo "<div class='display'>"; // Open new div container
            echo "<table class='schedule-table' border='1'>";
            echo "<tr><th colspan='11'>" . $row["FacultyName"] . "</th></tr>"; // Faculty name row
            echo "<tr><th colspan='11'>" . $row["Position"] . "</th></tr>"; // Position row
            echo "<tr><th>Room</th><th>Subject Code</th><th>Subject Description</th><th>Year/Block</th><th>Lab Units</th><th>Lec Units</th><th>Day of Week</th><th>Time Start</th><th>Time End</th><th>Action</th></tr>";
        }
        // Schedule row
        echo "<tr>";
        echo "<td>" . $row["RoomName"] . "</td>";
        echo "<td>" . $row["SubjectCode"] . "</td>";
        echo "<td>" . $row["SubjectName"] . "</td>";
        echo "<td>" . $row["SectionCode"] . "</td>";
        echo "<td>" . $row["LaboratoryUnits"] . "</td>";
        echo "<td>" . $row["LectureUnits"] . "</td>";
        echo "<td>" . $row["DayOfWeek"] . "</td>";
        echo "<td>" . $row["TimeStart"] . "</td>";
        echo "<td>" . $row["TimeEnd"] . "</td>";
        echo "<td><a href='edit_schedule.php?id=" . $row["ScheduleID"] . "'>Edit</a> | <a href='delete_schedule.php?id=" . $row["ScheduleID"] . "'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>"; // Close the last table
    echo "</div>"; // Close the last div container
} else {
    echo "0 results";
}

mysqli_close($conn);
?>


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