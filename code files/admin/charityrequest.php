<?php
@include 'header.php';
@include 'conn1.php';
$message = '';

// Approve Charity
if (isset($_POST['approve'])) {
    $id = $_POST['id'];
    $conn->query("UPDATE charity SET status='approved' WHERE id='$id'");
    $message = "Charity approved successfully!";
}

// Delete Charity
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $conn->query("UPDATE charity SET status='rejected' WHERE id='$id'");
    $message = "Charity rejected successfully!";
}

// Fetch charities
$result = $conn->query("SELECT * FROM charity WHERE status ='pending'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Requests</title>
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
            border: 1px solid #ddd; /* Add border around cells */
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
        <h1>Charity Requests</h1>
        <?php if ($message): ?>
            <div class="message" id="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Charity Name</th>
                    <th>Charity Number</th>
                    <th>Username</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><strong><?php echo $row['id']; ?></strong></td>
                    <td><strong><?php echo $row['name']; ?></strong></td>
                    <td><strong><?php echo $row['mobile']; ?></strong></td>
                    <td><strong><?php echo $row['email']; ?></strong></td>
                    <td><strong><?php echo $row['address']; ?></strong></td>
                    <td><strong><?php echo $row['gender']; ?></strong></td>
                    <td><strong><?php echo $row['charity_name']; ?></strong></td>
                    <td><strong><?php echo $row['charity_number']; ?></strong></td>
                    <td><strong><?php echo $row['username']; ?></strong></td>
                    <td><strong><?php echo $row['date']; ?></strong></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="approve" onclick="return confirm('Are you sure you want to approve this charity?');">Approve</button>
                        </form>
                        
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete" onclick="return confirm('Are you sure you want to reject this charity?');">Reject</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="footer">
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
