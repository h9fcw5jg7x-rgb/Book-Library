<?php
include 'db.php';

$search = "";
if(isset($_GET['search'])){
    $search = $_GET['search'];
    $stmt = $conn->prepare("SELECT * FROM books WHERE title LIKE ? OR author LIKE ?");
    $likeSearch = "%$search%";
    $stmt->bind_param("ss", $likeSearch, $likeSearch);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM books");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Library</title>
</head>
<body>
    <h1>Book Library</h1>

    <form method="GET">
        <input type="text" name="search" placeholder="Search book title or author" value="<?php echo $search; ?>">
        <input type="submit" value="Search">
        <a href="index.php">Show All</a>
    </form>

    <br>
    <a href="addbook.php">Add New Book</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>ISBN</th>
            <th>Year</th>
            <th>Genre</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['isbn']; ?></td>
            <td><?php echo $row['year']; ?></td>
            <td><?php echo $row['genre']; ?></td>
            <td>
                <a href="editbook.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="deletebook.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>