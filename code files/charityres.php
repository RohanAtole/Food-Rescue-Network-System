<?php
@include 'conn1.php';

$message = [];
$formData = [
    'name' => '',
    'mobile' => '',
    'email' => '',
    'address' => '',
    'gender' => '',
    'charity_name' => '',
    'charity_number' => '',
    'username' => '',
    'password' => '',
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize user inputs
    foreach ($formData as $key => &$value) {
        $value = trim($_POST[$key] ?? '');
    }
    
    $password = $_POST['password'];
    $status = "pending";
    $date = date("Y-m-d");

    // Check for existing records using prepared statements
    $checkSql = "SELECT * FROM charity WHERE mobile = ? OR username = ? OR charity_number = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("ssi", $formData['mobile'], $formData['username'], $formData['charity_number']);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        if ($row['mobile'] === $formData['mobile']) {
            $message[] = "Mobile number already exists.";
        }
        if ($row['username'] === $formData['username']) {
            $message[] = "Username already exists.";
        }
        if ($row['charity_number'] === $formData['charity_number']) {
            $message[] = "Charity number already exists.";
        }
    }

    if (strlen($password) < 5) {
        $message[] = "Password must be at least 5 characters long.";
    }

    if (empty($message)) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert into the database using prepared statements
        $sql = "INSERT INTO charity (name, mobile, email, address, gender, charity_name, charity_number, username, password, date, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssissss", $formData['name'], $formData['mobile'], $formData['email'], 
            $formData['address'], $formData['gender'], $formData['charity_name'], $formData['charity_number'], 
            $formData['username'], $hashedPassword, $date, $status);
        
        if ($stmt->execute()) {
            $message[] = "Successfully registered!";
            // Clear the form data upon successful registration
            $formData = array_fill_keys(array_keys($formData), '');
        } else {
            $message[] = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="tel"],
        input[type="password"],
        input[type="email"],
        select {
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
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .message {
            text-align: center;
            margin: 10px 0;
        }
        .error {
            color: red;
        }
        .signin-btn {
            display: block;
            margin: 20px auto;
            text-align: center;
        }
    </style>
</head>
<body>
<div>
<?php @include 'nav.php'; ?>
</div>
<br><br>
<div class="form-container">
    <h2>Charity Registration</h2>
    <div class="message">
        <?php 
        foreach ($message as $msg) {
            echo "<div class='error'>$msg</div>";
        }
        ?>
    </div>
    <form id="registrationForm" method="POST" onsubmit="return validateForm()">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($formData['name']); ?>" required>

        <label for="mobile">Mobile Number:</label>
        <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" value="<?php echo htmlspecialchars($formData['mobile']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($formData['email']); ?>" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($formData['address']); ?>" required>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="">Select</option>
            <option value="male" <?php if ($formData['gender'] === 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if ($formData['gender'] === 'female') echo 'selected'; ?>>Female</option>
            <option value="other" <?php if ($formData['gender'] === 'other') echo 'selected'; ?>>Other</option>
        </select>

        <label for="charity_name">Charity Name:</label>
        <input type="text" id="charity_name" name="charity_name" value="<?php echo htmlspecialchars($formData['charity_name']); ?>" required>

        <label for="charity_number">Charity Number (8 digits):</label>
        <input type="text" id="charity_number" name="charity_number" pattern="\d{8}" value="<?php echo htmlspecialchars($formData['charity_number']); ?>" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($formData['username']); ?>" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <input type="submit" value="Register">
    </form>
    <div class="signin-btn">
        <a href="charitylogin.php">Already have an account? Sign In</a>
    </div>
</div>

<script>
function validateForm() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;
    
    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }
    return true;
}
</script>

</body>
</html>
<br>
<?php
$conn->close();
@include 'footer.php';
?>
