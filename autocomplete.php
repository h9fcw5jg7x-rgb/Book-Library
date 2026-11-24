<?php include 'config.php';
$q = $_GET['q'];
$stmt = $conn->prepare("SELECT DISTINCT title FROM books WHERE title LIKE ? LIMIT 6");
$searchTerm = "%$q%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()){
    echo "<div onclick='selectSuggestion(\"".htmlspecialchars($row['title'])."\")'>".htmlspecialchars($row['title'])."</div>";
}
?>