<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us | KLECET</title>
  <style>
    /* Base styles */
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
    }

    body {
      display: flex;
      flex-direction: column;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    /* Header / Navbar */
    header {
      background-color: #003366;
      color: white;
      padding: 15px 20px;
      position: sticky;
      top: 0;
      z-index: 1000;
      text-align: center;
    }

    header h1 {
      margin: 0 0 10px 0;
      font-size: 1.6rem;
    }

    .navbar {
      display: flex;
      justify-content: center; /* center the link */
      gap: 20px;
    }

    .navbar a {
      display: inline-block;
      color: white;
      padding: 8px 12px;
      font-weight: bold;
      border-radius: 4px;
      transition: background 0.3s;
    }

    .navbar a:hover {
      background-color: #00509e;
    }

    /* Main content */
    .main {
      display: flex;
      flex: 1;
      justify-content: center;
      align-items: center;
      gap: 40px;
      padding: 20px;
    }

    .box {
      flex: 1 1 40%;
      background-color: #f4f4f4;
      padding: 20px 30px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      overflow-y: auto;
      max-height: calc(100vh - 140px); /* Account for header + footer */
    }

    .box h3 {
      font-size: 1.5rem;
      color: #003366;
      margin-bottom: 20px;
      text-align: center;
    }

    .box p, .box ol {
      font-size: 1rem;
      line-height: 1.5;
    }

    ol li {
      margin-bottom: 10px;
    }

    /* Footer */
    footer {
      background-color: #003366;
      color: white;
      text-align: center;
      padding: 10px 20px;
      font-size: 14px;
    }

    /* Responsive */
    @media(max-width: 900px){
      .main {
        flex-direction: column;
        gap: 20px;
      }

      .box {
        max-height: none;
      }
    }
  </style>
</head>
<body>
  <header>
    <h1>KLE College of Engineering & Technology, Chikodi</h1>
    <nav class="navbar">
      <a href="about.html">About Us</a>
    </nav>
  </header>

  <div class="main">
    <div class="box about">
      <h3>About Us</h3>
      <p>KLE College of Engineering & Technology, Chikodi, is dedicated to providing quality education and fostering innovation. Our Grievance Redressal Portal empowers students, faculty, and staff to voice concerns easily while ensuring transparency and timely resolution in line with AICTE and UGC norms.</p>
      <p>KLECET, affiliated with VTU Belagavi, aims to develop students with academic excellence and professional values. The portal helps raise issues in a simple, secure manner, covering academics, facilities, and behavior concerns.</p>
    </div>

    <div class="box how">
      <h3>How it Works</h3>
      <ol>
        <li><strong>User logs in:</strong> Students, faculty, or staff securely log in using their credentials.</li>
        <li><strong>Fill out grievance form:</strong> Describe the issue in detail and submit online.</li>
        <li><strong>Goes to relevant department:</strong> Complaint is sent to the proper department or officer.</li>
        <li><strong>Status is updated:</strong> Track progress until resolution.</li>
        <li><strong>User gets notified:</strong> Receive notification about outcome and actions taken.</li>
      </ol>
    </div>
  </div>

  <footer>
    &copy; 2025 KLECET Chikodi | All Rights Reserved
  </footer>
</body>
</html>
