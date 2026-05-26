<?php
include 'includes/db.php';
session_start();

if (!isset($_GET['id'])) {
    header("Location: cars.php");
    exit();
}

$car_id = $_GET['id'];

$query = "SELECT * FROM cars WHERE id = '$car_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    header("Location: cars.php");
    exit();
}

$car = mysqli_fetch_assoc($result);

$message = "";

if (isset($_POST['book_car'])) {

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $booking_date = date("Y-m-d");

    $booking_query = "INSERT INTO bookings (user_id, car_id, booking_date, status)
                      VALUES ('$user_id', '$car_id', '$booking_date', 'Pending')";

    if (mysqli_query($conn, $booking_query)) {
        $message = "Car booking request sent successfully!";
    } else {
        $message = "Booking failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details - AutoDrive</title>

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
        <a href="about.php">About</a>
        <a href="cars.php" class="active">Cars</a>
        <a href="contact.php">Contact</a>
        <a href="login.php">Login</a>
    </nav>

    <div class="menu-btn" id="menu-btn">
        <i class="fas fa-bars"></i>
    </div>
</header>

<section class="page-header">
    <h1>Car Details</h1>
    <p>Home / Cars / Details</p>
</section>

<section class="details-section">

    <?php if ($message != "") { ?>
        <div class="success-message">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <div class="details-container">

        <div class="details-img">
            <img src="images/cars/<?php echo $car['image']; ?>" alt="Car Image">
        </div>

        <div class="details-content">
            <h2>
                <?php echo $car['brand']; ?>
                <?php echo $car['model']; ?>
            </h2>

            <h3 class="details-price">
                ₹ <?php echo number_format($car['price']); ?>
            </h3>

            <p class="details-desc">
                <?php echo $car['description']; ?>
            </p>

            <div class="details-info">

                <p>
                    <i class="fas fa-gas-pump"></i>
                    <strong>Fuel Type:</strong>
                    <?php echo $car['fuel_type']; ?>
                </p>

                <p>
                    <i class="fas fa-cogs"></i>
                    <strong>Transmission:</strong>
                    <?php echo $car['transmission']; ?>
                </p>

                <p>
                    <i class="fas fa-road"></i>
                    <strong>Mileage:</strong>
                    <?php echo $car['mileage']; ?>
                </p>

                <p>
                    <i class="fas fa-calendar"></i>
                    <strong>Year:</strong>
                    <?php echo $car['year']; ?>
                </p>

                <p>
                    <i class="fas fa-check-circle"></i>
                    <strong>Status:</strong>
                    <?php echo $car['status']; ?>
                </p>

            </div>

            <form action="" method="POST">
                <button type="submit" name="book_car" class="btn">
                    Book This Car
                </button>
            </form>

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