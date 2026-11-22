<?php
include 'config.php';
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isbn = $_POST['isbn'];
    $sql = "DELETE FROM books WHERE isbn = '$isbn'";

    if ($conn->query($sql) === TRUE) {
        $message = "✅ Book deleted successfully!";
    } else {
        $message = "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete a Book</title>
</head>
<body>
    <h1>Delete a Book</h1>
    <?php if(!empty($message)) { echo "<p>$message</p>"; } ?>

    <form method="POST" action="deletebook.php">
        <label>Enter the ISBN of the book to delete:</label>
        <input type="text" name="isbn" required>
        <br><br>
        <input type="submit" value="Delete Book">
    </form>
    <br>
    <a href="index.php">Back to Book List</a>
</body>
</html>