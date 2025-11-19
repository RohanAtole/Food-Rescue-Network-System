<?php
@include 'header.php';
@include 'conn1.php';

// Fetch charity records
$sql = "SELECT * FROM charity";
$result = $conn->query($sql);

$charities = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $charities[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Report</title>
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
            const charityTable = document.getElementById("charityTable");
            const noResultsMessage = document.getElementById("noResultsMessage");

            searchInput.addEventListener("input", function() {
                const searchTerm = this.value.toLowerCase();
                const rows = charityTable.querySelectorAll("tr");
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
        <h1>Charity Report</h1>
        <input type="text" id="search" placeholder="Search..." />

        <div class="no-results" id="noResultsMessage">
            No matching records found.
        </div>

        <table id="donationTable">
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
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="charityTable">
                <?php foreach ($charities as $charity): ?>
                    <tr>
                        <td><?= htmlspecialchars($charity['id']) ?></td>
                        <td><?= htmlspecialchars($charity['name']) ?></td>
                        <td><?= htmlspecialchars($charity['mobile']) ?></td>
                        <td><?= htmlspecialchars($charity['email']) ?></td>
                        <td><?= htmlspecialchars($charity['address']) ?></td>
                        <td><?= htmlspecialchars($charity['gender']) ?></td>
                        <td><?= htmlspecialchars($charity['charity_name']) ?></td>
                        <td><?= htmlspecialchars($charity['charity_number']) ?></td>
                        <td><?= htmlspecialchars($charity['username']) ?></td>
                        <td><?= htmlspecialchars($charity['date']) ?></td>
                        <td><?= htmlspecialchars($charity['status']) ?></td>
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
