<?php @include 'header.php'; ?>
<?php @include 'conn1.php'; ?>

<?php
// Start the session


// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: donorlogin.php");
    exit();
}

$id = $_SESSION['id'];

// Initialize variables for date range
$startDate = '';
$endDate = '';

// Fetch donation details
$sql = "SELECT * FROM food WHERE donor_id='$id'";

// Check if date range is set
if (isset($_POST['submit'])) {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    
    // Filter donations based on date range
    $sql .= " AND date BETWEEN '$startDate' AND '$endDate'";
}

$result = $conn->query($sql);

$donations = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $donations[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Donations</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        
        .form-inline {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .form-inline input[type="date"], .form-inline button {
            margin: 0 5px;
        }

        h1 {
            text-align: center;
            color: red;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: skyblue;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #5bc0de;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            #donationTable, #donationTable * {
                visibility: visible;
            }
            #donationTable {
                position: absolute;
                left: 0;
                top: 0;
            }
            .no-print {
                display: none; /* Hide buttons during print */
            }
        }
    </style>
    <script>
        function printTable() {
            window.print();
        }
    </script>
</head>
<body>
    <main>
        <div class="container">
            <h1>Food Donation History</h1>
            <br>
            
            <form method="POST" action="" class="form-inline">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" value="<?php echo htmlspecialchars($startDate); ?>" required>
                
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" value="<?php echo htmlspecialchars($endDate); ?>" required>
                
                <button type="submit" name="submit" class="btn">Search</button>
            </form>
            
            <?php if (count($donations) > 0): ?>
                <table id="donationTable">
                    <thead>
                        <tr>
                            <th>Food Name</th>
                            <th>Food Type</th>
                            <th>Food Category</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($donations as $donation): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($donation['food_name']); ?></td>
                                <td><?php echo htmlspecialchars($donation['food_type']); ?></td>
                                <td><?php echo htmlspecialchars($donation['food_category']); ?></td>
                                <td><?php echo htmlspecialchars($donation['date']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button class="btn no-print" onclick="printTable()">Print Data</button>
            <?php else: ?>
                <p>No donation details available.</p>
            <?php endif; ?>
        </div>
        <br>
        <?php 
    @include 'footer.php';?>
    </main>
</body>
</html>
