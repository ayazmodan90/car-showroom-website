<?php
session_start();
include '../includes/db.php';

if (isset($_GET['approve'])) {
    $booking_id = $_GET['approve'];

    mysqli_query($conn, "UPDATE bookings SET status='Approved' WHERE id='$booking_id'");

    header("Location: bookings.php");
    exit();
}

if (isset($_GET['reject'])) {
    $booking_id = $_GET['reject'];

    mysqli_query($conn, "UPDATE bookings SET status='Rejected' WHERE id='$booking_id'");

    header("Location: bookings.php");
    exit();
}

if (isset($_GET['delete'])) {
    $booking_id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM bookings WHERE id='$booking_id'");

    header("Location: bookings.php");
    exit();
}

$query = "SELECT bookings.*, users.name, users.email, users.phone,
                 cars.brand, cars.model, cars.price, cars.image
          FROM bookings
          INNER JOIN users ON bookings.user_id = users.id
          INNER JOIN cars ON bookings.car_id = cars.id
          ORDER BY bookings.id DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings - AutoDrive</title>

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
        <a href="dashboard.php">Dashboard</a>
        <a href="add-car.php">Add Car</a>
        <a href="manage-cars.php">Manage Cars</a>
        <a href="bookings.php" class="active">Bookings</a>
        <a href="customers.php">Customers</a>
        <a href="messages.php">Messages</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <div class="menu-btn" id="menu-btn">
        <i class="fas fa-bars"></i>
    </div>

</header>

<section class="page-header">
    <h1>Car Bookings</h1>
    <p>Admin / Bookings</p>
</section>

<section class="table-section">

    <h2 class="section-title">All Booking Requests</h2>

    <div class="table-container">

        <table class="admin-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Car</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Price</th>
                    <th>Booking Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($booking = mysqli_fetch_assoc($result)) {
                ?>

                <tr>
                    <td><?php echo $booking['id']; ?></td>

                    <td>
                        <img 
                            src="../images/cars/<?php echo $booking['image']; ?>" 
                            alt="Car Image" 
                            class="table-img"
                        >
                        <br>
                        <?php echo $booking['brand']; ?> <?php echo $booking['model']; ?>
                    </td>

                    <td><?php echo $booking['name']; ?></td>
                    <td><?php echo $booking['email']; ?></td>
                    <td><?php echo $booking['phone']; ?></td>

                    <td>
                        ₹ <?php echo number_format($booking['price']); ?>
                    </td>

                    <td><?php echo $booking['booking_date']; ?></td>

                    <td>
                        <span class="status">
                            <?php echo $booking['status']; ?>
                        </span>
                    </td>

                    <td>
                        <a 
                            href="bookings.php?approve=<?php echo $booking['id']; ?>" 
                            class="edit-btn"
                        >
                            <i class="fas fa-check"></i>
                        </a>

                        <a 
                            href="bookings.php?reject=<?php echo $booking['id']; ?>" 
                            class="delete-btn"
                        >
                            <i class="fas fa-times"></i>
                        </a>

                        <a 
                            href="bookings.php?delete=<?php echo $booking['id']; ?>" 
                            class="delete-btn"
                            onclick="return confirm('Are you sure you want to delete this booking?');"
                        >
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>

                <?php
                    }
                } else {
                ?>

                <tr>
                    <td colspan="9" class="no-data">
                        No bookings found.
                    </td>
                </tr>

                <?php
                }
                ?>

            </tbody>

        </table>

    </div>

</section>

<footer class="footer">

    <div class="footer-container">

        <div class="footer-box">
            <h3>AutoDrive Admin</h3>
            <p>Manage showroom cars and bookings.</p>
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