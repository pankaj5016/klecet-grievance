<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      .contact-team {
        background-color: #f4f4f4;
        padding: 60px 20px;
        text-align: center;
      }

      .contact-team h2 {
        font-size: 2rem;
        color: #003366;
        margin-bottom: 30px;
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
      }

      .team-member img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 15px;
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
    </style>
  </head>
  <body>
    <section class="contact-team">
      <h2>Contact for Grievance Cell</h2>
      <div class="team-grid">
        <div class="team-member">
          <img src="img/principal.jpg" alt="Principal" />
          <h3>Dr. A. B. Principal</h3>
          <p>Principal</p>
        </div>

        <div class="team-member">
          <img src="img/central-coordinator.jpg" alt="Central Coordinator" />
          <h3>Prof. C. D. Coordinator</h3>
          <p>Central Department Coordinator</p>
        </div>

        <!-- 6 Department HODs -->
        <div class="team-member">
          <img src="img/hod1.jpg" alt="HOD 1" />
          <h3>Prof. E. F. HOD</h3>
          <p>HOD - Computer Science</p>
        </div>
        <div class="team-member">
          <img src="img/hod2.jpg" alt="HOD 2" />
          <h3>Prof. G. H. HOD</h3>
          <p>HOD - Mechanical</p>
        </div>
        <div class="team-member">
          <img src="img/hod3.jpg" alt="HOD 3" />
          <h3>Prof. I. J. HOD</h3>
          <p>HOD - Civil</p>
        </div>
        <div class="team-member">
          <img src="img/hod4.jpg" alt="HOD 4" />
          <h3>Prof. K. L. HOD</h3>
          <p>HOD - Electrical</p>
        </div>
        <div class="team-member">
          <img src="img/hod5.jpg" alt="HOD 5" />
          <h3>Prof. M. N. HOD</h3>
          <p>HOD - Electronics</p>
        </div>
        <div class="team-member">
          <img src="img/hod6.jpg" alt="HOD 6" />
          <h3>Prof. O. P. HOD</h3>
          <p>HOD - Information Science</p>
        </div>

        <!-- 6 Department Coordinators -->
        <div class="team-member">
          <img src="img/coord1.jpg" alt="Coordinator 1" />
          <h3>Prof. Q. R. Coordinator</h3>
          <p>Coordinator - Computer Science</p>
        </div>
        <div class="team-member">
          <img src="img/coord2.jpg" alt="Coordinator 2" />
          <h3>Prof. S. T. Coordinator</h3>
          <p>Coordinator - Mechanical</p>
        </div>
        <div class="team-member">
          <img src="img/coord3.jpg" alt="Coordinator 3" />
          <h3>Prof. U. V. Coordinator</h3>
          <p>Coordinator - Civil</p>
        </div>
        <div class="team-member">
          <img src="img/coord4.jpg" alt="Coordinator 4" />
          <h3>Prof. W. X. Coordinator</h3>
          <p>Coordinator - Electrical</p>
        </div>
        <div class="team-member">
          <img src="img/coord5.jpg" alt="Coordinator 5" />
          <h3>Prof. Y. Z. Coordinator</h3>
          <p>Coordinator - Electronics</p>
        </div>
        <div class="team-member">
          <img src="img/coord6.jpg" alt="Coordinator 6" />
          <h3>Prof. A1. B1. Coordinator</h3>
          <p>Coordinator - Information Science</p>
        </div>
      </div>
    </section>
  </body>
</html>
