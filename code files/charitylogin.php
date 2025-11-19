<?php
session_start(); // Start the session
@include 'conn1.php'; // Include the database connection

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if username exists
    $sql = "SELECT id, password, status FROM charity WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Check if the status is pending
        if ($row['status'] === 'pending') {
            $message = "Your registration is pending. Please wait for approval.";
        } else {
            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Store user information in session
                $_SESSION['charity_id'] = $row['id'];
                $_SESSION['username'] = $username;
                $message = "Login successful! Redirecting...";
                // Redirect to the dashboard
                header("refresh:2; url=charity/charity_dash.php");
                exit();
            } else {
                $message = "Incorrect password.";
            }
        }
    } else {
        $message = "Username does not exist.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .bgimg{
            background-image: url('img/admin.jpeg'); /* Set the background image */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .nav-container {
            margin-bottom: 40px;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.2); /* Transparent background */
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            margin: 80px auto;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px); /* Blur effect for better readability */
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
           color: #333;
            font-weight: bold; 

        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #4cae4c;
        }

        .message {
            text-align: center;
            margin: 10px 0;
            color: red;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .form-container {
                width: 90%;
            }
        }
    </style>
</head>
<body class="bgimg">
    <div class="nav-container">
        <?php @include 'nav.php'; ?>
    </div>

    <div class="form-container">
        <h2>Charity Login</h2>
        <div class="message"><?php echo $message; ?></div>
        <form id="loginForm" method="POST" onsubmit="return validateForm()">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">

            <input type="submit" value="Login">
        </form>
        <div class="signup-link">
            <a href="charityres.php">Create a new account</a>
        </div>
    </div>

    <script>
        function validateForm() {
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;

            if (username.trim() === "" || password.trim() === "") {
                alert("Both fields are required.");
                return false;
            }
            return true;
        }
    </script>

    <div>
        <?php @include 'footer.php'; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
