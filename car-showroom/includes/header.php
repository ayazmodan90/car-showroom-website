<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="header">

    <div class="logo">
        <a href="index.php">
            <h2>Auto<span>Drive</span></h2>
        </a>
    </div>

    <nav class="navbar" id="navbar">

        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="cars.php">Cars</a>
        <a href="contact.php">Contact</a>

        <?php if (isset($_SESSION['user_id'])) { ?>

            <a href="user/dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>

        <?php } else { ?>

            <a href="login.php">Login</a>
            <a href="register.php">Register</a>

        <?php } ?>

    </nav>

    <div class="menu-btn" id="menu-btn">
        <i class="fas fa-bars"></i>
    </div>

</header>