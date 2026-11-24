<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header("Location: login.php");
    exit;
}
include 'config.php';

$message = "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['captcha'] != $_SESSION['answer']){
        $message = "Captcha answer wrong, try again.";
    } else {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $year = $_POST['year'];
        $genre = $_POST['genre'];

        $stmt = $conn->prepare("INSERT INTO books (title, author, isbn, year, genre) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $title, $author, $isbn, $year, $genre);

        if($stmt->execute()){
            $message = "Book added successfully!";
        } else {
            $message = "Error adding book.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add New Book</h1>
    <?php if(!empty($message)){ ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php } ?>

    <form method="POST">
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Author:</label>
        <input type="text" name="author" required>

        <label>ISBN:</label>
        <input type="text" name="isbn" required>

        <label>Year:</label>
        <input type="number" name="year" required>

        <label>Genre:</label>
        <input type="text" name="genre" required>

        <label>Captcha: <?php include "captcha.php"; ?></label>
        <input type="number" name="captcha" required>

        <button type="submit">Add Book</button>
    </form>
    <br>
    <a href="index.php">Back to Book Library</a>
</body>
</html>