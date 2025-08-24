<?php
include 'db.php';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch news items
$sql = "SELECT title, description, image FROM news ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>College News</title>
  <link rel="stylesheet" href="CSS/news.css">
</head>
<body>
  <header>
    <h1>📢 Latest News & Updates</h1>
    <p>Stay informed about campus happenings, achievements, and events.</p>
  </header>

  <main class="news-container">
    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <article class="news-item">
          <img src="images/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
          <div class="news-content">
            <h2><?= htmlspecialchars($row['title']) ?></h2>
            <p><?= htmlspecialchars($row['description']) ?></p>
          </div>
        </article>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No news available at the moment.</p>
    <?php endif; ?>
  </main>
</body>
</html>

<?php $conn->close(); ?>