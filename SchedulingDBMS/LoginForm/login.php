<?php
session_start(); // Start a new session

$error = ''; // Variable to hold error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
    $host = 'localhost';
    $dbname = 'user_umvs';
    $user = 'root';
    $pass = '';

    // Create a connection to the database
    $conn = new mysqli($host, $user, $pass, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        $error = "Connection failed: " . $conn->connect_error;
    } else {
        // Prepare a statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the user exists in the database
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($_POST['password'], $row['password'])) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['role'] = $row['role']; // Set session role
                // Redirect based on role
                switch ($row['role']) {
                    case 'admin':
                        header("Location: ../Admin/admin_view.php");
                        exit();
                    case 'faculty':
                        header("Location: ../Faculty/faculty_view.php");
                        exit();
                    default:
                        $error = "Unauthorized role";
                        break;
                }
            } else {
                $error = "Invalid credentials";
            }
        } else {
            $error = "Invalid credentials";
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('img/BG.png'); 
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 300px;
        }
        .login-logo img {
            width: 250px; 
            margin-bottom: 20px;
        }
        .input-container {
            position: relative;
            margin-bottom: 20px;
            width: 90%;
        }
        .input-container i {
            position: absolute;
            left: 10px;
            top: 10px;
            color: #757575; /* Adjust the color as needed */
        }
        .input-container input {
            width: 100%;
            padding: 10px 10px 10px 40px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #6c1606; /* Adjust the color to match your theme */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            margin-top: 10px;
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-logo">
            <img src="img/CDMlogo.png" alt="Logo"> 
        </div>
        <form action="login.php" method="post">
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">SIGN IN</button>
            <?php if (!empty($error)) { echo '<p class="error">'.$error.'</p>'; } ?>
        </form>
    </div>
</body>
</html>