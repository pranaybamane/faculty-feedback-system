<?php
include 'db_connect.php'; // Ensure you have a database connection file

// Create or update the professor_rankings table
$sql_create = "CREATE TABLE IF NOT EXISTS professor_rankings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    professor_name VARCHAR(255) NOT NULL,
    score FLOAT NOT NULL
)";
$conn->query($sql_create);

// Fetch rankings from the table
$sql = "SELECT * FROM professor_rankings ORDER BY score DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Rankings</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Professor Rankings</h2>
    <table border="1">
        <tr>
            <th>Rank</th>
            <th>Professor Name</th>
            <th>Score</th>
        </tr>
        <?php 
        $rank = 1;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$rank}</td><td>{$row['professor_name']}</td><td>{$row['score']}</td></tr>";
                $rank++;
            }
        } else {
            echo "<tr><td colspan='3'>No rankings available</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
