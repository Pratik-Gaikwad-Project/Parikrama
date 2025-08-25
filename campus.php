<?php
// Handle form submission
$thankYou = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $host = "localhost";
  $user = "root";
  $password = "";
  $dbname = "parikrama";

  $conn = new mysqli($host, $user, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $name = $_POST['name'];
  $comments = $_POST['comments'];

  $stmt = $conn->prepare("INSERT INTO feedback (name, comments) VALUES (?, ?)");
  $stmt->bind_param("ss", $name, $comments);

  if ($stmt->execute()) {
    $thankYou = "✅ Thank you for your feedback!";
  } else {
    $thankYou = "❌ Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Parikrama College Campus Tour</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Baloo+Bhai+2&display=swap" rel="stylesheet">
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

    .gallery {
      text-align: center;
      padding: 30px;
    }

    .gallery img {
      max-width: 90%;
      height: auto;
      border-radius: 10px;
    }

    #infoBox {
      margin-top: 10px;
      font-weight: 600;
    }

    .feedback {
      background-color: #fff;
      padding: 30px;
      margin: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .feedback h2 {
      text-align: center;
      color: #004080;
    }

    form label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    form input, form textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    form button {
      margin-top: 15px;
      padding: 10px 20px;
      background-color: #004080;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    form button:hover {
      background-color: #003060;
    }

    #thankYouMessage {
      margin-top: 15px;
      color: green;
      font-weight: bold;
      text-align: center;
    }
    .next-button {
      background-color: #008080; /* Teal base */
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .next-button:hover {
      background-color: #00aaff; /* Light blue on hover */
      transform: scale(1.05); /* Slight zoom effect */
    }
  </style>
</head>
<body>

<header>
  <h1>📢 Parikrama College Campus Tour</h1>
  <p>Empowering Minds, Shaping Futures</p>
  <a href="home.php" class="home-button">🎓 Home</a>
</header>

<main class="gallery">
  <img id="campusImage" src="images/campus.jpg" alt="Campus View" />
  <div id="infoBox">Main Building: Administrative offices and classrooms.</div>
  <button class="next-button" onclick="nextImage()">Next Spot</button>
</main>

<hr>

<section class="feedback">
  <h2>We value your feedback!</h2>
  <form method="POST" action="">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required />

    <label for="comments">Comments:</label>
    <textarea id="comments" name="comments" rows="4" required></textarea>

    <button type="submit">Submit</button>
  </form>
  <?php if (!empty($thankYou)) echo "<div id='thankYouMessage'>" . htmlspecialchars($thankYou) . "</div>"; ?>
</section>

<script>
const images = [
  { src: "images/campus.jpg", info: "Main Building: Administrative offices and classrooms." },
  { src: "images/library.jpeg", info: "Library: Over 10,000 books and digital resources." },
  { src: "images/lab.jpeg", info: "Computer Lab: Equipped with modern systems and internet." },
  { src: "images/mess.jpeg", info: "Mess: Hygiene & Quality, Unlimited Quantity, Guest Access facilities, Meal Schedule." },
  { src: "images/porch.jpg", info: "Corridor: Clean corridor areas." },
  { src: "images/sports.jpg", info: "Sports Ground: Football, cricket, and athletics facilities." },
  { src: "images/innovation.jpg", info: "Innovation Center: Student projects and incubation." },
  { src: "images/symbol.jpg", info: "Symbol of College: Our identity and pride." },
  { src: "images/gul.jpg", info: "Gul Area: Peaceful garden with seating and shade." }
];

let currentIndex = 0;

function nextImage() {
  currentIndex = (currentIndex + 1) % images.length;
  document.getElementById("campusImage").src = images[currentIndex].src;
  document.getElementById("campusImage").alt = images[currentIndex].info;
  document.getElementById("infoBox").innerText = images[currentIndex].info;
}
</script>

</body>
</html>