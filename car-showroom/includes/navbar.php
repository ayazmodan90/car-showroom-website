<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar" id="navbar">

    <a href="index.php">Home</a>

    <a href="about.php">About</a>

    <a href="cars.php">Cars</a>

    <a href="contact.php">Contact</a>

    <?php if (isset($_SESSION['user_id'])) { ?>

        <a href="user/dashboard.php">Dashboard</a>

        <a href="user/my-bookings.php">My Bookings</a>

        <a href="user/profile.php">Profile</a>

        <a href="logout.php">Logout</a>

    <?php } else { ?>

        <a href="login.php">Login</a>

        <a href="register.php">Register</a>

    <?php } ?>

</nav>