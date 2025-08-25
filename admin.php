<?php
$conn = new mysqli("localhost", "root", "", "parikrama");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "SELECT * FROM gallery ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dynamic Gallery</title>
  <style>
    body { font-family: sans-serif; background: #f4f4f4; margin: 0; }
    .gallery-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 30px;
    }
    .gallery-item {
      background: white;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      overflow: hidden;
    }
    .gallery-item img {
      width: 100%;
      height: auto;
    }
    .caption {
      padding: 10px;
      text-align: center;
      font-weight: bold;
      color: #004080;
    }
  </style>
</head>
<body>
  <h1 style="text-align:center; padding:20px;">📸 Dynamic Gallery</h1>
  <div class="gallery-container">
    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="gallery-item">';
        echo '<img src="images/' . htmlspecialchars($row["filename"]) . '" alt="Gallery Image">';
        echo '<div class="caption">' . htmlspecialchars($row["caption"]) . '</div>';
        echo '</div>';
      }
    } else {
      echo "<p style='text-align:center;'>No images found.</p>";
    }
    ?>
  </div>
</body>
</html>