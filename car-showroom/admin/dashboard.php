<?php
session_start();
include '../includes/db.php';

$total_cars = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM cars"));
$total_users = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
$total_bookings = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bookings"));
$total_messages = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM contacts"));

$pending_bookings = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bookings WHERE status='Pending'"));
$approved_bookings = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bookings WHERE status='Approved'"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - AutoDrive</title>

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
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="add-car.php">Add Car</a>
        <a href="manage-cars.php">Manage Cars</a>
        <a href="bookings.php">Bookings</a>
        <a href="customers.php">Customers</a>
        <a href="messages.php">Messages</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <div class="menu-btn" id="menu-btn">
        <i class="fas fa-bars"></i>
    </div>

</header>

<section class="page-header">
    <h1>Admin Dashboard</h1>
    <p>Manage your car showroom website</p>
</section>

<section class="dashboard-section">

    <div class="dashboard-cards">

        <div class="dashboard-card">
            <i class="fas fa-car"></i>
            <h2><?php echo $total_cars; ?></h2>
            <p>Total Cars</p>
        </div>

        <div class="dashboard-card">
            <i class="fas fa-users"></i>
            <h2><?php echo $total_users; ?></h2>
            <p>Total Users</p>
        </div>

        <div class="dashboard-card">
            <i class="fas fa-calendar-check"></i>
            <h2><?php echo $total_bookings; ?></h2>
            <p>Total Bookings</p>
        </div>

        <div class="dashboard-card">
            <i class="fas fa-envelope"></i>
            <h2><?php echo $total_messages; ?></h2>
            <p>Total Messages</p>
        </div>

        <div class="dashboard-card">
            <i class="fas fa-clock"></i>
            <h2><?php echo $pending_bookings; ?></h2>
            <p>Pending Bookings</p>
        </div>

        <div class="dashboard-card">
            <i class="fas fa-check-circle"></i>
            <h2><?php echo $approved_bookings; ?></h2>
            <p>Approved Bookings</p>
        </div>

    </div>

</section>

<section class="admin-actions">

    <h2 class="section-title">Quick Actions</h2>

    <div class="action-container">

        <a href="add-car.php" class="action-box">
            <i class="fas fa-plus-circle"></i>
            <h3>Add New Car</h3>
        </a>

        <a href="manage-cars.php" class="action-box">
            <i class="fas fa-edit"></i>
            <h3>Manage Cars</h3>
        </a>

        <a href="bookings.php" class="action-box">
            <i class="fas fa-calendar-check"></i>
            <h3>View Bookings</h3>
        </a>

        <a href="customers.php" class="action-box">
            <i class="fas fa-users"></i>
            <h3>View Customers</h3>
        </a>

    </div>

</section>

<footer class="footer">

    <div class="footer-container">

        <div class="footer-box">
            <h3>AutoDrive Admin</h3>
            <p>Manage cars, customers, bookings and messages.</p>
        </div>

        <div class="footer-box">
            <h3>Admin Links</h3>
            <a href="dashboard.php">Dashboard</a>
            <a href="add-car.php">Add Car</a>
            <a href="manage-cars.php">Manage Cars</a>
            <a href="bookings.php">Bookings</a>
        </div>

        <div class="footer-box">
            <h3>Website</h3>
            <a href="../index.php">View Website</a>
            <a href="../cars.php">Cars Page</a>
            <a href="../contact.php">Contact Page</a>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© 2026 AutoDrive | Admin Panel</p>
    </div>

</footer>

<script src="../js/script.js"></script>

</body>
</html>