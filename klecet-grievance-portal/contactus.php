<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Contact details for the Grievance Cell of KLE College, including Principal, Coordinators, and Department HODs.">
    <title>Grievance Cell Contact</title>
    <style>
      /* Basic Reset */
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
      }

      /* Header */
      header {
        background-color: #003366;
        color: #fff;
        padding: 20px;
        text-align: center;
      }

      header h1 {
        font-size: 2rem;
        margin-bottom: 5px;
      }

      /* Team Section */
      .contact-team {
        background-color: #f4f4f4;
        padding: 60px 20px;
        text-align: center;
        flex: 1;
      }

      .contact-team h2 {
        font-size: 2rem;
        color: #003366;
        margin-bottom: 20px;
      }

      .contact-team p.email {
        font-size: 1rem;
        margin-bottom: 40px;
        color: #333;
      }

      .contact-team p.email a {
        color: #003366;
        text-decoration: none;
      }

      .contact-team p.email a:hover {
        text-decoration: underline;
      }

      .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        max-width: 1200px;
        margin: 0 auto;
      }

      .team-member {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: all 0.3s ease;
      }

      .team-member:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
      }

      .team-member h3 {
        font-size: 1.2rem;
        color: #003366;
        margin-bottom: 5px;
      }

      .team-member p {
        font-size: 1rem;
        color: #333;
      }

      /* Footer */
      footer {
        background-color: #003366;
        color: #fff;
        text-align: center;
        padding: 15px 20px;
      }

      footer p {
        margin: 5px 0;
        font-size: 0.9rem;
      }

      footer a {
        color: #ffd700; /* gold color for links */
        text-decoration: none;
      }

      footer a:hover {
        text-decoration: underline;
      }

      /* Responsive adjustments */
      @media (max-width: 600px) {
        .contact-team {
          padding: 40px 10px;
        }
      }
    </style>
  </head>
  <body>
    <!-- Header -->
    <header>
      <h1>Grievance Cell - College Contact</h1>
    </header>

    <!-- Team Section -->
    <section class="contact-team">
      <h2>Contact for Grievance Cell</h2>
      <p class="email">
        Email: <a href="mailto:principal@klecet.edu.in">principal@klecet.edu.in</a>
      </p>

      <div class="team-grid">
        <div class="team-member">
          <h3>Prof. Darshankumar</h3>
          <p>Principal</p>
        </div>

        <div class="team-member">
          <h3>Prof. Anita Biraj</h3>
          <p>Central Department Coordinator</p>
        </div>

        <!-- 6 Department HODs -->
        <div class="team-member">
          <h3>Dr. Sanjay Ankali</h3>
          <p>HOD - Computer Science</p>
        </div>
        <div class="team-member">
          <h3>Dr. M K Mathapati</h3>
          <p>HOD - Mechanical</p>
        </div>
        <div class="team-member">
          <h3>Prof. Pradeep M Hodlur</h3>
          <p>HOD - Civil</p>
        </div>
        <div class="team-member">
          <h3>Prof. Sangeeta Wateaonkar</h3>
          <p>HOD - Electrical</p>
        </div>
        <div class="team-member">
          <h3>Dr. Sanjay Hanagandi</h3>
          <p>HOD - MBA</p>
        </div>
        <div class="team-member">
          <h3>Prof. Suneel Shinde</h3>
          <p>HOD - MCA</p>
        </div>

        <!-- 6 Department Coordinators -->
        <div class="team-member">
          <h3>Prof. Swati Halli</h3>
          <p>Coordinator - Computer Science</p>
        </div>
        <div class="team-member">
          <h3>Prof. Pooja Bhoji</h3>
          <p>Coordinator - Mechanical</p>
        </div>
        <div class="team-member">
          <h3>Prof. Vidya Angadi</h3>
          <p>Coordinator - Civil</p>
        </div>
        <div class="team-member">
          <h3>Prof. Laxmi Motage</h3>
          <p>Coordinator - Electrical</p>
        </div>
        <div class="team-member">
          <h3>Prof. Anish Panda</h3>
          <p>Coordinator - MBA</p>
        </div>
        <div class="team-member">
          <h3>Prof. Jyoti Kagalkar</h3>
          <p>Coordinator - MCA</p>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer>
      <p>&copy; 2025 College Name. All Rights Reserved.</p>
      <p>
        Contact: <a href="mailto:info@klecet.edu.in">info@klecet.edu.in</a> |
        Website: <a href="https://www.klecet.edu.in/" target="_blank">klecet.edu.in</a> |
        Phone: 08338-257100
      </p>
    </footer>
  </body>
</html>
