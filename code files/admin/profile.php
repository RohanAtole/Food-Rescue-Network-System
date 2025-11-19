<?php @include 'header.php';?> 
<?php @include 'conn1.php';?> 
<?php

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location:donorlogin.php");
    exit();
}

$id = $_SESSION['id'];
$successMessage = "";
$errorMessage = "";

// Fetch donor details
$sql = "SELECT * FROM donor WHERE id='$id'";
$result = $conn->query($sql);
$donor = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $mobile_number = $conn->real_escape_string($_POST['mobile_number']);
    $add = $conn->real_escape_string($_POST['add']);
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    if (!password_verify($current_password, $donor['password'])) {
        $errorMessage = "Current password is incorrect.";
    } else {
        // Prepare SQL for profile update
        $updateSql = "UPDATE donor SET address='$add',username='$username', email='$email', contact='$mobile_number' WHERE id='$id'";

        // Handle password update
        if (!empty($new_password) && $new_password === $confirm_new_password) {
            $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);
            $updateSql .= ", password='$new_password_hash'";
        } elseif (!empty($new_password) || !empty($confirm_new_password)) {
            $errorMessage = "New passwords do not match.";
        }

        // Execute update query
        if ($conn->query($updateSql) === TRUE) {
            $successMessage = "Profile updated successfully.";
        } else {
            $errorMessage = "Error updating profile: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Profile</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            color: red;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 8px;
            margin-bottom: 10px;
        }

        .btn {
            background-color: skyblue;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #5bc0de;
        }

        .message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .success {
            background-color: #dff0d8;
            border: 1px solid #d0e9c6;
            color: #3c763d;
        }

        .error {
            background-color: #f2dede;
            border: 1px solid #ebccd1;
            color: #a94442;
        }

        /* CSS for profile image */
        .profile {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover; /* Ensures the image covers the circle without distortion */
            display: block;
            margin: 0 auto 20px; /* Center the image and add bottom margin */
        }
    </style>
</head>
<body>
    <main>
    <br><br>
    <div class="container">
        <h1>Update Profile</h1>

        <?php if (!empty($successMessage)): ?>
            <div class="message success"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <?php if (!empty($errorMessage)): ?>
            <div class="message error"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
             <img src="../img/avatar.png" alt="profile_img" class="profile"> 
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($donor['username']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($donor['email']); ?>" required>

            <label for="mobile_number">Mobile Number:</label>
            <input type="text" id="mobile_number" name="mobile_number" value="<?php echo htmlspecialchars($donor['contact']); ?>" required>

            <label for="add">Address:</label>
            <input type="text" id="add" name="add" value="<?php echo htmlspecialchars($donor['address']); ?>" required>

            <label for="current_password">Current Password:</label>
            <input type="password" id="current_password" name="current_password" required>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password">

            <label for="confirm_new_password">Confirm New Password:</label>
            <input type="password" id="confirm_new_password" name="confirm_new_password">

            <button type="submit" name="update" class="btn">Update Profile</button>
        </form>
    </div>
</main>
</body>
</html>
