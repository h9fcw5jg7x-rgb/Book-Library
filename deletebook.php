<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header("Location: login.php");
    exit;
}
include 'config.php';

$isbn = $_GET['isbn'];
$stmt = $conn->prepare("DELETE FROM books WHERE isbn = ?");
$stmt->bind_param("s", $isbn);
$stmt->execute();

header("Location: index.php");
?>