<?php
include 'includes/db.php';
session_start();

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        $error = "Password and Confirm Password do not match!";
    } else {
        $check_email = "SELECT * FROM users WHERE email = '$email'";
        $check_result = mysqli_query($conn, $check_email);

        if (mysqli_num_rows($check_result) > 0) {
            $error = "Email already registered!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (name, email, phone, password)
                      VALUES ('$name', '$email', '$phone', '$hashed_password')";

            if (mysqli_query($conn, $query)) {
                $success = "Registration successful! You can login now.";
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AutoDrive</title>

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
        <a href="cars.php">Cars</a>
        <a href="contact.php">Contact</a>
        <a href="login.php">Login</a>
    </nav>

    <div class="menu-btn" id="menu-btn">
        <i class="fas fa-bars"></i>
    </div>
</header>

<section class="page-header">
    <h1>Register</h1>
    <p>Home / Register</p>
</section>

<section class="auth-section">
    <div class="auth-box">

        <h2>Create Account</h2>

        <?php if ($error != "") { ?>
            <div class="error-message">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <?php if ($success != "") { ?>
            <div class="success-message">
                <?php echo $success; ?>
            </div>
        <?php } ?>

        <form action="" method="POST">

            <div class="input-box">
                <i class="fas fa-user"></i>
                <input 
                    type="text" 
                    name="name" 
                    placeholder="Enter Full Name" 
                    required
                >
            </div>

            <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input 
                    type="email" 
                    name="email" 
                    placeholder="Enter Email" 
                    required
                >
            </div>

            <div class="input-box">
                <i class="fas fa-phone"></i>
                <input 
                    type="text" 
                    name="phone" 
                    placeholder="Enter Phone Number" 
                    required
                >
            </div>

            <div class="input-box">
                <i class="fas fa-lock"></i>
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Enter Password" 
                    required
                >
            </div>

            <div class="input-box">
                <i class="fas fa-lock"></i>
                <input 
                    type="password" 
                    name="confirm_password" 
                    placeholder="Confirm Password" 
                    required
                >
            </div>

            <button type="submit" name="register" class="btn auth-btn">
                Register
            </button>

            <p class="auth-link">
                Already have an account?
                <a href="login.php">Login Here</a>
            </p>

        </form>

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