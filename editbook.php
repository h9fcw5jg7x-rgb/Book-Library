<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header("Location: login.php");
    exit;
}

if(!isset($_GET['isbn'])){
    header("Location: index.php");
    exit;
}

include 'config.php';
$isbn = $_GET['isbn'];

$stmt = $conn->prepare("SELECT * FROM books WHERE isbn = ?");
$stmt->bind_param("s", $isbn);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];

    $updateStmt = $conn->prepare("UPDATE books SET title=?, author=?, year=?, genre=? WHERE isbn=?");
    $updateStmt->bind_param("ssiss", $title, $author, $year, $genre, $isbn);
    $updateStmt->execute();
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Book</h1>
    <form method="POST">
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>

        <label>Author:</label>
        <input type="text" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>

        <label>Year:</label>
        <input type="number" name="year" value="<?php echo htmlspecialchars($book['year']); ?>" required>

        <label>Genre:</label>
        <input type="text" name="genre" value="<?php echo htmlspecialchars($book['genre']); ?>" required>

        <button type="submit">Save Changes</button>
    </form>
    <br>
    <a href="index.php">Back to Book Library</a>
</body>
</html>