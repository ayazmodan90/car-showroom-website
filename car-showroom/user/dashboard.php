<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$user_query = "SELECT * FROM users WHERE id = '$user_id'";
$user_result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($user_result);

$booking_query = "SELECT bookings.*, cars.brand, cars.model, cars.image
                  FROM bookings
                  INNER JOIN cars ON bookings.car_id = cars.id
                  WHERE bookings.user_id = '$user_id'
                  ORDER BY bookings.id DESC";

$booking_result = mysqli_query($conn, $booking_query);

$total_bookings = mysqli_num_rows($booking_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - AutoDrive</title>

    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<header class="header">

    <div class="logo">
        <h2>Auto<span>Drive</span></h2>
    </div>

    <nav class="navbar" id="navbar">
        <a href="../index.php">Home</a>
        <a href="../cars.php">Cars</a>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="my-bookings.php">My Bookings</a>
        <a href="profile.php">Profile</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <div class="menu-btn" id="menu-btn">
        <i class="fas fa-bars"></i>
    </div>

</header>

<section class="page-header">
    <h1>User Dashboard</h1>
    <p>Welcome, <?php echo $user['name']; ?></p>
</section>

<section class="dashboard-section">

    <div class="dashboard-cards">

        <div class="dashboard-card">
            <i class="fas fa-user"></i>
            <h2><?php echo $user['name']; ?></h2>
            <p>User Name</p>
        </div>

        <div class="dashboard-card">
            <i class="fas fa-envelope"></i>
            <h2><?php echo $user['email']; ?></h2>
            <p>Email Address</p>
        </div>

        <div class="dashboard-card">
            <i class="fas fa-car"></i>
            <h2><?php echo $total_bookings; ?></h2>
            <p>Total Bookings</p>
        </div>

    </div>

</section>

<section class="booking-section">

    <h2 class="section-title">Recent Bookings</h2>

    <div class="booking-container">

        <?php
        if (mysqli_num_rows($booking_result) > 0) {

            mysqli_data_seek($booking_result, 0);

            while ($booking = mysqli_fetch_assoc($booking_result)) {
        ?>

        <div class="booking-box">

            <img src="../images/cars/<?php echo $booking['image']; ?>" alt="Car Image">

            <div class="booking-info">

                <h3>
                    <?php echo $booking['brand']; ?>
                    <?php echo $booking['model']; ?>
                </h3>

                <p>
                    <strong>Booking Date:</strong>
                    <?php echo $booking['booking_date']; ?>
                </p>

                <p>
                    <strong>Status:</strong>

                    <span class="status">
                        <?php echo $booking['status']; ?>
                    </span>
                </p>

            </div>

        </div>

        <?php
            }
        } else {
            echo "<p class='no-data'>No bookings found.</p>";
        }
        ?>

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
            <a href="../index.php">Home</a>
            <a href="../cars.php">Cars</a>
            <a href="../contact.php">Contact</a>
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

<script src="../js/script.js"></script>

</body>
</html>