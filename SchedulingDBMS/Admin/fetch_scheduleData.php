<?php
include 'db.php'; // Ensure your DB connection settings are correct

// SQL to fetch data. Adjust the table name and columns as per your database schema
$query = "SELECT RoomName, SectionCode, SubjectName, DayOfWeek, TimeStart, TimeEnd, AcademicYearStart, AcademicYearEnd, Semester, FacultyName, Position FROM schedule";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Room Name: " . $row["RoomName"]. " - Section: " . $row["SectionCode"]. " - Subject: " . $row["SubjectName"]. " - Day Of Week: " . $row["DayOfWeek"]. "<br>";
        echo "Start Time: " . $row["TimeStart"]. " - End Time: " . $row["TimeEnd"]. " - Academic Year Start: " . $row["AcademicYearStart"]. " - Academic Year End: " . $row["AcademicYearEnd"]. "<br>";
        echo "Semester: " . $row["Semester"]. " - Faculty Name: " . $row["FacultyName"]. " - Position: " . $row["Position"]. "<br><br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
