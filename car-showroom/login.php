<?php
include 'includes/db.php';
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Admin Login Check
    $admin_query = "SELECT * FROM admins WHERE email = '$email'";
    $admin_result = mysqli_query($conn, $admin_query);

    if ($admin_result && mysqli_num_rows($admin_result) == 1) {
        $admin = mysqli_fetch_assoc($admin_result);

        if ($password == $admin['password']) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_email'] = $admin['email'];

            header("Location: admin/dashboard.php");
            exit();
        } else {
            $error = "Invalid admin password!";
        }
    } else {

        // User Login Check
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];

                header("Location: user/dashboard.php");
                exit();
            } else {
                $error = "Invalid user password!";
            }
        } else {
            $error = "Email not found!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AutoDrive</title>

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
        <a href="login.php" class="active">Login</a>
    </nav>

    <div class="menu-btn" id="menu-btn">
        <i class="fas fa-bars"></i>
    </div>
</header>

<section class="page-header">
    <h1>Login</h1>
    <p>Home / Login</p>
</section>

<section class="auth-section">
    <div class="auth-box">

        <h2>User / Admin Login</h2>

        <?php if ($error != "") { ?>
            <div class="error-message">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <form action="" method="POST">

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
                <i class="fas fa-lock"></i>
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Enter Password" 
                    required
                >
            </div>

            <button type="submit" name="login" class="btn auth-btn">
                Login
            </button>

            <p class="auth-link">
                Don't have an account?
                <a href="register.php">Register Here</a>
            </p>

        </form>

        <p class="auth-link">
            Admin Login: admin@gmail.com / admin123
        </p>

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