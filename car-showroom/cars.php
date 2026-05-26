<?php
include 'includes/db.php';

$search = "";
$where = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $where = "WHERE brand LIKE '%$search%' OR model LIKE '%$search%' OR fuel_type LIKE '%$search%'";
}

$query = "SELECT * FROM cars $where ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars - AutoDrive</title>

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
    <h1>Our Cars</h1>
    <p>Home / Cars</p>
</section>

<section class="search-section">
    <form action="cars.php" method="GET" class="search-form">
        <input 
            type="text" 
            name="search" 
            placeholder="Search by brand, model or fuel type..."
            value="<?php echo htmlspecialchars($search); ?>"
        >
        <button type="submit" class="btn">
            <i class="fas fa-search"></i> Search
        </button>
    </form>
</section>

<section class="cars">
    <h2 class="section-title">Available Cars</h2>

    <div class="car-container">

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>

        <div class="car-box">
            <img src="images/cars/<?php echo $row['image']; ?>" alt="Car Image">

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

                <p>
                    <i class="fas fa-calendar"></i>
                    <?php echo $row['year']; ?>
                </p>

                <p>
                    <i class="fas fa-road"></i>
                    <?php echo $row['mileage']; ?>
                </p>

                <a href="car-details.php?id=<?php echo $row['id']; ?>" class="btn">
                    View Details
                </a>
            </div>
        </div>

        <?php
            }
        } else {
            echo "<p class='no-data'>No Cars Found</p>";
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