<?php
include("conn1.php"); // Include navbar file

// Initialize response variables
$success = false;
$message = '';
$full_name = '';
$address = '';
$email = '';
$contact = '';
$gender = '';
$username = '';
$password = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $full_name = trim($_POST['full_name']);
    $address = trim($_POST['address']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
   
    $gender = trim($_POST['gender']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($full_name) || empty($address) || empty($email) || empty($contact)  || empty($gender) || empty($username) || empty($password)) {
        $message = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Invalid email format.';
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $message = 'Username can only contain letters and numbers.';
    } else {
        // Check if username already exists
        if ($stmt = $conn->prepare("SELECT id FROM donor WHERE username = ?")) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $message = 'Username already taken.';
            } else {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                // Insert new user into the database
                if ($stmt = $conn->prepare("INSERT INTO donor (full_name, address, email, contact, gender, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
                    $stmt->bind_param("sssssss", $full_name, $address, $email, $contact, $gender, $username, $hashed_password);

                    if ($stmt->execute()) {
                        $success = true;
                        $message = 'Registration successful.';
                        // Clear form data
                        $full_name = $address = $email = $contact = $gender = $username = $password = '';
                    } else {
                        $message = 'An error occurred while registering. Please try again.';
                    }
                } else {
                    $message = 'Database error: Unable to prepare statement.';
                }
            }
            $stmt->close();
        } else {
            $message = 'Database error: Unable to prepare statement.';
        }
    }
    $conn->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <?php include("nav.php"); ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
        html, body {
            height: 0%;
            margin: 0;
            padding: 0;
            background: url('img/donorloginbg.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Circular Std', sans-serif;
        }
        .splash-container {
            max-width: 600px;
            margin: 50px auto; /* Center the form vertically */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative; /* Allow positioning of child elements */
        }
        .card {
            background-color: rgba(255, 255, 255, 0.75); /* Adjust transparency */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            width: 100%; /* Make card full width */
            position: relative; /* Set card position for absolute children */
            z-index: 1; /* Ensure card is above the background */
        }
        .card-header img {
            max-width: 150px;
            height: auto;
        }
        .form-control {
            border-radius: 25px;
            padding: 15px;
            font-size: 16px;
        }
        .btn-custom {
            background-color: #8a2be2 !important;
            color: white !important;
            border-radius: 30px;
            padding: 12px;
            font-size: 16px;
        }
        .form-group label {
            font-weight: bold;
            color: #4b0082;
        }
        .form-control::placeholder {
            font-size: 14px;
            color: #9a9a9a;
        }
        .alert {
            margin-top: 15px;
        }
        .footer-link {
            color: #8a2be2 !important;
        }
    </style>
</head>
<body>

    <!-- Splash Container -->
    <div class="splash-container">
        <div class="card">
            <div class="card-header text-center">
                <a href="#"><img class="logo-img" src="img/logo.png" alt="logo"></a>
                <span class="splash-description">Register your account</span>
            </div>
            <div class="card-body">
                <!-- Display message -->
                <?php if ($message): ?>
                    <div class="alert <?php echo $success ? 'alert-success' : 'alert-danger'; ?>">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>

                <!-- Registration Form -->
                <form method="post" action="">
                    <div class="form-group">
                        <input class="form-control" type="text" name="full_name" placeholder="Full Name" value="<?php echo htmlspecialchars($full_name); ?>" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="address" placeholder="Complete Address" value="<?php echo htmlspecialchars($address); ?>" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" autocomplete="off" required>
                    </div>
                   <div class="form-group">
                        <input class="form-control" type="text" name="contact" 
                                placeholder="Contact Number" 
                                value="<?php echo htmlspecialchars($contact); ?>" 
                                autocomplete="off" 
                                 required 
                                 pattern="\d{10}" 
                                title="Please enter a 10-digit phone number">
                    </div>

                    <div class="form-group">
                        <label>Gender:</label><br>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="gender" value="male" class="custom-control-input" <?php echo $gender === 'male' ? 'checked' : ''; ?> required>
                            <span class="custom-control-label">Male</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="gender" value="female" class="custom-control-input" <?php echo $gender === 'female' ? 'checked' : ''; ?> required>
                            <span class="custom-control-label">Female</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block btn-custom">Sign Up</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="donorlogin.php" class="footer-link">Already have an account? Login</a>
                </div>
            </div>
        </div>
    </div>
    <?php include'footer.php'; ?>
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
