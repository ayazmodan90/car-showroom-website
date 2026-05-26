<?php
session_start();
include '../includes/db.php';

if (isset($_GET['delete'])) {
    $message_id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM contacts WHERE id='$message_id'");

    header("Location: messages.php");
    exit();
}

$query = "SELECT * FROM contacts ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - AutoDrive</title>

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
        <a href="bookings.php">Bookings</a>
        <a href="customers.php">Customers</a>
        <a href="messages.php" class="active">Messages</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <div class="menu-btn" id="menu-btn">
        <i class="fas fa-bars"></i>
    </div>

</header>

<section class="page-header">
    <h1>Contact Messages</h1>
    <p>Admin / Messages</p>
</section>

<section class="table-section">

    <h2 class="section-title">All Messages</h2>

    <div class="table-container">

        <table class="admin-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($msg = mysqli_fetch_assoc($result)) {
                ?>

                <tr>
                    <td><?php echo $msg['id']; ?></td>
                    <td><?php echo $msg['name']; ?></td>
                    <td><?php echo $msg['email']; ?></td>
                    <td><?php echo $msg['subject']; ?></td>
                    <td><?php echo $msg['message']; ?></td>
                    <td><?php echo $msg['created_at']; ?></td>

                    <td>
                        <a 
                            href="messages.php?delete=<?php echo $msg['id']; ?>" 
                            class="delete-btn"
                            onclick="return confirm('Are you sure you want to delete this message?');"
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
                    <td colspan="7" class="no-data">
                        No messages found.
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
            <p>Manage customer messages and website enquiries.</p>
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