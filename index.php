<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Parikrama College of Engineering</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <header>
    <div class="logo-box">
      <img src="images/symbol.jpg" alt="College Logo" class="logo">
    </div>

    <div class="title-text">
      <h1>Parikrama College of Engineering</h1>
      <p>Empowering Minds, Shaping Futures</p>
    </div>
  </header>

  <nav>
  <ul class="navbar">
    <li>
      <a href="#">Home</a>
      <ul class="dropdown">
        <li><a href="#">Welcome</a></li>
        <li><a href="campus.php">Campus Tour</a></li>
        <li><a href="News.php">News</a></li>
        <li><a href="#">Events</a></li>
        <li><a href="#">Gallery</a></li>
      </ul>
    </li>
    <li>
      <a href="#">About</a>
      <ul class="dropdown">
        <li><a href="#">Vision & Mission</a></li>
        <li><a href="#">Principal's Message</a></li>
        <li><a href="#">History</a></li>
        <li><a href="#">Accreditation</a></li>
        <li><a href="#">Achievements</a></li>
      </ul>
    </li>
    <li>
      <a href="#">Departments</a>
      <ul class="dropdown">
        <li><a href="#">Computer Engineering</a></li>
        <li><a href="#">Mechanical Engineering</a></li>
        <li><a href="#">Civil Engineering</a></li>
        <li><a href="#">Electronics</a></li>
        <li><a href="#">AI & ML</a></li>
      </ul>
    </li>
    <li>
      <a href="#">Admissions</a>
      <ul class="dropdown">
        <li><a href="#">Eligibility</a></li>
        <li><a href="#">How to Apply</a></li>
        <li><a href="#">Fee Structure</a></li>
        <li><a href="#">Scholarships</a></li>
        <li><a href="#">Important Dates</a></li>
      </ul>
    </li>
    <li>
      <a href="#">Contact</a>
      <ul class="dropdown">
        <li><a href="#">Phone</a></li>
        <li><a href="#">Email</a></li>
        <li><a href="#">Location</a></li>
        <li><a href="#">Social Media</a></li>
        <li><a href="#">Feedback</a></li>
      </ul>
    </li>
  </ul>
</nav>
<!-- Card view -->
  <div class="hero">
    Welcome to Our Campus
  </div>
  <div class="card-container">
  <div class="card">
    <h2>Cybersecurity</h2>
    <ul>
      <li>Ethical Hacking</li>
      <li>Bug Bounty</li>
      <li>Network Scanning</li>
    </ul>
  </div>
  <div class="card">
    <h2>Web Development</h2>
    <ul>
      <li>PHP & Python</li>
      <li>Responsive Design</li>
      <li>Secure Backend</li>
    </ul>
  </div>
  <div class="card">
    <h2>Documentation</h2>
    <ul>
      <li>Bug Reports</li>
      <li>Multilingual Support</li>
      <li>Portfolio Writing</li>
    </ul>
  </div>
  <div class="card">
    <h2>Tools & Labs</h2>
    <ul>
      <li>Nmap, Nikto, Wapiti</li>
      <li>Burp Suite</li>
      <li>OWASP ZAP</li>
    </ul>
  </div>
  <div class="card">
    <h2>Machine Learning Basics</h2>
    <ul>
      <li>Nmap, Nikto, Wapiti</li>
      <li>Burp Suite</li>
      <li>OWASP ZAP</li>
    </ul>
  </div>
  <div class="card">
    <h2>Data Analysis</h2>
    <ul>
      <li>Nmap, Nikto, Wapiti</li>
      <li>Burp Suite</li>
      <li>OWASP ZAP</li>
    </ul>
  </div>
</div>
<hr>
  <div class="content">
    <h2>Latest News & Events</h2>
  <?php
        
             include 'db.php';
                  $sql = "SELECT title, description, event_date FROM events ORDER BY event_date ASC";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    echo '<div class="event-container">';
                    while ($row = $result->fetch_assoc()) {
                      echo '<div class="event-card">';
                      echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                      echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                      echo '<span class="event-date">📅 ' . date("F j, Y", strtotime($row['event_date'])) . '</span>';
                      echo '</div>';
                    }
                    echo '</div>';
                  } else {
                    echo "No upcoming events.";
                  }
                  $conn->close();
           ?>

      <div class="event-container">
        <?php foreach ($events as $event): ?>
          <div class="event-card">
            <h3><?= htmlspecialchars($event['title']) ?></h3>
            <p><?= htmlspecialchars($event['description']) ?></p>
            <span class="event-date">📅 <?= date("F j, Y", strtotime($event['date'])) ?></span>
          </div>
        <?php endforeach; ?>
      </div>

  </div>

  <footer>
    &copy; 2025 Parikrama College of Engineering | Designed by Pratik
  </footer>

</body>
</html>