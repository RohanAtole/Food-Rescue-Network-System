<?php 
@include 'header.php'; 
@include 'conn1.php'; 

// Check if user is logged in
if (!isset($_SESSION['charity_id'])) {
    header("Location: charitylogin.php");
    exit();
}

$message = '';
$message1 = '';
$charity_id = $_SESSION['charity_id'];
// Approve Food
if (isset($_POST['approve'])) {
    $id = $_POST['id'];
    $charity_id = $_SESSION['charity_id']; // Get the charity_id from session
    // Update the food record with the charity_id and change status
    if ($conn->query("UPDATE food SET status='assigned', charity_id='$charity_id' WHERE id='$id'")) {
        $message = "Food or donor detail accepted successfully!";
    } else {
        $message = "Error approving food: " . $conn->error;
    }
}

// Fetch food items
$result = $conn->query("SELECT f.id AS food_id, food_name, food_type, food_category,
                               full_name, contact, address, email
                        FROM food f
                        JOIN donor d ON f.donor_id = d.id WHERE status ='accepted'");

// Check if query was successful
if (!$result) {
    die("Database query failed: " . $conn->error);
}

// Check if any food items were found
if ($result->num_rows == 0) {
    $message1 = "No food items are currently available.";
}

// Fetch accepted donations
$donations = [];
$donationResult = $conn->query("SELECT f.food_name, f.food_type, f.food_category, 
                                        d.full_name, d.contact, d.email, d.address,f.date,f.charity_id
                                 FROM food f
                                 JOIN donor d ON f.donor_id = d.id 
                                 WHERE f.status = 'assigned' AND f.charity_id = $charity_id AND date >= NOW() - INTERVAL 2 HOUR");

if ($donationResult && $donationResult->num_rows > 0) {
    while ($donationRow = $donationResult->fetch_assoc()) {
        $donations[] = $donationRow;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            
        }
        h1 {
            text-align: center;
            color: #333;
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
        button {
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
            margin: 20px 0;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            text-align: center;
            display: none;
        }
        .message1 {
            margin: 20px 0;
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            text-align: center;
            display: block;
        }
        .footer{
            padding-left: 240px;
        }
    </style>
</head>
<body>
    <main class="bgimg">
        <h1>Donated Food List</h1>
        <?php if ($message): ?>
            <div class="message" id="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($message1): ?>
            <div class="message1" id="message1">
                <?php echo $message1; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($result->num_rows > 0): ?>
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
                            <button type="submit" name="approve" onclick="return confirm('Are you sure you want to accept this food?');">Accept</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php endif; ?>
        
        <h1><strong>Accepted Food Or Donor Details</strong></h1>
        <?php if (count($donations) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Food Name</th>
                        <th>Food Type</th>
                        <th>Food Category</th>
                        <th>Donor Name</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($donations as $donation): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($donation['food_name']); ?></td>
                            <td><?php echo htmlspecialchars($donation['food_type']); ?></td>
                            <td><?php echo htmlspecialchars($donation['food_category']); ?></td>
                            <td><?php echo htmlspecialchars($donation['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($donation['contact']); ?></td>
                            <td><?php echo htmlspecialchars($donation['address']); ?></td>
                            
                            <td><?php echo htmlspecialchars($donation['email']); ?></td>
                            <td><?php echo htmlspecialchars($donation['date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="message1">No Accepted Food details available.</p>
        <?php endif; ?>
    </main>

    <div class="footer">
    <?php @include'footer.php'; ?>
    </div>

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
