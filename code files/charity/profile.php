<?php 
@include 'header.php'; 
@include 'conn1.php'; 

if (!isset($_SESSION['charity_id'])) {
    header("Location: charitylogin.php");
    exit();
}

$id = $_SESSION['charity_id'];
$successMessage = "";
$errorMessage = "";

// Fetch charity details
$sql = "SELECT * FROM charity WHERE id='$id'";
$result = $conn->query($sql);
$charity = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $mobile_number = $conn->real_escape_string($_POST['mobile_number']);
    $add = $conn->real_escape_string($_POST['add']);
    $charity_name = $conn->real_escape_string($_POST['charity_name']);
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    if (!password_verify($current_password, $charity['password'])) {
        $errorMessage = "Current password is incorrect.";
    } else {
        // Prepare SQL for profile update
        $updateSql = "UPDATE charity SET address='$add', username='$username', email='$email', mobile='$mobile_number', charity_name='$charity_name' WHERE id='$id'";

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
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container12 {
            width: 60%;
            margin: 20px auto;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            animation: fadeIn 0.5s;
            padding: 80px;
        }

        h1 {
            text-align: center;
            color: #d9534f;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border 0.3s, background-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border: 1px solid #d9534f;
            outline: none;
        }

        input[type="text"]:hover,
        input[type="email"]:hover,
        input[type="password"]:hover {
            background-color: #f9f9f9;
        }

        .btn {
            background-color: #d9534f;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn:hover {
            background-color: #c9302c;
            transform: scale(1.05);
        }

        .message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            animation: slideIn 0.5s;
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

        .profile {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 0 auto 20px;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

    </style>
</head>
<body>
    <main>
        <div class="container12">
            <h1>Update Profile</h1>

            <form action="" method="POST">
                <img src="../img/avatar.png" alt="profile_img" class="profile"> 
                <?php if (!empty($successMessage)): ?>
                <div class="message success" id="successMessage"><?php echo $successMessage; ?></div>
            <?php endif; ?>

            <?php if (!empty($errorMessage)): ?>
                <div class="message error" id="errorMessage"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($charity['username']); ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($charity['email']); ?>" required>

                <label for="mobile_number">Mobile Number:</label>
                <input type="text" id="mobile_number" name="mobile_number" value="<?php echo htmlspecialchars($charity['mobile']); ?>" required>

                <label for="charity_name">Charity Name:</label>
                <input type="text" id="charity_name" name="charity_name" value="<?php echo htmlspecialchars($charity['charity_name']); ?>" required>

                <label for="charity_number">Charity Number:</label>
                <input type="text" id="charity_number" name="charity_number" value="<?php echo htmlspecialchars($charity['charity_number']); ?>" readonly>

                <label for="add">Address:</label>
                <input type="text" id="add" name="add" value="<?php echo htmlspecialchars($charity['address']); ?>" required>

                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" required>

                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password">

                <label for="confirm_new_password">Confirm New Password:</label>
                <input type="password" id="confirm_new_password" name="confirm_new_password">

                <button type="submit" name="update" class="btn">Update Profile</button>
            </form>
        </div>
        <br><br>
        <div class="footer">
    <?php @include'footer.php'; ?>
    </div>
    </main>

    <script>
        // Automatically hide messages after 3 seconds
        setTimeout(() => {
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
</body>
</html>
