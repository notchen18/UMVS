<?php include 'db.php' ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $RoomName = $_POST["RoomName"];
    $SectionCodes = $_POST["SectionCode"];
    $SubjectName = $_POST["SubjectName"];
    $SectionCode = $_POST["SectionCode"]; 
    $LaboratoryUnits = $_POST["LaboratoryUnits"];
    $LectureUnits = $_POST["LectureUnits"];
    $DayOfWeek = $_POST["DayOfWeek"];
    $TimeStart = $_POST["TimeStart"];
    $TimeEnd = $_POST["TimeEnd"];
    $AcademicYearStart = $_POST["AcademicYearStart"];
    $AcademicYearEnd = $_POST["AcademicYearEnd"];
    $Semester = $_POST["Semester"];
    $FacultyName = $_POST["FacultyName"];
    $Position = $_POST["Position"];

    // Fetch Room ID
    $roomQuery = "SELECT RoomID FROM rooms WHERE RoomName = ?";
    if ($roomStmt = mysqli_prepare($conn, $roomQuery)) {
        mysqli_stmt_bind_param($roomStmt, "s", $RoomName);
        mysqli_stmt_execute($roomStmt);
        mysqli_stmt_bind_result($roomStmt, $roomID);
        mysqli_stmt_fetch($roomStmt);
        mysqli_stmt_close($roomStmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    
    $subjectStmt = mysqli_prepare($conn, "SELECT SubjectID FROM subjects WHERE SubjectCode = ? AND SubjectName = ?");
    mysqli_stmt_bind_param($subjectStmt, "ss", $SubjectCode, $SubjectName);
    mysqli_stmt_execute($subjectStmt);
    mysqli_stmt_bind_result($subjectStmt, $subjectID);
    mysqli_stmt_fetch($subjectStmt);
    mysqli_stmt_close($subjectStmt);

    $sectionQuery = "SELECT SectionID FROM sections WHERE SectionCode = ?";
    $sectionStmt = mysqli_prepare($conn, $sectionQuery);
    mysqli_stmt_bind_param($sectionStmt, "s", $sectionCode);
    mysqli_stmt_execute($sectionStmt);
    mysqli_stmt_bind_result($sectionStmt, $sectionID);
    mysqli_stmt_fetch($sectionStmt);
    mysqli_stmt_close($sectionStmt);

    $facultyStmt = mysqli_prepare($conn, "SELECT FacultyID FROM faculty WHERE FacultyName = ? AND Position = ?");
    mysqli_stmt_bind_param($facultyStmt, "ss", $FacultyName, $Position);
    mysqli_stmt_execute($facultyStmt);
    mysqli_stmt_bind_result($facultyStmt, $facultyID);
    mysqli_stmt_fetch($facultyStmt);
    mysqli_stmt_close($facultyStmt);

    $sql = "INSERT INTO schedule (RoomID, SubjectID, SectionID, LaboratoryUnits, LectureUnits, DayOfWeek, TimeStart, TimeEnd, AcademicYearStart, AcademicYearEnd, Semester, FacultyID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiissssssssi", $roomID, $SubjectID, $SectionID, $LaboratoryUnits, $LectureUnits, $DayOfWeek, $TimeStart, $TimeEnd, $AcademicYearStart, $AcademicYearEnd, $Semester, $FacultyID);
    if (mysqli_stmt_execute($stmt)) {
        echo "New Record added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Schedule</title>
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
            max-width: 700px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .form h2 {
            text-align: left;
            margin-bottom: 20px;
        }

        .form-container {
            display: flex;
            padding-top: 20px;
        }

        .form-column1, .form-column2 {
            width: 80%;
            margin-right: 4%;
        }
        
        .form-column2 {
            margin-right: 0;
        }

        .form-group, .form-group-half {
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .form-group-half {
            display: flex;
            justify-content: space-between;
        }

        .form-group-half > div {
            width: 80%;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        label .required {
            color: red;
        }

        input[type="text"],
        input[type="password"],
        input[type="number"],
        input[type="date"],
        input[type="time"],
        select {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            box-sizing: border-box;
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

        .form-group-half {
    display: flex;
    justify-content: space-between;
}

.form-group-half .form-field {
    width: 48%; /* Adjust as needed for spacing */
}

.form-field label {
    display: block;
    margin-bottom: 5px;
}

.form-control {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
}


   
    </style>
</head>
<body>
<div class="form">
    <h2>ADD A SCHEDULE</h2>
    <hr>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-container">
            <div class="form-column1">
                    <div class="form-group">
                            <label for="RoomName">ROOM: <span class="required">*</span></label>
                            <select id="RoomName" name="RoomName" class="form-control select2" required>
                            <option value="">Select a description</option>
                                    <option value="ALB 1">ALB 1</option>
                                    <option value="ALB 2">ALB 2</option>
                                    <option value="ALB 3">ALB 3</option>
                                    <option value="ALB 4">ALB 4</option>
                                    <option value="ALB 5">ALB 5</option>
                                    <option value="ALB 6">ALB 6</option>
                                    <option value="ALB 7">ALB 7 </option>
                                    <option value="ALB 8">ALB 8</option>
                                    <option value="ALB 9">ALB 9</option>
                                    <option value="ALB 10">ALB 10</option>
                                    <option value="ALB 11">ALB 11</option>
                                    <option value="ALB 12">ALB 12</option>
                                    <option value="ComLab">ComLab</option>
                                    </select>
                            </div>                
                
                    <div class="form-group">
                    <label for="SubjectCode">SUBJECT CODE: <span class="required">*</span></label>
                    <select id="SubjectCode" name="SubjectCode" class="form-control select2" required>
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
                        <label for="SubjectName">SUBJECT DESCRIPTION: <span class="required">*</span></label>
                            <select id="SubjectName" name="SubjectName" class="form-control select2" required>
                            <option value="">Select a description</option>
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
                    <label for="SectionCode">SECTION: <span class="required">*</span></label>
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

                <div class="form-group-half">
    <div class="form-field">
        <label for="LaboratoryUnits">LAB UNITS: <span class="required">*</span></label>
        <input type="number" id="LaboratoryUnits" name="LaboratoryUnits" class="form-control" required min="0">
    </div>
    <div class="form-field">
        <label for="LectureUnits">LEC UNITS: <span class="required">*</span></label>
        <input type="number" id="LectureUnits" name="LectureUnits" class="form-control" required min="0">
    </div>
</div>

<div class="form-group">
    <label for="FacultyName">FACULTY NAME: <span class="required">*</span></label>
    <input type="text" id="FacultyName" name="FacultyName" class="form-control" required>
</div>
            </div>
                <div class="form-column2">
                        <div>
                            <label for="DayOfWeek">DAY OF THE WEEK: <span class="required">*</span></label>
                            <select id="DayOfWeek" name="DayOfWeek[]" multiple="multiple" class="form-control select2">
                                <option value="MON">MON</option>
                                <option value="TUE">TUE</option>
                                <option value="WED">WED</option>
                                <option value="THU">THU</option>
                                <option value="FRI">FRI</option>
                                <option value="SAT">SAT</option>
                            </select>
                        </div>
                        <div class="form-group-half">
                            <div>
                                <label for="TimeStart">TIME START: <span class="required">*</span></label>
                                <input type="time" id="TimeStart" name="TimeStart" required>
                            </div>
                            <div>
                                <label for="TimeEnd">TIME END: <span class="required">*</span></label>
                                <input type="time" id="TimeEnd" name="TimeEnd" required>
                            </div>
                        </div>

                        <div class="form-group-half">
                        <div>
                            <label for="AcademicYearStart">ACAD YR START: <span class="required">*</span></label>
                            <input type="number" id="AcademicYearStart" name="AcademicYearStart" required min="2024">
                        </div>
                        <div>
                            <label for="AcademicYearEnd">ACAD YR END: <span class="required">*</span></label>
                            <input type="number" id="AcademicYearEnd" name="AcademicYearEnd" required min="2025">
                        </div>
                    </div>
                    <div class="form-group">
                            <label for="Semester">SEMESTER: <span class="required">*</span></label>
                            <select id="Semester" name="Semester" required>
                                <option value="1st Semester">1st Semester</option>
                                <option value="2nd Semester">2nd Semester</option>
                                <option value="Offset Semester">Offset Semester</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Position">POSITION: <span class="required">*</span></label>
                            <input type="" id="Position" name="Position" required>
                    </div>
                </div>
            </div>
            <hr>
            <div class="footer">
                <input type="submit" class="button submit-button" value="Submit">
                <button type="button" class="button cancel-button" onclick="window.history.back();">Cancel</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                closeOnSelect: false,
                placeholder: "Select an option"
            });
        });
    </script>

    <script>
    // Function to allow only alphabetic input
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