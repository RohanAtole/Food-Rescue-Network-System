<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <style>
        .navbar-custom {
            background-color: #002366; /* Dark blue background */
        }
        .navbar-custom .nav-link {
            color: white !important;
        }
        .navbar-custom .nav-link:hover {
            color: #f8f9fa !important; /* Slightly lighter text color on hover */
        }
        .navbar-brand img {
            height: 50px;
            width: auto;
        }
        .navbar-right-logo {
            display: flex;
            align-items: center;
        }
        .navbar-right-logo img {
            height: 50px;
            width: auto;
            margin-right: 10px;
        }
        .navbar-right-logo span {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            margin-left: 5px;
        }
        .logo-button {
            border: none;
            background-color: transparent;
            cursor: pointer;
        }
        .logo-button img {
            height: 40px;
            width: auto;
        }
        .logo-button:hover {
            opacity: 0.8; /* Hover effect for logo */
        }
        .icon-link {
            color: white !important;
            font-size: 1.5rem;
            margin-right: 15px;
        }
        .icon-link:hover {
            color: #f8f9fa !important; /* Hover effect for icons */
            transform: scale(1.1); /* Slight zoom effect on hover */
        }
        /* Dropdown menu styling */
        .dropdown-menu {
            background-color: #002366;
        }
        .dropdown-item {
            color: white;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;x
            color: #002366;
        }
        /* Show the dropdown on hover */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <!-- Logo as a button within the navbar -->
        <div class="navbar-right-logo">
            <button class="logo-button" onclick="window.location.href='home.php'">
                <img src="img/logo.png" alt="Logo">
            </button>
            <span>Food Rescue Network</span>
        </div>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fas fa-bars" style="color: white;"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- Home icon -->
                <li class="nav-item">
                    <a class="nav-link icon-link" href="index.php">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link icon-link" href="contact_us.php">
                        <i class="fas fa-envelope"></i>
                    </a>
                </li>
                <!-- Dropdown for Donor and Charity Login (with hover effect) -->
                <li class="nav-item dropdown">
                    <a class="nav-link icon-link dropdown-toggle" href="#" id="loginDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="loginDropdown">
                        <a class="dropdown-item" href="donorlogin.php">Donor Login</a>
                        <a class="dropdown-item" href="charitylogin.php">Charity Login</a>
                    </div>
                </li>
                <!-- Contact Us icon (replacing Logout) -->
            </ul>
        </div>
    </nav>

    <!-- Required JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
