<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: donorlogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Rescue Network Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            background-color: #f9f9f9;
        }

        nav.top-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2c3e50;
            padding: 15px 30px;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        .logo-container img {
            height: 60px;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .nav-links {
            display: flex;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
            font-size: 25px;
            padding-right: 750px;
        }

        .nav-links li {
            margin: 0 15px;
        }

        .nav-links a {
            color: #ecf0f1;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 15px;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 5px;
        }

        .nav-links a:hover {
            background-color: #34495e;
        }

        .settings-container {
            position: relative;
        }

        .settings-icon {
            width: 35px;
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%; /* Positioned below the settings icon */
            right: 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            min-width: 160px;
            z-index: 2000; /* Ensure it stays above other content */
        }

        .dropdown-menu a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
            font-weight: 500;
            border-bottom: 1px solid #f0f0f0;
        }

        .dropdown-menu a:last-child {
            border-bottom: none;
        }

        .dropdown-menu a:hover {
            background-color: #f0f0f0;
        }

        aside.left-sidebar {
            width: 220px;
            background-color: #34495e;
            padding: 20px;
            position: fixed;
            top: 70px;
            bottom: 0;
            left: 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar-content a {
            display: block;
            padding: 10px;
            margin: 10px 0;
            color: #ecf0f1;
            text-decoration: none;
            font-weight: 600;
            background-color: #2c3e50;
            border-radius: 5px;
            transition: background-color 0.3s, padding-left 0.3s;
        }

        .sidebar-content a:hover {
            background-color: #1abc9c;
            padding-left: 20px;
        }

        main {
            margin-left: 240px;
            padding: 0px;
            margin-top: 70px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="top-navbar">
        <div class="logo-container">
            <img src="../img/logo.png" alt="Food Rescue Network Logo">
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact_us.php">Contact</a></li>
        </ul>
        <div class="settings-container">
            <img src="/sample/img/setting.png" alt="Settings" class="settings-icon">
            <div class="dropdown-menu">
                <a href="#">View Profile</a>
                <a href="#">Donor Information</a>
                
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="left-sidebar">
        <div class="sidebar-content">
            <a href="admin_dash.php">Doneted Food</a>
            <a href="charityrequest.php">Charity Requests</a>
            <a href="allcharity.php">All Charity</a>
            <a href="alldonor.php">All Donor</a>
            <a href="showmessage.php">Feedbacks</a>
            <a href="logout.php">Logout</a>
        </div>
    </aside>

    <main>
        <!-- Main content goes here -->
    </main>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const settingsIcon = document.querySelector('.settings-icon');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            settingsIcon.addEventListener('click', () => {
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
            });

            document.addEventListener('click', (event) => {
                if (!settingsIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
