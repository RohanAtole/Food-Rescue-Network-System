<?php 
@include 'header.php';
@include 'conn1.php';

// Start session
// Ensure session is started

// Check if user is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: adminlogin.php");
    exit();
}

$message = '';

// Approve Food
if (isset($_POST['approve'])) {
    $id = $_POST['id'];
    if ($conn->query("UPDATE food SET status='accepted' WHERE id='$id'")) {
        $message = "Food approved successfully!";
    } else {
        $message = "Error approving food: " . $conn->error;
    }
}

// Delete Food
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    if ($conn->query("UPDATE food SET status='rejected' WHERE id='$id'")) {
        $message = "Food rejected successfully!";
    } else {
        $message = "Error rejecting food: " . $conn->error;
    }
}

// Fetch food items
$result = $conn->query("
    SELECT f.id AS food_id, food_name AS food_name, food_type AS food_type, food_category AS food_category,
           full_name AS full_name, contact AS contact, address, email
    FROM food f
    JOIN donor d ON f.donor_id = d.id WHERE status ='pending'
");

// Check if query was successful
if (!$result) {
    die("Database query failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALL Donated Food</title>
    <style type="text/css">
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        button {
            padding: 5px 10px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            display: none;
            margin: 20px 0;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            text-align: center;
            animation: fadeInOut 3s forwards;
        }
        @keyframes fadeInOut {
            0% { opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; }
        }
    </style>
</head>
<body>
    <main>
        <h1>ALL Donated Food</h1>
        <?php if ($message): ?>
            <div class="message" id="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Food Name</th>
                    <th>Food Type</th>
                    <th>Food Category</th>
                    <th>Full Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><strong><?php echo $row['food_id']; ?></strong></td>
                    <td><strong><?php echo $row['food_name']; ?></strong></td>
                    <td><strong><?php echo $row['food_type']; ?></strong></td>
                    <td><strong><?php echo $row['food_category']; ?></strong></td>
                    <td><strong><?php echo $row['full_name']; ?></strong></td>
                    <td><strong><?php echo $row['contact']; ?></strong></td>
                    <td><strong><?php echo $row['address']; ?></strong></td>
                    <td><strong><?php echo $row['email']; ?></strong></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['food_id']; ?>">
                            <button type="submit" name="approve" onclick="return confirm('Are you sure you want to approve this food?');">Accept</button>
                        </form>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['food_id']; ?>">
                            <button type="submit" name="delete" onclick="return confirm('Are you sure you want to reject this food?');">Reject</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div>
        <?php @include'footer.php'; ?>
        </div>
    </main>

    <script>
        // Show message if exists
        const messageElement = document.getElementById('message');
        if (messageElement) {
            messageElement.style.display = 'block';
            setTimeout(() => {
                messageElement.style.display = 'none';
            }, 3000); // Hide after 3 seconds
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>
