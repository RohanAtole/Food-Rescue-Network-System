<?php
@include('nav.php');
@include('conn1.php');
// Initialize error and success variables
$error = $success = "";



// Backend Logic for form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Input validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = "All fields are required."; // If any field is empty
    } else {
        // SQL to insert the form data into the database
        $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

        if (mysqli_query($conn, $sql)) {
            $success = "Your message has been sent successfully!"; // Success message
        } else {
            // If there's an error inserting into the database, display the error
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
        body {
            background-color: #e9ecef; /* Light grey background for better contrast */
            font-family: Arial, sans-serif;
        }
        .contact-form-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff; /* White background for the form */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .contact-form-container h2 {
            color: #002366; /* Dark blue text */
            text-align: center;
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 5px;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: #002366;
            box-shadow: 0 0 5px rgba(0, 35, 102, 0.5);
        }
        .btn-custom {
            background-color: #002366; /* Dark blue background */
            color: #ffffff; /* White text */
            border: 1px solid #002366;
            border-radius: 5px;
        }
        .btn-custom:hover {
            background-color: #f8f9fa; /* Light background */
            color: #002366; /* Dark text */
        }
        label {
            color: #002366; /* Dark blue labels */
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="contact-form-container">
        <h2>Contact Us</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php elseif ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-custom">Send Message</button>
            </div>
        </form>
    </div>

    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>

    <?php
    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
