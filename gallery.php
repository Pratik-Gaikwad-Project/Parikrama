<?php
$conn = new mysqli("localhost", "root", "", "parikrama");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT filename, caption FROM gallery ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Parikrama College Gallery</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    header {
      background-color: #004080;
      color: white;
      padding: 20px;
      text-align: center;
      position: relative;
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

    .gallery-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 30px;
    }

    .gallery-item {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      overflow: hidden;
      transition: transform 0.3s ease;
    }

    .gallery-item:hover {
      transform: scale(1.03);
    }

    .gallery-item img {
      width: 100%;
      height: auto;
      display: block;
    }

    .caption {
      padding: 15px;
      font-weight: 600;
      color: #004080;
      text-align: center;
    }
  </style>
</head>
<body>

<header>
  <h1>📸 Parikrama College Gallery</h1>
  <p>Explore Our Campus Highlights</p>
  <a href="home.php" class="home-button">Home</a>
</header>

<section class="gallery-container">
  <?php
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<div class="gallery-item">';
      echo '<img src="images/' . htmlspecialchars($row["filename"]) . '" alt="' . htmlspecialchars($row["caption"]) . '">';
      echo '<div class="caption">' . htmlspecialchars($row["caption"]) . '</div>';
      echo '</div>';
    }
  } else {
    echo "<p style='text-align:center;'>No images found in the gallery.</p>";
  }
  ?>
</section>

</body>
</html>