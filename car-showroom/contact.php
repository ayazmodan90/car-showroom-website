<?php
include 'includes/db.php';

$message = "";

if (isset($_POST['send_message'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $user_message = mysqli_real_escape_string($conn, $_POST['message']);

    $query = "INSERT INTO contacts (name, email, subject, message)
              VALUES ('$name', '$email', '$subject', '$user_message')";

    if (mysqli_query($conn, $query)) {
        $message = "Message sent successfully!";
    } else {
        $message = "Something went wrong. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - AutoDrive</title>

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
        <a href="contact.php" class="active">Contact</a>
        <a href="login.php">Login</a>
    </nav>

    <div class="menu-btn" id="menu-btn">
        <i class="fas fa-bars"></i>
    </div>
</header>

<section class="page-header">
    <h1>Contact Us</h1>
    <p>Home / Contact</p>
</section>

<section class="contact-section">

    <?php if ($message != "") { ?>
        <div class="success-message">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <div class="contact-container">

        <div class="contact-info">

            <h2>Get In Touch</h2>

            <p>
                Have any question about our cars or services?
                Contact us anytime.
            </p>

            <div class="contact-box">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <h3>Address</h3>
                    <p>Ahmedabad, Gujarat, India</p>
                </div>
            </div>

            <div class="contact-box">
                <i class="fas fa-phone"></i>
                <div>
                    <h3>Phone</h3>
                    <p>+91 98765 43210</p>
                </div>
            </div>

            <div class="contact-box">
                <i class="fas fa-envelope"></i>
                <div>
                    <h3>Email</h3>
                    <p>support@autodrive.com</p>
                </div>
            </div>

        </div>

        <div class="contact-form-box">

            <form action="" method="POST" class="contact-form">

                <input 
                    type="text" 
                    name="name" 
                    placeholder="Your Name" 
                    required
                >

                <input 
                    type="email" 
                    name="email" 
                    placeholder="Your Email" 
                    required
                >

                <input 
                    type="text" 
                    name="subject" 
                    placeholder="Subject" 
                    required
                >

                <textarea 
                    name="message" 
                    rows="6" 
                    placeholder="Your Message" 
                    required
                ></textarea>

                <button type="submit" name="send_message" class="btn">
                    Send Message
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