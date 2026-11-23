<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];

    $update = $conn->prepare("UPDATE books SET title=?, author=?, isbn=?, year=?, genre=? WHERE id=?");
    $update->bind_param("sssssi", $title, $author, $isbn, $year, $genre, $id);
    $update->execute();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
</head>
<body>
    <h1>Edit Book</h1>
    <form method="POST">
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo $book['title']; ?>" required><br><br>

        <label>Author:</label>
        <input type="text" name="author" value="<?php echo $book['author']; ?>" required><br><br>

        <label>ISBN:</label>
        <input type="text" name="isbn" value="<?php echo $book['isbn']; ?>" required><br><br>

        <label>Year:</label>
        <input type="number" name="year" value="<?php echo $book['year']; ?>" required><br><br>

        <label>Genre:</label>
        <input type="text" name="genre" value="<?php echo $book['genre']; ?>" required><br><br>

        <input type="submit" value="Update Book">
    </form>
    <br>
    <a href="index.php">Back to Book List</a>
</body>
</html>