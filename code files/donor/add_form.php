<?php
session_start();
@include 'conn1.php';


// Handle POST request to add food items
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($_SESSION['id'])) {
        $donor_id = $_SESSION['id'];
        $status='pending';
        foreach ($data as $item) {
            // Prepare the insert statement
            $stmt = $conn->prepare("INSERT INTO food (food_name, food_type, food_category, date, donor_id ,status) VALUES (?, ?, ?, NOW(), ? ,?)");
            $stmt->bind_param("sssis", $item['name'], $item['foodType'], $item['category'], $donor_id ,$status);

            if (!$stmt->execute()) {
                echo "Error adding food item: " . $stmt->error;
                exit;
            }
        }

        echo "Food donated successfully!";
    } else {
        echo "User not logged in.";
    }
} else {
    echo "Invalid request method.";
}
?>
