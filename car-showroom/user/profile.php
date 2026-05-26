<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$success = "";
$error = "";

$user_query = "SELECT * FROM users WHERE id = '$user_id'";
$user_result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($user_result);

if (isset($_POST['update_profile'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $update_query = "UPDATE users 
                     SET name='$name', email='$email', phone='$phone'
                     WHERE id='$user_id'";

    if (mysqli_query($conn, $update_query)) {

        $_SESSION['user_name'] = $name;

        $success = "Profile updated successfully!";

        $user_query = "SELECT * FROM users WHERE id = '$user_id'";
        $user_result = mysqli_query($conn, $user_query);
        $user = mysqli_fetch_assoc($user_result);

    } else {
        $error = "Failed to update profile!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - AutoDrive</title>

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
        <a href="dashboard.php">Dashboard</a>
        <a href="my-bookings.php">My Bookings</a>
        <a href="profile.php" class="active">Profile</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <div class="menu-btn" id="menu-btn">
        <i class="fas fa-bars"></i>
    </div>

</header>

<section class="page-header">
    <h1>My Profile</h1>
    <p>Home / Profile</p>
</section>

<section class="profile-section">

    <div class="profile-container">

        <div class="profile-card">

            <div class="profile-icon">
                <i class="fas fa-user-circle"></i>
            </div>

            <h2><?php echo $user['name']; ?></h2>
            <p><?php echo $user['email']; ?></p>

        </div>

        <div class="profile-form-box">

            <h2>Update Profile</h2>

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

            <form action="" method="POST" class="profile-form">

                <div class="input-box">
                    <i class="fas fa-user"></i>

                    <input 
                        type="text" 
                        name="name"
                        value="<?php echo $user['name']; ?>"
                        required
                    >
                </div>

                <div class="input-box">
                    <i class="fas fa-envelope"></i>

                    <input 
                        type="email" 
                        name="email"
                        value="<?php echo $user['email']; ?>"
                        required
                    >
                </div>

                <div class="input-box">
                    <i class="fas fa-phone"></i>

                    <input 
                        type="text" 
                        name="phone"
                        value="<?php echo $user['phone']; ?>"
                        required
                    >
                </div>

                <button type="submit" name="update_profile" class="btn">
                    Update Profile
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