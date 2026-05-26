<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "car_showroom";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// Set UTF-8 Encoding
mysqli_set_charset($conn, "utf8");

?>