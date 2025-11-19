<html>
<head>
    <style type="text/css">
        body {
            font-family: "Open Sans", sans-serif;
            color: #444444;
            margin: 0;
            padding: 0;
            background: #f8f9fa;
        }

        a {
            color: #47b2e4;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        a:hover {
            color: #73c5eb;
            text-decoration: underline;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: "Jost", sans-serif;
        }

        #footer {
            font-size: 14px;
            background: linear-gradient(135deg, #37517e, #1e2d50);
            color: #ffffff;
            padding-top: 60px;
        }

        #footer .footer-top {
            padding: 60px 0 30px 0;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            background: #ffffff;
            color: #444444;
        }

        #footer .footer-contact, 
        #footer .footer-links, 
        #footer .social-links {
            flex: 1;
            margin: 0 20px;
            padding: 10px;
        }

        #footer .footer-contact h3 {
            font-size: 28px;
            text-transform: uppercase;
            font-weight: 600;
            color: #37517e;
        }

        #footer .footer-contact p {
            font-size: 14px;
            line-height: 24px;
            color: #5e5e5e;
        }

        #footer .footer-links h4 {
            font-size: 18px;
            font-weight: bold;
            color: #37517e;
            padding-bottom: 12px;
            text-transform: uppercase;
        }

        #footer .footer-links ul {
            list-style: none;
            padding: 0;
        }

        #footer .footer-links ul li {
            padding: 10px 0;
            display: flex;
            align-items: center;
        }

        #footer .footer-links ul a {
            color: #777777;
            transition: color 0.3s ease;
        }

        #footer .footer-links ul a:hover {
            color: #47b2e4;
        }

        #footer .social-links {
            padding-top: 10px;
        }

        #footer .social-links h4 {
            color: #37517e;
            font-size: 18px;
            font-weight: bold;
        }

        #footer .social-links p {
            color: #5e5e5e;
        }

        #footer .social-links a {
            font-size: 18px;
            background: #47b2e4;
            color: #fff;
            padding: 8px 0;
            margin-right: 10px;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: inline-block;
            text-align: center;
            transition: background 0.3s ease;
        }

        #footer .social-links a:hover {
            background: #209dd8;
        }

        #footer .footer-bottom {
            display: flex;
            justify-content: space-between;
            padding-top: 30px;
            padding-bottom: 30px;
            background: #2a3b5c;
            color: #ffffff;
        }

        #footer .footer-bottom .copyright {
            font-size: 14px;
        }

        #footer .footer-bottom .credits a {
            color: #47b2e4;
        }

        #footer .footer-bottom .credits a:hover {
            color: #73c5eb;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            #footer .footer-top {
                flex-direction: column;
                align-items: center;
            }

            #footer .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

     <!-- Google Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" crossorigin="anonymous" />
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
</head>
<body>
<footer id="footer">
    <div class="footer-top">
        <div class="footer-contact">
            <h3><img src="assets/img/clients/n8.jpeg" style="width:80px;height:60px;"></h3>
            <p>
                Baramati <br>Pune, Maharashtra State<br>India <br><br>
                <strong>Phone:</strong> +91 7769875301<br>
                <strong>Email:</strong> <a href="mailto:aniketpawarpatil@gmail.com">aniketpawarpatil@gmail.com</a>
            </p>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#faq">FAQ</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

        <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Food Safety </a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Waste Reduction</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Hunger Relief</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Food Rescue </a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Redistribution </a></li>
            </ul>
          </div>

        <div class="social-links">
            <h4>Our Social Networks</h4>
            <p>Follow us on social media to stay updated about community waste management.</p>
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="copyright">
            &copy; Copyright <strong><span>FRN</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="#">Aniket Pawar</a> and <a href="#">Rohan Atole</a>
        </div>
    </div>
    
</footer>
</body>
</html>
