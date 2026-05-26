<?php
include 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Showroom</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<!-- ================= NAVBAR ================= -->

<header class="header">

    <div class="logo">
        <h2>Auto<span>Drive</span></h2>
    </div>

    <nav class="navbar" id="navbar">

        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="cars.php">Cars</a>
        <a href="contact.php">Contact</a>
        <a href="login.php">Login</a>

    </nav>

    <div class="menu-btn" id="menu-btn">
        <i class="fas fa-bars"></i>
    </div>

</header>

<!-- ================= HERO SECTION ================= -->

<section class="hero">

    <div class="hero-content">

        <h1>Find Your Dream Car</h1>

        <p>
            Premium cars with best prices, luxury interiors,
            modern technology and amazing performance.
        </p>

        <a href="cars.php" class="btn">Explore Cars</a>

    </div>

</section>

<!-- ================= FEATURES ================= -->

<section class="features">

    <h2 class="section-title">Why Choose Us</h2>

    <div class="feature-container">

        <div class="feature-box">
            <i class="fas fa-car"></i>
            <h3>Latest Cars</h3>
            <p>We provide latest branded luxury cars.</p>
        </div>

        <div class="feature-box">
            <i class="fas fa-dollar-sign"></i>
            <h3>Best Price</h3>
            <p>Affordable prices with premium quality.</p>
        </div>

        <div class="feature-box">
            <i class="fas fa-headset"></i>
            <h3>24/7 Support</h3>
            <p>Customer support available anytime.</p>
        </div>

    </div>

</section>

<!-- ================= LATEST CARS ================= -->

<section class="cars">

    <h2 class="section-title">Latest Cars</h2>

    <div class="car-container">

        <?php

        $query = "SELECT * FROM cars LIMIT 6";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
        ?>

        <div class="car-box">

            <img src="images/cars/<?php echo $row['image']; ?>" alt="">

            <div class="car-info">

                <h3>
                    <?php echo $row['brand']; ?>
                    <?php echo $row['model']; ?>
                </h3>

                <p class="price">
                    ₹ <?php echo number_format($row['price']); ?>
                </p>

                <p>
                    <i class="fas fa-gas-pump"></i>
                    <?php echo $row['fuel_type']; ?>
                </p>

                <p>
                    <i class="fas fa-cogs"></i>
                    <?php echo $row['transmission']; ?>
                </p>

                <a href="car-details.php?id=<?php echo $row['id']; ?>" class="btn">
                    View Details
                </a>

            </div>

        </div>

        <?php
            }
        }
        else
        {
            echo "<p>No Cars Available</p>";
        }

        ?>

    </div>

</section>

<!-- ================= BANNER ================= -->

<section class="banner">

    <div class="banner-content">

        <h2>Luxury Cars Collection</h2>

        <p>
            Experience premium comfort and high performance cars.
        </p>

        <a href="cars.php" class="btn">Book Now</a>

    </div>

</section>

<!-- ================= FOOTER ================= -->

<footer class="footer">

    <div class="footer-container">

        <div class="footer-box">
            <h3>AutoDrive</h3>

            <p>
                Best showroom for premium and luxury cars.
            </p>
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

<!-- ================= JS ================= -->

<script src="js/script.js"></script>

</body>
</html>