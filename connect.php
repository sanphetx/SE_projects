<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "advisor-g1";

$conn = mysqli_connect($servername, $username, $password, $db);

mysqli_set_charset($conn, "utf8");

if (!$conn) {
    die("can not connect to data base" . mysqli_connect_error());
} else {
    //echo "connected!";
}
