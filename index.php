<?php
session_start();
$conn = new mysqli("localhost", "root", "", "parikrama");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $aadhaar = $_POST["aadhaar"];
  $password = $_POST["password"];
  $role = $_POST["role"];

  $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE aadhaar = ? AND role = ?");
  $stmt->bind_param("ss", $aadhaar, $role);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows === 1) {
    $stmt->bind_result($id, $name, $hashed_password);
    $stmt->fetch();

    // Check password
    if (password_verify($password, $hashed_password)) {
      $_SESSION["user_id"] = $id;
      $_SESSION["name"] = $name;
      $_SESSION["role"] = $role;

      if ($role === "student") {
        header("Location: Home.php");
        exit();
      } else {
        header("Location: admin.php");
        exit();
      }
    } else {
      $error = "❌ Incorrect password.";
    }
  } else {
    $error = "❌ Aadhaar or role mismatch.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Unified Login</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<form method="POST">
  <h2>🔐 Login</h2>
  <input type="text" name="aadhaar" placeholder="Aadhaar Number" required>
  <input type="password" name="password" placeholder="Password" required>
  <select name="role" required>
    <option value="">Select Role</option>
    <option value="student">Student</option>
    <option value="teacher">Teacher</option>
  </select>
  <br>
  <button type="submit">Login</button>
  <?php if (isset($error)) echo "<p>$error</p>"; ?>
  <p><a href="Registration.php">Register here</a></p>
</form>
</body>
</html>
