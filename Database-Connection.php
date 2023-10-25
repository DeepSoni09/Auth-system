<?php

$conn = mysqli_connect("localhost", "root", "deeP@123d","user_information");
if (!$conn) {
    die("Could not connect to database" . mysqli_connect_error());
}
?>