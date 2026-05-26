<?php
session_start();
include '../includes/db.php';

$success = "";
$error = "";

if (isset($_POST['add_car'])) {

    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $fuel_type = mysqli_real_escape_string($conn, $_POST['fuel_type']);
    $transmission = mysqli_real_escape_string($conn, $_POST['transmission']);
    $mileage = mysqli_real_escape_string($conn, $_POST['mileage']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    $image_folder = "../images/cars/" . $image;

    if (move_uploaded_file($image_tmp, $image_folder)) {

        $query = "INSERT INTO cars 
                  (brand, model, price, fuel_type, transmission, mileage, year, description, image, status)
                  VALUES 
                  ('$brand', '$model', '$price', '$fuel_type', '$transmission', '$mileage', '$year', '$description', '$image', '$status')";

        if (mysqli_query($conn, $query)) {
            $success = "Car added successfully!";
        } else {
            $error = "Failed to add car.";
        }

    } else {
        $error = "Image upload failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car - AutoDrive</title>

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
        <a href="add-car.php" class="active">Add Car</a>
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
    <h1>Add New Car</h1>
    <p>Admin / Add Car</p>
</section>

<section class="auth-section">
    <div class="auth-box large-form">

        <h2>Add Car Details</h2>

        <?php if ($success != "") { ?>
            <div class="success-message">
                <?php echo $success; ?>
            </div>
        <?php } ?>

        <?php if ($error != "") { ?>
            <div class="error-message">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <div class="input-box">
                <i class="fas fa-car"></i>
                <input type="text" name="brand" placeholder="Car Brand" required>
            </div>

            <div class="input-box">
                <i class="fas fa-car-side"></i>
                <input type="text" name="model" placeholder="Car Model" required>
            </div>

            <div class="input-box">
                <i class="fas fa-indian-rupee-sign"></i>
                <input type="number" name="price" placeholder="Car Price" required>
            </div>

            <div class="input-box">
                <i class="fas fa-gas-pump"></i>
                <select name="fuel_type" required>
                    <option value="">Select Fuel Type</option>
                    <option value="Petrol">Petrol</option>
                    <option value="Diesel">Diesel</option>
                    <option value="CNG">CNG</option>
                    <option value="Electric">Electric</option>
                    <option value="Hybrid">Hybrid</option>
                </select>
            </div>

            <div class="input-box">
                <i class="fas fa-gears"></i>
                <select name="transmission" required>
                    <option value="">Select Transmission</option>
                    <option value="Manual">Manual</option>
                    <option value="Automatic">Automatic</option>
                </select>
            </div>

            <div class="input-box">
                <i class="fas fa-road"></i>
                <input type="text" name="mileage" placeholder="Mileage e.g. 18 km/l" required>
            </div>

            <div class="input-box">
                <i class="fas fa-calendar"></i>
                <input type="number" name="year" placeholder="Car Year" required>
            </div>

            <div class="input-box">
                <i class="fas fa-check-circle"></i>
                <select name="status" required>
                    <option value="Available">Available</option>
                    <option value="Sold">Sold</option>
                    <option value="Coming Soon">Coming Soon</option>
                </select>
            </div>

            <div class="input-box textarea-box">
                <i class="fas fa-align-left"></i>
                <textarea name="description" rows="5" placeholder="Car Description" required></textarea>
            </div>

            <div class="input-box">
                <i class="fas fa-image"></i>
                <input type="file" name="image" accept="image/*" required>
            </div>

            <button type="submit" name="add_car" class="btn auth-btn">
                Add Car
            </button>

        </form>

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