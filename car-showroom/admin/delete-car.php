<?php
session_start();
include '../includes/db.php';

if (!isset($_GET['id'])) {
    header("Location: manage-cars.php");
    exit();
}

$car_id = $_GET['id'];

$car_query = "SELECT image FROM cars WHERE id = '$car_id'";
$car_result = mysqli_query($conn, $car_query);

if (mysqli_num_rows($car_result) > 0) {
    $car = mysqli_fetch_assoc($car_result);

    $image_path = "../images/cars/" . $car['image'];

    if (!empty($car['image']) && file_exists($image_path)) {
        unlink($image_path);
    }

    $delete_query = "DELETE FROM cars WHERE id = '$car_id'";

    if (mysqli_query($conn, $delete_query)) {
        header("Location: manage-cars.php");
        exit();
    } else {
        echo "Car delete failed!";
    }
} else {
    header("Location: manage-cars.php");
    exit();
}
?>