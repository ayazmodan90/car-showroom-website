<?php
session_start();
include '../includes/db.php';

$success = "";
$error = "";

if (!isset($_GET['id'])) {
    header("Location: manage-cars.php");
    exit();
}

$car_id = $_GET['id'];

$car_query = "SELECT * FROM cars WHERE id = '$car_id'";
$car_result = mysqli_query($conn, $car_query);

if (mysqli_num_rows($car_result) == 0) {
    header("Location: manage-cars.php");
    exit();
}

$car = mysqli_fetch_assoc($car_result);

if (isset($_POST['update_car'])) {

    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $fuel_type = mysqli_real_escape_string($conn, $_POST['fuel_type']);
    $transmission = mysqli_real_escape_string($conn, $_POST['transmission']);
    $mileage = mysqli_real_escape_string($conn, $_POST['mileage']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $image_name = $car['image'];

    if (!empty($_FILES['image']['name'])) {
        $new_image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        $image_folder = "../images/cars/" . $new_image;

        if (move_uploaded_file($image_tmp, $image_folder)) {
            $image_name = $new_image;
        } else {
            $error = "New image upload failed.";
        }
    }

    if ($error == "") {
        $update_query = "UPDATE cars SET 
                        brand = '$brand',
                        model = '$model',
                        price = '$price',
                        fuel_type = '$fuel_type',
                        transmission = '$transmission',
                        mileage = '$mileage',
                        year = '$year',
                        description = '$description',
                        image = '$image_name',
                        status = '$status'
                        WHERE id = '$car_id'";

        if (mysqli_query($conn, $update_query)) {
            $success = "Car updated successfully!";

            $car_query = "SELECT * FROM cars WHERE id = '$car_id'";
            $car_result = mysqli_query($conn, $car_query);
            $car = mysqli_fetch_assoc($car_result);
        } else {
            $error = "Failed to update car.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car - AutoDrive</title>

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
    <h1>Edit Car</h1>
    <p>Admin / Edit Car</p>
</section>

<section class="auth-section">
    <div class="auth-box large-form">

        <h2>Update Car Details</h2>

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
                <input 
                    type="text" 
                    name="brand" 
                    value="<?php echo $car['brand']; ?>" 
                    required
                >
            </div>

            <div class="input-box">
                <i class="fas fa-car-side"></i>
                <input 
                    type="text" 
                    name="model" 
                    value="<?php echo $car['model']; ?>" 
                    required
                >
            </div>

            <div class="input-box">
                <i class="fas fa-indian-rupee-sign"></i>
                <input 
                    type="number" 
                    name="price" 
                    value="<?php echo $car['price']; ?>" 
                    required
                >
            </div>

            <div class="input-box">
                <i class="fas fa-gas-pump"></i>
                <select name="fuel_type" required>
                    <option value="Petrol" <?php if ($car['fuel_type'] == 'Petrol') echo 'selected'; ?>>Petrol</option>
                    <option value="Diesel" <?php if ($car['fuel_type'] == 'Diesel') echo 'selected'; ?>>Diesel</option>
                    <option value="CNG" <?php if ($car['fuel_type'] == 'CNG') echo 'selected'; ?>>CNG</option>
                    <option value="Electric" <?php if ($car['fuel_type'] == 'Electric') echo 'selected'; ?>>Electric</option>
                    <option value="Hybrid" <?php if ($car['fuel_type'] == 'Hybrid') echo 'selected'; ?>>Hybrid</option>
                </select>
            </div>

            <div class="input-box">
                <i class="fas fa-gears"></i>
                <select name="transmission" required>
                    <option value="Manual" <?php if ($car['transmission'] == 'Manual') echo 'selected'; ?>>Manual</option>
                    <option value="Automatic" <?php if ($car['transmission'] == 'Automatic') echo 'selected'; ?>>Automatic</option>
                </select>
            </div>

            <div class="input-box">
                <i class="fas fa-road"></i>
                <input 
                    type="text" 
                    name="mileage" 
                    value="<?php echo $car['mileage']; ?>" 
                    required
                >
            </div>

            <div class="input-box">
                <i class="fas fa-calendar"></i>
                <input 
                    type="number" 
                    name="year" 
                    value="<?php echo $car['year']; ?>" 
                    required
                >
            </div>

            <div class="input-box">
                <i class="fas fa-check-circle"></i>
                <select name="status" required>
                    <option value="Available" <?php if ($car['status'] == 'Available') echo 'selected'; ?>>Available</option>
                    <option value="Sold" <?php if ($car['status'] == 'Sold') echo 'selected'; ?>>Sold</option>
                    <option value="Coming Soon" <?php if ($car['status'] == 'Coming Soon') echo 'selected'; ?>>Coming Soon</option>
                </select>
            </div>

            <div class="input-box textarea-box">
                <i class="fas fa-align-left"></i>
                <textarea name="description" rows="5" required><?php echo $car['description']; ?></textarea>
            </div>

            <div class="current-image">
                <p>Current Image:</p>
                <img 
                    src="../images/cars/<?php echo $car['image']; ?>" 
                    alt="Current Car Image"
                    class="table-img"
                >
            </div>

            <div class="input-box">
                <i class="fas fa-image"></i>
                <input type="file" name="image" accept="image/*">
            </div>

            <button type="submit" name="update_car" class="btn auth-btn">
                Update Car
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