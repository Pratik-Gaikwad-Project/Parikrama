<?php
include 'db.php';
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$comments = $_POST['comments'];

// Prepare and execute query
$stmt = $conn->prepare("INSERT INTO feedback (name, comments) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $comments);

if ($stmt->execute()) {
  echo "Thank you for your feedback!";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>