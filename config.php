<?php
$host = 'mi-linux.wlv.ac.uk';
$user = '2579122';
$pass = 'Aminasalihu123';
$dbname = 'db2579122';

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>