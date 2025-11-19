<?php
@include 'header.php';
@include 'conn1.php'; // Database connection file

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_id'])) {
    $deleteId = intval($_POST['delete_id']);
    $deleteQuery = "DELETE FROM contact_messages WHERE id = $deleteId";
    if ($conn->query($deleteQuery) === TRUE) {
        $success = "Message deleted successfully!";
    } else {
        $error = "Error deleting message: " . $conn->error;
    }
}

// Fetch all messages
$fetchQuery = "SELECT * FROM contact_messages ORDER BY id DESC";
$messagesResult = $conn->query($fetchQuery);
$messages = $messagesResult->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Messages</title>
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 50px auto;
            max-width: 1200px;
        }
        .card {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            color: #002366;
            font-size: 1.25rem;
            font-weight: bold;
        }
        .card-text {
            color: #333;
        }
        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .btn-delete:hover {
            background-color: #c82333;
            color: #f8f9fa;
        }
        .alert {
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .card {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <main>
    <div class="container">
        <h1 class="text-center mb-4">Messages</h1>
        <?php if (isset($success)): ?>
            <div id="success-alert" class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div id="error-alert" class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="row">
            <?php if ($messages): ?>
                <?php foreach ($messages as $message): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">From: <?php echo htmlspecialchars($message['name']); ?></h5>
                                <p class="card-text">
                                    <strong>Email:</strong> <?php echo htmlspecialchars($message['email']); ?><br>
                                    <strong>Subject:</strong> <?php echo htmlspecialchars($message['subject']); ?><br>
                                    <strong>Message:</strong><br>
                                    <?php echo nl2br(htmlspecialchars($message['message'])); ?>
                                </p>
                                <form method="POST" class="mt-3">
                                    <input type="hidden" name="delete_id" value="<?php echo $message['id']; ?>">
                                    <button type="submit" class="btn btn-delete">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">No messages to display.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script>
        // JavaScript to hide alerts after 3 seconds
        setTimeout(() => {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            if (successAlert) successAlert.style.display = 'none';
            if (errorAlert) errorAlert.style.display = 'none';
        }, 3000);
    </script>

<?php
$conn->close(); // Close the database connection
@include 'footer.php';
?>
<main>
</body>
</html>
