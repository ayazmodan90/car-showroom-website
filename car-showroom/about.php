<?php
include 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - AutoDrive</title>

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<header class="header">
    <div class="logo">
        <h2>Auto<span>Drive</span></h2>
    </div>

    <nav class="navbar" id="navbar">
        <a href="index.php">Home</a>
        <a href="about.php" class="active">About</a>
        <a href="cars.php">Cars</a>
        <a href="contact.php">Contact</a>
        <a href="login.php">Login</a>
    </nav>

    <div class="menu-btn" id="menu-btn">
        <i class="fas fa-bars"></i>
    </div>
</header>

<section class="page-header">
    <h1>About Us</h1>
    <p>Home / About</p>
</section>

<section class="about-section">
    <div class="about-container">

        <div class="about-img">
            <img src="images/banner/about-car.jpg" alt="About AutoDrive">
        </div>

        <div class="about-content">
            <h2>Welcome To AutoDrive</h2>

            <p>
                AutoDrive is a modern car showroom website where customers can explore
                latest cars, check details, compare prices and book their dream car easily.
            </p>

            <p>
                We provide high quality cars with best price, trusted service and complete
                customer support. Our goal is to make car buying simple, safe and fast.
            </p>

            <div class="about-points">
                <p><i class="fas fa-check-circle"></i> Latest branded cars</p>
                <p><i class="fas fa-check-circle"></i> Affordable pricing</p>
                <p><i class="fas fa-check-circle"></i> Easy booking system</p>
                <p><i class="fas fa-check-circle"></i> Trusted customer support</p>
            </div>

            <a href="cars.php" class="btn">Explore Cars</a>
        </div>

    </div>
</section>

<section class="stats-section">
    <div class="stats-container">

        <div class="stats-box">
            <i class="fas fa-car"></i>
            <h3>500+</h3>
            <p>Cars Sold</p>
        </div>

        <div class="stats-box">
            <i class="fas fa-users"></i>
            <h3>1000+</h3>
            <p>Happy Customers</p>
        </div>

        <div class="stats-box">
            <i class="fas fa-award"></i>
            <h3>10+</h3>
            <p>Years Experience</p>
        </div>

        <div class="stats-box">
            <i class="fas fa-headset"></i>
            <h3>24/7</h3>
            <p>Support</p>
        </div>

    </div>
</section>

<section class="mission-section">
    <h2 class="section-title">Our Mission</h2>

    <div class="mission-container">

        <div class="mission-box">
            <i class="fas fa-bullseye"></i>
            <h3>Our Mission</h3>
            <p>
                To provide the best car buying experience with trusted service,
                transparent pricing and quality vehicles.
            </p>
        </div>

        <div class="mission-box">
            <i class="fas fa-eye"></i>
            <h3>Our Vision</h3>
            <p>
                To become a trusted and customer-friendly car showroom brand
                with modern digital services.
            </p>
        </div>

        <div class="mission-box">
            <i class="fas fa-handshake"></i>
            <h3>Our Values</h3>
            <p>
                Honesty, customer satisfaction, quality service and long-term trust
                are our main values.
            </p>
        </div>

    </div>
</section>

<footer class="footer">
    <div class="footer-container">

        <div class="footer-box">
            <h3>AutoDrive</h3>
            <p>Best showroom for premium and luxury cars.</p>
        </div>

        <div class="footer-box">
            <h3>Quick Links</h3>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="cars.php">Cars</a>
            <a href="contact.php">Contact</a>
        </div>

        <div class="footer-box">
            <h3>Follow Us</h3>
            <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
            <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
            <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© 2026 AutoDrive | All Rights Reserved</p>
    </div>
</footer>

<script src="js/script.js"></script>

</body>
</html>