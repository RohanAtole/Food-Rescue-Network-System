<?php
include("conn1.php");

// Set response content type to JSON
header('Content-Type: application/json');

// Initialize response array
$response = ['success' => false, 'message' => '', 'redirect' => ''];

// Check if POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check if username and password are not empty
    if (empty($username) || empty($password)) {
        $response['message'] = 'Username and password are required.';
    } else {
        // Prepare SQL statement to prevent SQL injection
        if ($stmt = $conn->prepare("SELECT id, password FROM donor WHERE username = ?")) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $hashed_password,);
                $stmt->fetch();

                // Verify password
                if (password_verify($password, $hashed_password)) {
                    // Start session
                    session_start();
                    $_SESSION['username'] = $username;
                    
                    $_SESSION['id'] = $id;

                    // Determine redirect URL based on user type
                    
                        $response['redirect'] = '../sample/donor/donor_dash.php'; // Update with your actual donor dashboard URL
                    

                    $response['success'] = true;
                    $response['message'] = 'Login successful.';
                } else {
                    $response['message'] = 'Invalid username or password.';
                }
            } else {
                $response['message'] = 'Invalid username or password.';
            }

            $stmt->close();
        } else {
            $response['message'] = 'Database query error.';
        }
    }

    $conn->close();
} else {
    $response['message'] = 'Invalid request method.';
}

// Output the response as JSON
echo json_encode($response);
?>
