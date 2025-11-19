<?php 
@include 'header.php'; 
@include 'conn1.php'; 

// Check if user is logged in
if (!isset($_SESSION['charity_id'])) {
    header("Location: charitylogin.php");
    exit();
}

$id = $_SESSION['charity_id'];

// Initialize variables for date range and search query
$startDate = '';
$endDate = '';
$searchQuery = '';

// Fetch donation details
$sql = "SELECT f.id AS food_id, food_name, food_type, food_category,
               full_name, contact, address, email, date
        FROM food f
        JOIN donor d ON f.donor_id = d.id 
        WHERE charity_id = $id";

// Check if date range or search query is set
if (isset($_POST['submit'])) {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    
    // Filter donations based on date range
    $sql .= " AND date BETWEEN '$startDate' AND '$endDate'";
}

if (isset($_POST['search_query']) && !empty($_POST['search_query'])) {
    $searchQuery = $_POST['search_query'];
    $sql .= " AND (food_name LIKE '%$searchQuery%' OR full_name LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%')";
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
<html lang="en">
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

        .container15 {
            width: 80%;
            margin: 0 auto;
            /*padding: 20px;*/
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 00px;
        }
        
        .form-inline {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .form-inline input[type="date"], 
        .form-inline input[type="text"], 
        .form-inline button {
            margin: 0 5px;
            padding: 10px;
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
        .footer{
            margin-right: 0px;
            display: inline-flex;
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
        <div class="container15">
            <h1> History </h1>
            <br>
            <form method="POST" action="" class="form-inline">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" value="<?php echo htmlspecialchars($startDate); ?>" required>
                
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" value="<?php echo htmlspecialchars($endDate); ?>" required>
                
                <button type="submit" name="submit" class="btn">Search</button>
            </form>

            <form method="POST" action="" class="form-inline">
                <input type="text" name="search_query" placeholder="Search by Food Name, Donor Name, or Email" value="<?php echo htmlspecialchars($searchQuery); ?>">
                <button type="submit" name="search" class="btn">Search</button>
            </form>

            <?php if (count($donations) > 0): ?>
                <table id="donationTable">
                    <thead>
                        <tr>
                            <th>Food Name</th>
                            <th>Food Type</th>
                            <th>Food Category</th>
                            <th>Donor Name</th>
                            <th>Contact</th>
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
                                <td><?php echo htmlspecialchars($donation['email']); ?></td>
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
        <br><br>
        <div class="footer">
    <?php @include'footer.php'; ?>
    </div>
    </main>
</body>
</html>
