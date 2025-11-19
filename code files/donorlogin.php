<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">

    <style>
        /* General styling */
        html, body {
            font-family: 'Circular Std', sans-serif;
        }
        .bgimg{
           background-image: url('img/donorloginbg.jpg'); /* Set background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

        }
        body {
            display: flex;
            flex-direction: column;
            padding: 0;
            height: 100vh;
            background: #f8f9fa;
        }

        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            padding: 20px;
        }

        .splash-container {
            max-width: 450px;
            width: 100%;
        }

        .card {
            border: none;
            border-radius: 15px;
            background-image: url('img/donorloginbg.jpg'); /* Set background image on the form */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3); /* Keep some shadow for contrast */
            overflow: hidden;
        }

        /* Card header with gradient background */
        .card-header {
            background: rgba(0, 123, 255, 0.9);
            padding: 1.5rem;
            text-align: center;
            color: white;
        }

        .card-header img {
            max-height: 120px;
        }

        .splash-description {
            margin-top: 1rem;
            font-size: 1.1rem;
            color: #fff;
        }

        /* Card body */
        .card-body {
            padding: 2rem;
            background-color: rgba(255, 255, 255, 0.85); /* Make body background slightly transparent */
            border-radius: 15px;
        }

        .form-control {
            border: none;
            border-radius: 30px;
            padding: 0.75rem 1.25rem;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent fields */
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 1); /* Fully opaque on focus */
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.4);
        }

        .btn {
            border-radius: 30px;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Card footer */
        .card-footer {
            background-color: transparent;
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            font-size: 0.9rem;
        }

        .card-footer-item a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .card-footer-item a:hover {
            color: #0056b3;
        }

        /* Responsive styling */
        @media (max-width: 576px) {
            .splash-container {
                width: 100%;
                padding: 1rem;
            }

            .card {
                border-radius: 10px;
            }

            .card-body {
                background-color: rgba(255, 255, 255, 0.9); /* Slightly more opaque for better contrast */
            }
        }

    </style>
</head>

<body>

    <!-- Include the navigation -->
    <?php @include 'nav.php'; ?>
    <div class="bgimg">
    <!-- Center the login form with collapsed background -->
    <div class="login-wrapper">
        <div class="splash-container">
            <div class="card">
                <div class="card-header">
                    <a href="#"><img class="logo-img" src="img/logo.png" alt="logo"></a>
                    <span class="splash-description">Please enter your login details</span>
                </div>
                <div class="card-body">
                    <form id="loginForm">
                        <div class="form-group">
                            <input class="form-control form-control-lg" id="username" name="username" type="text" placeholder="Username" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-lg" id="password" name="password" type="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="remember_me">
                                <span class="custom-control-label">Remember Me</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-lg btn-block">Sign In</button>
                    </form>
                    <div id="message" class="mt-3"></div>
                </div>
                <div class="card-footer">
                    <div class="card-footer-item">
                        <a href="donorres.php" class="footer-link">Create An Account</a>
                    </div>
                    <div class="card-footer-item">
                        <a href="#" class="footer-link">Forgot Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>

    <!-- Custom Script -->
    <script>
        $(document).ready(function () {
            $('#loginForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: 'donorloginphp.php',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.success) {
                            $('#message').html('<div class="alert alert-success">Login successful. Redirecting...</div>');
                            setTimeout(function () {
                                window.location.href = response.redirect;
                            }, 1000);
                        } else {
                            $('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function () {
                        $('#message').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                    }
                });
            });
        });
    </script>
</div>
</body>

</html>

<?php @include 'footer.php'; ?>
