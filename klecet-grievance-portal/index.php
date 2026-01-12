<?php
include 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KLECET | Home</title>
  <style>
    /* Reset and base */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      scroll-behavior: smooth;
      background-color: #f8f9fa;
    }

    /* Flex column layout for sticky footer */
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* Header styles */
    header {
      background-color: #003366;
      color: #fff;
      padding: 15px 0;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    header h1 {
      margin: 0 0 10px 0;
      font-size: 1.8rem;
      text-align: center;
    }

    /* Navbar layout */
    .navbar {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
    }

    .nav-left a,
    .nav-right a {
      color: white;
      text-decoration: none;
      margin: 0 12px;
      font-weight: bold;
      padding: 8px 12px;
      border-radius: 4px;
      transition: background 0.3s;
    }

    .nav-left a:hover,
    .nav-right a:hover {
      background-color: #00509e;
    }

    /* Hamburger hidden on desktop */
    .hamburger {
      display: none;
      font-size: 28px;
      cursor: pointer;
      user-select: none;
      color: white;
      margin-left: auto;
    }

    /* Mobile menu hidden by default */
    .mobile-menu {
      display: none;
      flex-direction: column;
      background-color: #003366;
      padding: 10px 0;
      text-align: center;
    }

    .mobile-menu a {
      color: white;
      text-decoration: none;
      padding: 12px 0;
      font-weight: bold;
      border-bottom: 1px solid rgba(255,255,255,0.2);
    }

    .mobile-menu a:last-child {
      border-bottom: none;
    }

    .mobile-menu a:hover {
      background-color: #00509e;
    }

    /* Hero section */
    .hero {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  padding: 60px 20px;
  background: url('img/image.png') no-repeat center center/cover;
  position: relative;
  color: #111827; /* dark text for visibility */
}


    /* Overlay for readability */
    .hero::before {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(255, 255, 255, 0.7);
      z-index: 0;
    }

    .hero-content {
      position: relative;
      z-index: 1;
      max-width: 700px;
    }

    .hero-content h2 {
      font-size: 2.2rem;
      margin-bottom: 15px;
    }

    .hero-content p {
      font-size: 1.1rem;
      line-height: 1.6;
    }

    /* Footer */
    footer {
      background-color: #003366;
      color: white;
      text-align: center;
      padding: 15px 0;
      flex-shrink: 0;
      font-size: 14px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .nav-left,
      .nav-right {
        display: none;
      }
      .hamburger {
        display: block;
      }
      .mobile-menu.show {
        display: flex;
      }
      header h1 {
        font-size: 1.5rem;
      }
      .hero-content h2 {
        font-size: 1.7rem;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <h1>KLE College of Engineering & Technology, Chikodi</h1>
      <nav class="navbar">
        <div class="nav-left">
          <a href="#">Home</a>
          <a href="about.php">About Us</a>
          <a href="contactus.php">Contact Us</a>
        </div>
        <div class="nav-right">
          <a href="register.php">Register</a>
          <a href="login.php">Login</a>
        </div>
        <div class="hamburger" id="hamburger">&#9776;</div>
      </nav>
      <div class="mobile-menu" id="mobileMenu">
        <a href="#">Home</a>
        <a href="about.php">About Us</a>
        <a href="contactus.php">Contact Us</a>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
      </div>
    </div>
  </header>

  <section class="hero">
    <div class="hero-content" background(url)>
      <h2>Welcome to KLECET Grievance Redressal Portal</h2>
      <p>Submit your concerns easily and securely. We are here to help you in every step.</p>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 KLECET Chikodi | All Rights Reserved</p>
  </footer>

  <script>
    // Hamburger toggle script
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');

    hamburger.addEventListener('click', () => {
      mobileMenu.classList.toggle('show');
    });
  </script>
</body>
</html>
