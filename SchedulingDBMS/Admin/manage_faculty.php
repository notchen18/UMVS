<?php 
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle regular inputs
    $RoomName = isset($_POST["RoomName"]) ? (is_array($_POST["RoomName"]) ? 'Error: Array given' : mysqli_real_escape_string($conn, $_POST["RoomName"])) : "";
    $SubjectCode = isset($_POST["SubjectCode"]) ? (is_array($_POST["SubjectCode"]) ? 'Error: Array given' : mysqli_real_escape_string($conn, $_POST["SubjectCode"])) : "";
    $SubjectName = isset($_POST["SubjectName"]) ? (is_array($_POST["SubjectName"]) ? 'Error: Array given' : mysqli_real_escape_string($conn, $_POST["SubjectName"])) : "";
    $LaboratoryUnits = isset($_POST["LaboratoryUnits"]) ? (float)$_POST["LaboratoryUnits"] : 0;
    $LectureUnits = isset($_POST["LectureUnits"]) ? (float)$_POST["LectureUnits"] : 0;
    $TimeStart = isset($_POST["TimeStart"]) ? mysqli_real_escape_string($conn, $_POST["TimeStart"]) : "";
    $TimeEnd = isset($_POST["TimeEnd"]) ? mysqli_real_escape_string($conn, $_POST["TimeEnd"]) : "";
    $AcademicYearStart = isset($_POST["AcademicYearStart"]) ? mysqli_real_escape_string($conn, $_POST["AcademicYearStart"]) : "";
    $AcademicYearEnd = isset($_POST["AcademicYearEnd"]) ? mysqli_real_escape_string($conn, $_POST["AcademicYearEnd"]) : "";
    $Semester = isset($_POST["Semester"]) ? mysqli_real_escape_string($conn, $_POST["Semester"]) : "";
    $FacultyName = isset($_POST["FacultyName"]) ? mysqli_real_escape_string($conn, $_POST["FacultyName"]) : "";
    $FacultyLoads = isset($_POST["FacultyLoad"]) ? (float)$_POST["FacultyLoad"] : 0;
    $Position = isset($_POST["Position"]) ? mysqli_real_escape_string($conn, $_POST["Position"]) : "";

    // Handle array inputs for DayOfWeek
    $DayOfWeek = isset($_POST["DayOfWeek"]) ? $_POST["DayOfWeek"] : [];
    $SectionCode = isset($_POST["SectionCode"]) ? $_POST["SectionCode"] : [];

    if (is_array($DayOfWeek)) {
        $DayOfWeek = array_map(function($day) use ($conn) {
            return mysqli_real_escape_string($conn, $day);
        }, $DayOfWeek);
        $DayOfWeek = implode(", ", $DayOfWeek);
    } else {
        $DayOfWeek = mysqli_real_escape_string($conn, $DayOfWeek);
    }

    if (is_array($SectionCode)) {
        $SectionCode = array_map(function($code) use ($conn) {
            return mysqli_real_escape_string($conn, $code);
        }, $SectionCode);
        $SectionCode = implode(", ", $SectionCode);
    } else {
        $SectionCode = mysqli_real_escape_string($conn, $SectionCode);
    }

    // SQL to insert data
    $sql = "INSERT INTO schedule (RoomName, SubjectCode, SubjectName, SectionCode, LaboratoryUnits, LectureUnits, DayOfWeek, TimeStart, TimeEnd, AcademicYearStart, AcademicYearEnd, Semester, FacultyName, FacultyLoads, Position)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        echo "Error with prepare statement: " . mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "ssssddsssssssd", $RoomName, $SubjectCode, $SubjectName, $SectionCode, $LaboratoryUnits, $LectureUnits, $DayOfWeek, $TimeStart, $TimeEnd, $AcademicYearStart, $AcademicYearEnd, $Semester, $FacultyName, $FacultyLoads, $Position);
        if (mysqli_stmt_execute($stmt)) {
            echo "New record added successfully!";
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACULTY LOADS</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .form {
            background-color: #F5F5F8;
            max-width: 900px;
            margin: auto;
            padding: 20px;
            width: 90%;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .form-column {
            display: flex;
            flex-wrap: wrap; /* Responsive column wrapping */
            justify-content: space-between;
        }

        .column {
            flex: 1 1 30%; /* Flexible width with a minimum */
            margin: 10px; /* Spacing between columns */
            min-width: 250px; /* Usability on smaller screens */
        }

        .form-group {
            margin-bottom: 20px; /* Visual separation */
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"], .form-group input[type="number"], .form-group select {
            width: 200px; /* Fixed width for input fields */
            padding: 12px 10px; /* Increased padding for better visual spacing */
            font-size: 14px; /* Smaller font size */
            margin-bottom: 5px; /* Maintain margin for layout consistency */
            border: 1px solid #ccc; /* Adds a border for better field definition */
        }

        .form-group input[type="time"] {
            width: 200px; /* Fixed width */
            padding: 12px 10px; /* Consistent padding with other inputs */
            border: 1px solid #ccc; /* Border for consistency */
        }

        .footer {
            text-align: right;
        }

        .button {
            margin-top: 5px;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px; /* Space between buttons */
        }

        .submit-button {
            background-color: #4CAF50;
            color: white;
        }

        .cancel-button {
            background-color: #747474;
            color: white;
        }

        .submit-button:hover, .cancel-button:hover {
            opacity: 0.85;
        }

        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            .form-column {
                flex-direction: column;
            }

            .column {
                flex: 1 1 100%; /* Each column takes full width */
            }

            .footer {
                text-align: center; /* Center alignment for better appearance on small screens */
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px; /* Less padding for very small screens */
            }

            .form {
                padding: 10px; /* Reduced padding */
            }

            .button {
                width: 100%; /* Full width buttons for easier access */
                margin-top: 10px; /* More vertical space between buttons */
            }
        }
    </style>
</head>
<body>
<div class="form">
    <h2>EDIT A FACULTY LOAD</h2>
    <hr>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- Columns -->
        <div class="form-column">
            <!-- First Column -->
            <div class="column">
                <div class="form-group">
                        <label for="facultyName">Faculty Name: <span style="color: red;">*</span></label>
                        <input type="text" id="facultyName" name="facultyName" required>
                </div>
                
                <div class="form-group">
                    <label for="position">Position: <span style="color: red;">*</span></label>
                    <input type="text" id="position" name="position" required>
                </div>

                <div class="form-group">
                    <label for="subjectCode">Subject Code: <span style="color: red;">*</span></label>
                    <select id="subjectCode" name="subjectCode" class="form-control select2" required>
                                    <option value="">Select a code</option>
                                    <option value="AE 121">AE 121</option>
                                    <option value="AE 122">AE 122</option>
                                    <option value="AE 221">AE 221</option>
                                    <option value="AE 222">AE 222</option>
                                    <option value="AE 223">AE 223</option>
                                    <option value="AE 321">AE 321</option>
                                    <option value="AE 322">AE 322</option>
                                    <option value="AE 323">AE 323</option>
                                    <option value="AE 325">AE 325</option>
                                    <option value="AE 423">AE 423</option>
                                    <option value="AGB 121">AGB 121</option>
                                    <option value="AGB 122">AGB 122</option>
                                    <option value="AGB 223">AGB 223</option>
                                    <option value="AGB 321">AGB 321</option>
                                    <option value="AGB 423">AGB 423</option>
                                    <option value="Ag Eng 221">Ag Eng 221</option>
                                    <option value="Ag Ext 221">Ag Ext 221</option>
                                    <option value="Ani Sci 122">Ani Sci 122</option>
                                    <option value="Anth 321">Anth 321</option>
                                    <option value="Anth 322">Anth 322</option>
                                    <option value="Anth Elec 324">Anth Elec 324</option>
                                    <option value="CD 121">CD 121</option>
                                    <option value="CD 122">CD 122</option>
                                    <option value="CD 221">CD 221</option>
                                    <option value="CD 222">CD 222</option>
                                    <option value="CD 223">CD 223</option>
                                    <option value="CD 322">CD 322</option>
                                    <option value="CD 325">CD 325</option>
                                    <option value="CD 323">CD 323</option>
                                    <option value="CD Elec 2">CD Elec 2</option>
                                    <option value="CDM 200">CDM 200</option>
                                    <option value="CDM 201">CDM 201</option>
                                    <option value="CDM 202">CDM 202</option>
                                    <option value="CDM 301">CDM 301</option>
                                    <option value="CDRM 200">CDRM 200</option>
                                    <option value="CDRM 201">CDRM 201</option>
                                    <option value="Crop Prot 222">Crop Prot 222</option>
                                    <option value="Crop Sci 122">Crop Sci 122</option>
                                    <option value="DA 203">DA 203</option>
                                    <option value="DA 301">DA 301</option>
                                    <option value="DC 200">DC 200</option>
                                    <option value="DC 201">DC 201</option>
                                    <option value="DC 202">DC 202</option>
                                    <option value="DC 203">DC 203</option>
                                    <option value="DC 204">DC 204</option>
                                    <option value="DRA 300">DRA 300</option>
                                    <option value="DRA 301">DRA 301</option>
                                    <option value="DRA 302">DRA 302</option>
                                    <option value="DRA 303">DRA 303</option>
                                    <option value="EGE 311">EGE 311</option>
                                    <option value="EGE 312">EGE 312</option>
                                    <option value="EGE 313">EGE 313</option>
                                    <option value="GE 112">GE 112</option>
                                    <option value="GE 113">GE 113</option>
                                    <option value="GE 114">GE 114</option>
                                    <option value="GE 211">GE 211</option>
                                    <option value="GE 215">GE 215</option>
                                    <option value="GE 216">GE 216</option>
                                    <option value="GE 217">GE 217</option>
                                    <option value="GE 218">GE 218</option>
                                    <option value="LGA 200">LGA 200</option>
                                    <option value="LGA 201">LGA 201</option>
                                    <option value="LGA 202">LGA 202</option>
                                    <option value="LGA 203">LGA 203</option>
                                    <option value="OS 200">OS 200</option>
                                    <option value="OS 201">OS 201</option>
                                    <option value="OS 202">OS 202</option>
                                    <option value="PA 112">PA 112</option>
                                    <option value="PA 121">PA 121</option>
                                    <option value="PA 221">PA 221</option>
                                    <option value="PA 322">PA 322</option>
                                    <option value="PA 323">PA 323</option>
                                    <option value="PA 442">PA 442</option>
                                    <option value="PA core 4">PA core 4</option>
                                    <option value="Pa 222">Pa 222</option>
                                    <option value="PFA 200">PFA 200</option>
                                    <option value="PFA 201">PFA 201</option>
                                    <option value="PFA 202">PFA 202</option>
                                    <option value="PFA 203">PFA 203</option>
                                    <option value="PPPA 200">PPPA 200</option>
                                    <option value="PPPA 203">PPPA 203</option>
                                    <option value="RM 200">RM 200</option>
                                    <option value="RM 201">RM 201</option>
                                    <option value="RM 222">RM 222</option>
                                    <option value="RM 325">RM 325</option>
                                    <option value="SDA 200">SDA 200</option>
                                    <option value="Soil Sci 221">Soil Sci 221</option>
                                    <option value="UEP 200">UEP 200</option>
                                    <option value="UEP 205">UEP 205</option>
                    </select>
                </div>

                    <div class="form-group">
                        <label for="SubjectName">Subject: <span style="color: red;">*</span></label>
                            <select id="SubjectName" name="SubjectName" class="form-control select2" required>
                                    <option value="">Select a subject</option>
                                    <option value="Accounting for Community-based Enterprises">Accounting for Community-based Enterprises</option>
                                    <option value="Administrative Law">Administrative Law</option>
                                    <option value="Advance Data Analytics">Advance Data Analytics</option>
                                    <option value="Agricultural Economics Statistics">Agricultural Economics Statistics</option>
                                    <option value="Agricultural Extension and Communication">Agricultural Extension and Communication</option>
                                    <option value="Agribusiness Research Methods">Agribusiness Research Methods</option>
                                    <option value="Anthropology Elective 4">Anthropology Elective 4</option>
                                    <option value="Basic Data Analytics">Basic Data Analytics</option>
                                    <option value="Basic Farm Structures and Machineries">'Basic Farm Structures and Machineries</option>
                                    <option value="Climate Change Adaptation and Humanitarian Action">Climate Change Adaptation and Humanitarian Action</option>
                                    <option value="Collaborative Governance and Crisis and Disaster Resilience">Collaborative Governance and Crisis and Disaster Resilience</option>
                                    <option value="Communication Strategies for Community Development">Communication Strategies for Community Development</option>
                                    <option value="Communication, Social Marketing and Mobilization">Communication, Social Marketing and Mobilization</option>
                                    <option value="Comm. and Development: Concept & Approaches">Comm. and Development: Concept & Approaches</option>
                                    <option value="Contemporary World">Contemporary World</option>
                                    <option value="Development">Development</option>
                                    <option value="Development and Governance: Dialectics of Theory & Practice">Development and Governance: Dialectics of Theory & Practice</option>
                                    <option value="Development Communication and Social Media">Development Communication and Social Media</option>
                                    <option value="Development Economics">Development Economics</option>
                                    <option value="Discrete Choice Analysis">Discrete Choice Analysis</option>
                                    <option value="Educational Strategies for Community Development">Educational Strategies for Community Development</option>
                                    <option value="Environmental Economics">Environmental Economics</option>
                                    <option value="Environmental Laws and Administration">Environmental Laws and Administration</option>
                                    <option value="Ethics">Ethics</option>
                                    <option value="Ethno-biology">Ethno-biology</option>
                                    <option value="Farm Management">Farm Management</option>
                                    <option value="Foreign Language 2">Foreign Language 2</option>
                                    <option value="Fundamentals of Horticulture">Fundamentals of Horticulture</option>
                                    <option value="Gender and Society">Gender and Society</option>
                                    <option value="Government Accounting, Auditing, and Financial Control">Government Accounting, Auditing, and Financial Control</option>
                                    <option value="Human Capital Management">Human Capital Management</option>
                                    <option value="ICT and Knowledge Management in Dev.Comm.">ICT and Knowledge Management in Dev.Comm.</option>
                                    <option value="Introduction to Agribusiness Management">Introduction to Agribusiness Management</option>
                                    <option value="Introduction to Livestock and Poultry Production">Introduction to Livestock and Poultry Production</option>
                                    <option value="Introduction to Public Policy">Introduction to Public Policy</option>
                                    <option value="Intermediate Microeconomic Theory">Intermediate Microeconomic Theory</option>
                                    <option value="International Development Theory and Policy">International Development Theory and Policy</option>
                                    <option value="Leadership and Change Management">Leadership and Change Management</option>
                                    <option value="Local Development Planning and Policy">Local Development Planning and Policy</option>
                                    <option value="Local Resource Management">Local Resource Management</option>
                                    <option value="Local-National Agency Collaboration in Public Service">Local-National Agency Collaboration in Public Service</option>
                                    <option value="Macroeconomics">Macroeconomics</option>
                                    <option value="Managerial Economics">Managerial Economics</option>
                                    <option value="Mathematical Economics">Mathematical Economics</option>
                                    <option value="Mathematics in the Modern World">Mathematics in the Modern World</option>
                                    <option value="Methods of Program Impact Evaluation">Methods of Program Impact Evaluation</option>
                                    <option value="Organizing and Social Movements">Organizing and Social Movements</option>
                                    <option value="Participatory Action Research: Theory and Practice">Participatory Action Research: Theory and Practice</option>
                                    <option value="Philippine Indigenous Communities">Philippine Indigenous Communities</option>
                                    <option value="Philippine National Expenditure Planning">Philippine National Expenditure Planning</option>
                                    <option value="Philippine Society and Community Development">Philippine Society and Community Development</option>
                                    <option value="Planning and Administration in Community Development">Planning and Administration in Community Development</option>
                                    <option value="Plant Pathology">Plant Pathology</option>
                                    <option value="Policies, Programs and Services to Community Development">Policies, Programs and Services to Community Development</option>
                                    <option value="Political Economy">Political Economy</option>
                                    <option value="Political Economy and Development">Political Economy and Development</option>
                                    <option value="Practices of Crop Production">Practices of Crop Production</option>
                                    <option value="Predictive Analytics & Machine Learning">Predictive Analytics & Machine Learning</option>
                                    <option value="Principles of Accounting">Principles of Accounting</option>
                                    <option value="Principles of Soil Science">Principles of Soil Science</option>
                                    <option value="Project Feasibility Study">Project Feasibility Study</option>
                                    <option value="Project Monitoring and Evaluation">Project Monitoring and Evaluation</option>
                                    <option value="Public Expenditure Management">Public Expenditure Management</option>
                                    <option value="Public Fiscal Administration">Public Fiscal Administration</option>
                                    <option value="Public Policy and Program Administration">Public Policy and Program Administration</option>
                                    <option value="Purposive Communication">Purposive Communication</option>
                                    <option value="Qualitative Methods of Research">Qualitative Methods of Research</option>
                                    <option value="Qualitative Research Method">Qualitative Research Method</option>
                                    <option value="Quantitative Research Methods">Quantitative Research Methods</option>
                                    <option value="Readings in the Philippine History">Readings in the Philippine History</option>
                                    <option value="Revenue and Treasury Management">Revenue and Treasury Management</option>
                                    <option value="Science, Technology, and Society">Science, Technology, and Society</option>
                                    <option value="Special Problem in Development Administration">Special Problem in Development Administration</option>
                                    <option value="Special Problems in Development Communication">Special Problems in Development Communication</option>
                                    <option value="Special Topics in Community Organizing">Special Topics in Community Organizing</option>
                                    <option value="Spatial Analysis">Spatial Analysis</option>
                                    <option value="Statistics for Social Science">Statistics for Social Science</option>
                                    <option value="Strategic Foresight in Development Communication">Strategic Foresight in Development Communication</option>
                                    <option value="Strategic Knowledge Management">Strategic Knowledge Management</option>
                                    <option value="Strategic Research and Development Management">Strategic Research and Development Management</option>
                                    <option value="Technical Writing">Technical Writing</option>
                                    <option value="The Life and Works of Rizal">The Life and Works of Rizal</option>
                                    <option value="Thesis">Thesis</option>
                                    <option value="Understanding the Self">Understanding the Self</option>
                                </select>
                    </div>

                <div class="form-group">
                    <label for="SectionCode">Section/Block: <span style="color: red;">*</span></label>
                        <select id="SectionCode" name="SectionCode[]" multiple="multiple" class="form-control select2" required>
                                    <option value="BPA 1A">BPA 1A</option>
                                    <option value="BPA 1B">BPA 1B</option>
                                    <option value="BPA 2">BPA 2</option>
                                    <option value="BSAB 1A">BSAB 1A</option>
                                    <option value="BSAB 2A">BSAB 2A</option>
                                    <option value="BSAB 3A">BSAB 3A</option>
                                    <option value="BSAE 1A">BSAE 1A</option>
                                    <option value="BSAE 2'">BSAE 2'</option>
                                    <option value="BSBA 1A">BSBA 1A</option>
                                    <option value="BSCD">BSCD</option>
                                    <option value="BSCD 1">BSCD 1</option>
                                    <option value="BSCD 1A">BSCD 1A</option>
                                    <option value="BSCD 2">BSCD 2</option>
                                    <option value="BSDA 3">BSDA 3</option>
                                    <option value="MPA">MPA</option>
                                    <option value="MSDC-1">MSDA</option>
                                    <option value="MSDC-1/MSDA">MSDC-1</option>
                        </select>
                </div>
            </div>
            
            <!-- Second Column -->
            <div class="column">
                <div class="form-group">
                    <label for="room">Room: <span style="color: red;">*</span></label>
                    <input type="text" id="room" name="room" required>
                </div>

                <div class="form-group">
                    <label for="daysOfWeek">Days Of the Week: <span style="color: red;">*</span></label>
                    <select id="DayOfWeek" name="DayOfWeek[]" multiple="multiple" class="form-control select2">
                        <option value="MON">MON</option>
                        <option value="TUE">TUE</option>
                        <option value="WED">WED</option>
                        <option value="THU">THU</option>
                        <option value="FRI">FRI</option>
                        <option value="SAT">SAT</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="timeFrom">Time From: <span style="color: red;">*</span></label>
                    <input type="time" id="timeFrom" name="timeFrom" required>
                </div>
                <div class="form-group">
                    <label for="timeTo">Time To: <span style="color: red;">*</span></label>
                    <input type="time" id="timeTo" name="timeTo" required>
                </div>
                <div class="form-group">
                    <label for="facultyLoad">Faculty Load: <span style="color: red;">*</span></label>
                    <input type="number" id="facultyLoad" name="facultyLoad" step="0.1" required>
                </div>
            </div>

            <!-- Third Column -->
            <div class="column">
                <div class="form-group">
                    <label for="lectureUnit">Lecture Unit: <span style="color: red;">*</span></label>
                    <input type="number" id="lectureUnit" name="lectureUnit" required>
                </div>
                <div class="form-group">
                    <label for="laboratoryUnit">Laboratory Unit: <span style="color: red;">*</span></label>
                    <input type="number" id="laboratoryUnit" name="laboratoryUnit" required>
                </div>
                <div class="form-group">
                    <label for="AcademicYearStart">Acad Yr. Start: <span style="color: red;">*</span></label>
                    <input type="number" id="AcademicYearStart" name="AcademicYearStart" required min="2024">
                </div>
                <div class="form-group">
                    <label for="cademicYearEnd">Acad Yr. End: <span style="color: red;">*</span></label>
                    <input type="number" id="AcademicYearEnd" name="AcademicYearEnd" required min="2025">
                </div>
                <div class="form-group">
                    <label for="Semester">Semester: <span style="color: red;">*</span></label>
                    <select id="Semester" name="Semester" required>
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                        <option value="Offset Semester">Offset Semester</option>
                    </select>
                </div>
            </div>
        </div>
    <form>
    <hr>
            <div class="footer">
                <input type="submit" class="button submit-button" value="Submit">
                <button type="button" class="button cancel-button" onclick="window.history.back();">Cancel</button>
        
            </div>
    </div>

    <!-- Script tags and other HTML elements -->
    
<script>
    $(document).ready(function() {
        $('.select2').select2({
            closeOnSelect: false,
            placeholder: "Select an option"
        });
    });
    function enforceAlphabeticInput(event) {
        var keyCode = event.keyCode || event.which;
        var keyValue = String.fromCharCode(keyCode);
        if (!/^[a-zA-Z\s]*$/.test(keyValue))
            event.preventDefault();
    }

    document.getElementById('RoomName').addEventListener('keypress', enforceAlphabeticInput);
    document.getElementById('FacultyName').addEventListener('keypress', enforceAlphabeticInput);
    document.getElementById('Position').addEventListener('keypress', enforceAlphabeticInput);
</script>

</body>
</html>