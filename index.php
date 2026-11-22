<?php
include 'config.php';

$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Library</title>
</head>
<body>
    <h1>Book Library</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>ISBN</th>
            <th>Year</th>
            <th>Genre</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['isbn']; ?></td>
            <td><?php echo $row['publication_year']; ?></td>
            <td><?php echo $row['genre']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>