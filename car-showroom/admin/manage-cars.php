<?php
session_start();
include '../includes/db.php';

$query = "SELECT * FROM cars ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars - AutoDrive</title>

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
        <a href="manage-cars.php" class="active">Manage Cars</a>
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
    <h1>Manage Cars</h1>
    <p>Admin / Manage Cars</p>
</section>

<section class="table-section">

    <h2 class="section-title">All Cars</h2>

    <div class="table-container">

        <table class="admin-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Fuel</th>
                    <th>Transmission</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($car = mysqli_fetch_assoc($result)) {
                ?>

                <tr>
                    <td><?php echo $car['id']; ?></td>

                    <td>
                        <img 
                            src="../images/cars/<?php echo $car['image']; ?>" 
                            alt="Car Image" 
                            class="table-img"
                        >
                    </td>

                    <td><?php echo $car['brand']; ?></td>
                    <td><?php echo $car['model']; ?></td>

                    <td>
                        ₹ <?php echo number_format($car['price']); ?>
                    </td>

                    <td><?php echo $car['fuel_type']; ?></td>
                    <td><?php echo $car['transmission']; ?></td>
                    <td><?php echo $car['year']; ?></td>

                    <td>
                        <span class="status">
                            <?php echo $car['status']; ?>
                        </span>
                    </td>

                    <td>
                        <a 
                            href="edit-car.php?id=<?php echo $car['id']; ?>" 
                            class="edit-btn"
                        >
                            <i class="fas fa-edit"></i>
                        </a>

                        <a 
                            href="delete-car.php?id=<?php echo $car['id']; ?>" 
                            class="delete-btn"
                            onclick="return confirm('Are you sure you want to delete this car?');"
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
                    <td colspan="10" class="no-data">
                        No cars found.
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