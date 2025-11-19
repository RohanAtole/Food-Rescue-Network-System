<?php
session_start();
@include 'conn1.php';

$error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the statement
    $stmt = $conn->prepare("SELECT id, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        
        // Verify password (plain text for this example)
        if ($password === $password) {
            $_SESSION['admin_id'] = $id; // Set session variable
            echo "<script>window.location.href='admin_dash.php';</script>";
           // header("Location: admin_dash.php"); // Redirect to dashboard
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-image: url('img/donorloginbg.jpg'); /* Set background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: rgba(0, 0, 0, 0.6); /* Transparent background overlay */
        }

        .login-container {
            background: rgba(255, 255, 255, 0.3); /* Transparent white background for the form */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 300px;
            backdrop-filter: blur(5px); /* Optional: Adds a blur effect to the background */
        }

        h1 {
            margin-bottom: 20px;
            color: #fff;
        }

        .input-group {
            margin-bottom: 15px;
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
        }

        input {
            width: 90%;
            padding: 10px 10px 10px 35px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent input background */
        }

        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-bottom: 10px;
            transition: opacity 0.5s;
        }

        input:focus {
            border-color: #007bff;
        }

        @media (max-width: 768px) {
            .login-container {
                width: 80%;
            }
        }
    </style>
    <script>
        function hideError() {
            setTimeout(() => {
                document.getElementById("error-message").style.display = 'none';
            }, 2000);
        }
    </script>
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <?php if ($error): ?>
            <div class="error" id="error-message"><?php echo $error; ?></div>
            <script>hideError();</script>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
