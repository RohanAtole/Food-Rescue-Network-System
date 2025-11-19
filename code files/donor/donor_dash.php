<?php 
@include 'header.php';
@include 'conn1.php';

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: donorlogin.php");
    exit();
}

$id = $_SESSION['id'];
$donor = null;

if ($conn) {
    $query = "SELECT * FROM donor WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $donor = $result->fetch_assoc();
    }
} else {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 500px;
        }
        .button {
            padding: 10px 15px;
            margin-top: 10px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 4px;
        }
        .button:hover {
            background-color: #45a049;
        }
        .food-list {
            margin-top: 20px;
            width: 510px;
        }
        .food-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #fff;
            margin-bottom: 5px;
        }
        .donetfood {
            padding-left: 350px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin: 5px 0 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        label{
            font-weight: bold;
        }
    </style>
</head>
<body>
    <main>

        <div class="donetfood">
            <h1>Donate Food</h1>
            <form id="foodForm">
                <label for="name">Food Name:</label>
                <input type="text" id="name" name="name" required>

                <label>Food Type:</label>
                <input type="radio" id="veg" name="food_type" value="veg" required>
                <label for="veg">Vegetarian</label>
                <input type="radio" id="non_veg" name="food_type" value="non-veg">
                <label for="non_veg">Non-Vegetarian</label>
                <br><br>
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="raw">Raw Food</option>
                    <option value="cooked">Cooked Food</option>
                    <option value="packed">Packed Food</option>
                </select>

                <input type="hidden" id="donor_id" value="<?php echo isset($donor['id']) ? htmlspecialchars($donor['id']) : ''; ?>">
                
                <button type="button" class="button" onclick="addFood()">Add Food Item</button>
            </form>

            <div class="food-list" id="foodList"></div>

            <button class="button" onclick="submitData()">Submit All</button>
        </div>
        <br><br>
        <script>
            const foodItems = [];

            function addFood() {
                const name = document.getElementById('name').value;
                const foodType = document.querySelector('input[name="food_type"]:checked')?.value;
                const category = document.getElementById('category').value;
                const donorId = document.getElementById('donor_id').value;

                if (name && foodType) {
                    const foodItem = { name, foodType, category, donor_id: donorId };
                    foodItems.push(foodItem);
                    displayFoodItems();
                    clearForm();
                } else {
                    alert("Please fill all fields.");
                }
            }

            function displayFoodItems() {
                const foodList = document.getElementById('foodList');
                foodList.innerHTML = '';

                foodItems.forEach((item, index) => {
                    foodList.innerHTML += `
                        <div class="food-item">
                            <span>${item.name} - ${item.foodType} - ${item.category}</span>
                            <button class="button" onclick="deleteFood(${index})">Delete</button>
                        </div>
                    `;
                });
            }

            function deleteFood(index) {
                foodItems.splice(index, 1);
                displayFoodItems();
            }

            function clearForm() {
                document.getElementById('foodForm').reset();
            }

            function submitData() {
                if (foodItems.length === 0) {
                    alert("No food items to submit.");
                    return;
                }
                
                fetch('add_form.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(foodItems)
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    foodItems.length = 0; // Clear the array
                    displayFoodItems(); // Refresh the displayed list
                })
                .catch(error => console.error('Error:', error));
            }
        </script>
         
        <?php 
    @include 'footer.php';?>
    </main>
</body>

</html>
