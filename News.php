<?php
include 'db.php';
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
  <style>
    header {
  position: relative;
  background-color: #004080;
  color: white;
  padding: 20px;
  text-align: center;
}

.home-button {
  position: absolute;
  top: 20px;
  right: 20px;
  background-color: #ffcc00;
  color: #004080;
  padding: 10px 15px;
  text-decoration: none;
  border-radius: 5px;
  font-weight: bold;
  transition: background-color 0.3s ease;
}

.home-button:hover {
  background-color: #e6b800;
}
  </style>
</head>
<body>
  <header>
  <h1>📢 Latest News & Updates</h1>
  <p>Stay informed about campus happenings, achievements, and events.</p>
  <a href="index.php" class="home-button">🎓 HOME</a>
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