



<form method="POST" action="upload.php" enctype="multipart/form-data">
  <input type="text" name="title" placeholder="News Title" required>
  <textarea name="description" placeholder="Description" required></textarea>
  <input type="file" name="image" accept="image/*" required>
  <button type="submit">Add News</button>
</form>


<!-- header.php -->
<header>
  <h1>📢 Latest News & Updates</h1>
  <p>Stay informed about campus happenings, achievements, and events.</p>
  <a href="mainindex.php" class="home-button">🏠 Home</a>
</header>

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