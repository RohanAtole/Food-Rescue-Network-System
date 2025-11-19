<?php
@include 'header.php';
@include 'conn1.php';

// Fetch donor records
$sql = "SELECT * FROM donor";
$result = $conn->query($sql);

$donors = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $donors[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }

        .container {
            max-width: 1020px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border 0.3s;
        }

        input[type="text"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td, th {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-weight: bold; /* Make table data bold */
        }

        tr:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s;
        }

        .no-results {
            display: none;
            color: red;
            text-align: center;
            margin-top: 20px;
        }

        .print-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            transition: background-color 0.3s;
        }

        .print-button:hover {
            background-color: #45a049;
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
        document.addEventListener("DOMContentLoaded", () => {
            const searchInput = document.getElementById("search");
            const donorTable = document.getElementById("donorTable");
            const noResultsMessage = document.getElementById("noResultsMessage");

            searchInput.addEventListener("input", function() {
                const searchTerm = this.value.toLowerCase();
                const rows = donorTable.querySelectorAll("tr");
                let hasResults = false;

                rows.forEach(row => {
                    const cells = row.querySelectorAll("td");
                    let found = false;

                    cells.forEach(cell => {
                        if (cell.textContent.toLowerCase().includes(searchTerm)) {
                            found = true;
                        }
                    });

                    row.style.display = found ? "" : "none";
                    if (found) hasResults = true;
                });

                noResultsMessage.style.display = hasResults ? "none" : "block";
            });
        });

        function printTable() {
            window.print();
        }
    </script>
</head>
<body>
<main>
    <div class="container">
        <h1>Donor Report</h1>
        <input type="text" id="search" placeholder="Search..." />

        <div class="no-results" id="noResultsMessage">
            No matching records found.
        </div>

        <table id="donationTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Contact</th>
                    <th>Username</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody id="donorTable">
                <?php foreach ($donors as $donor): ?>
                    <tr>
                        <td><?= htmlspecialchars($donor['id']) ?></td>
                        <td><?= htmlspecialchars($donor['full_name']) ?></td>
                        <td><?= htmlspecialchars($donor['address']) ?></td>
                        <td><?= htmlspecialchars($donor['email']) ?></td>
                        <td><?= htmlspecialchars($donor['gender']) ?></td>
                        <td><?= htmlspecialchars($donor['contact']) ?></td>
                        <td><?= htmlspecialchars($donor['username']) ?></td>
                        <td><?= htmlspecialchars($donor['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <button class="print-button no-print" onclick="printTable()">Print Report</button>
    </div>
    <br><br>
    <div class="footer">
    <?php @include'footer.php'; ?>
    </div>
</main>
</body>
</html>
