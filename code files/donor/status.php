<?php
@include 'header.php'; 
@include 'conn1.php';



if (!isset($_SESSION['id'])) {
    header("Location: donorlogin.php");
    exit();
}

$id = $_SESSION['id'];

$query = "SELECT * FROM food WHERE date >= NOW() - INTERVAL 2 HOUR AND donor_id ='$id'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px; /* Rounded corners for table */
            overflow: hidden; /* Clip the corners */
        }
        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
            transition: background-color 0.3s ease;
        }
        th {
            background-color: #007BFF;
            color: white;
            font-weight: normal; /* Remove bold effect from headers */
        }
        tr:hover {
            background-color: #f1f1f1; /* Light gray on hover */
        }
        .rejected {
            background-color: #ffcccc; /* Light red */
            color: red;
        }
        .assigned {
            background-color: #cce5ff; /* Light blue */
            color: blue;
        }
        .accepted {
            background-color: #d4edda; /* Light green */
            color: green;
        }
        .pending {
            background-color: #d69e2e; /* Brown */
            color: white; /* Keep text readable */
        }
        .status {
            padding: 5px 10px;
            border-radius: 5px; /* Rounded corners for status */
            font-weight: bold; /* Make status text bold */
            display: inline-block; /* Make background cover text */
        }
        .no-records {
            text-align: center;
            font-size: 1.2em;
            color: #666; /* Gray for no records message */
            padding: 20px;
        }
    </style>
</head>
<body>
    <main>
    <h1>Food Status</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['food_name']); ?></td>
                        <td class="status <?php echo htmlspecialchars($row['status']); ?>"><?php echo htmlspecialchars($row['status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="no-records">No records found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<br>
    <?php $conn->close(); ?>
     <div class="footer">
    <?php @include'footer.php'; ?>
    </div>
</main>
</body>
</html>
