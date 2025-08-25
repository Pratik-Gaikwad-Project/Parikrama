<?php
session_start();
$conn = new mysqli("localhost", "root", "", "parikrama");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $action = $_POST["action"];

  if ($action === "register") {
    $name = $_POST["name"];
    $aadhaar = $_POST["aadhaar"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $_POST["role"];

    $check = $conn->prepare("SELECT id FROM users WHERE aadhaar = ?");
    $check->bind_param("s", $aadhaar);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
      $message = "❌ Aadhaar already registered.";
    } else {
      $stmt = $conn->prepare("INSERT INTO users (name, aadhaar, password, role) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("ssss", $name, $aadhaar, $password, $role);
      if ($stmt->execute()) {
        $message = "✅ Registration successful. You can now log in.";
      } else {
        $message = "❌ Error: " . $stmt->error;
      }
    }
  }

  if ($action === "login") {
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

      if (password_verify($password, $hashed_password)) {
        $_SESSION["user_id"] = $id;
        $_SESSION["name"] = $name;
        $_SESSION["role"] = $role;

        header("Location: " . ($role === "student" ? "Home.php" : "admin.php"));
        exit();
      } else {
        $message = "❌ Incorrect password.";
      }
    } else {
      $message = "❌ Aadhaar or role mismatch.";
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Unified Auth</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #74ebd5, #ACB6E5);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background: #fff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }
    h2 {
      margin-bottom: 20px;
      color: #333;
    }
    input, select {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
    }
    button {
      background-color: #4CAF50;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      width: 100%;
      margin-top: 10px;
    }
    button:hover {
      background-color: #45a049;
    }
    .message {
      margin-top: 15px;
      font-size: 14px;
      color: #333;
    }
    .toggle {
      margin-top: 10px;
      font-size: 14px;
      color: #007BFF;
      cursor: pointer;
    }
    .toggle:hover {
      text-decoration: underline;
    }
  </style>
  <script>
    function toggleForm(formType) {
      document.getElementById("registerForm").style.display = formType === "register" ? "block" : "none";
      document.getElementById("loginForm").style.display = formType === "login" ? "block" : "none";
    }
  </script>
</head>
<body>

<div class="container">
  <div id="registerForm" style="display: block;">
    <h2>📝 Register</h2>
    <form method="POST">
      <input type="hidden" name="action" value="register">
      <input type="text" name="name" placeholder="👤 Full Name" required>
      <input type="text" name="aadhaar" placeholder="🆔 Aadhaar Number" required>
      <input type="password" name="password" placeholder="🔒 Password" required>
      <select name="role" required>
        <option value="">🎓 Select Role</option>
        <option value="student">Student</option>
        <option value="teacher">Teacher</option>
      </select>
      <button type="submit">Register</button>
    </form>
    <div class="toggle" onclick="toggleForm('login')">Already have an account? Log in</div>
  </div>

  <div id="loginForm" style="display: none;">
    <h2>🔐 Login</h2>
    <form method="POST">
      <input type="hidden" name="action" value="login">
      <input type="text" name="aadhaar" placeholder="🆔 Aadhaar Number" required>
      <input type="password" name="password" placeholder="🔒 Password" required>
      <select name="role" required>
        <option value="">🎓 Select Role</option>
        <option value="student">Student</option>
        <option value="teacher">Teacher</option>
      </select>
      <button type="submit">Login</button>
    </form>
    <div class="toggle" onclick="toggleForm('register')">New user? Register here</div>
  </div>

  <?php if (!empty($message)) echo "<div class='message'>" . htmlspecialchars($message) . "</div>"; ?>
</div>

</body>
</html>