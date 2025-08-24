



<form method="POST" action="upload.php" enctype="multipart/form-data">
  <input type="text" name="title" placeholder="News Title" required>
  <textarea name="description" placeholder="Description" required></textarea>
  <input type="file" name="image" accept="image/*" required>
  <button type="submit">Add News</button>
</form>