<?php
include 'config.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];

    $sql = "INSERT INTO books (title, author, isbn, genre, year) VALUES ('$title','$author','$isbn','$genre','$year')";

    if ($conn->query($sql) === TRUE) {
        $message = "✅ Book added successfully!";
    } else {
        $message = "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Book</title>
</head>
<body>
    <h1>Add a New Book</h1>
    <?php if(!empty($message)) { echo "<p>$message</p>"; } ?>

    <form method="POST" action="addbook.php">
        <label>Book Title:</label>
        <input type="text" name="title" required><br><br>

        <label>Author:</label>
        <input type="text" name="author" required><br><br>

        <label>ISBN:</label>
        <input type="text" name="isbn" required><br><br>

        <label>Genre:</label>
        <input type="text" name="genre" required><br><br>

        <label>Year:</label>
        <input type="number" name="year" required><br><br>

        <input type="submit" value="Add Book">
    </form>
    <br>
    <a href="index.php">Back to Book List</a>
</body>
</html>