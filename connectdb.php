<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$mydb = 'dbcompfest_kantinkejujuran';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $mydb);

if (!$conn) {
    die('Could not connect: ' . mysqli_error());
}
