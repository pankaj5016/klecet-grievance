<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Employee | Principal Dashboard</title>
    <link rel="stylesheet" href="style.css" />
    <style>
      .form-container {
        background-color: #fff;
        padding: 40px 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        width: 100%;
        margin: auto;
        text-align: center;
      }

      .form-container h2 {
        margin-bottom: 20px;
        color: #003366;
      }

      .form-container form {
        display: flex;
        flex-direction: column;
        gap: 15px;
      }

      .form-container input,
      .form-container select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
      }

      .password-wrapper {
        position: relative;
      }

      .password-wrapper input {
        width: 100%;
        padding-right: 40px;
      }

      .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 1.2rem;
        color: #666;
        user-select: none;
      }

      .toggle-password:hover {
        color: #003366;
      }

      .button-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
      }

      .button-group button {
        flex: 1 1 45%;
        padding: 10px 12px;
        font-size: 1rem;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }

      .submit-btn {
        background-color: #003366;
        color: #fff;
      }

      .submit-btn:hover {
        background-color: #002244;
      }

      .cancel-btn {
        background-color: #ccc;
        color: #333;
      }

      .cancel-btn:hover {
        background-color: #999;
      }
    </style>
  </head>
  <body>
    <header class="header">
      <h1>KLECET Grievance Portal - Principal Dashboard</h1>
    </header>

    <div class="dashboard">
      <nav class="sidebar">
        <ul>
          <li><a href="principal-dashboard.html">🏠 Home</a></li>
          
        </ul>
      </nav>

      <main class="content">
        <div class="form-container">
          <h2>Create New Employee</h2>
          <form action="#" method="post">
            <label for="name">Full Name</label>
            <input
              type="text"
              id="name"
              name="name"
              placeholder="Enter full name"
              required
            />

            <label for="mobile">Mobile Number</label>
            <input
              type="tel"
              id="mobile"
              name="mobile"
              placeholder="Enter mobile number"
              required
            />

            <!-- Designation / Role Dropdown -->
            <label for="role">Designation / Role</label>
            <select id="role" name="role" required>
              <option value="" disabled selected>Select role</option>
              <option>Grievance Central Coordinator</option>
              <option>Department HOD</option>
              <option>Grievance Department Coordinator</option>
              <option>Teaching Staff</option>
            </select>

            <!-- Department Dropdown -->
            <label for="department">Department</label>
            <select id="department" name="department">
              <option value="" selected>None / Central</option>
              <option>Computer Science</option>
              <option>Mechanical</option>
              <option>Civil</option>
              <option>Electronics</option>
              <option>MBA</option>
              <option>MCA</option>
            
            </select>

            <label for="password">Password</label>
            <div class="password-wrapper">
              <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter password"
                required
              />
              <span
                class="toggle-password"
                onclick="togglePassword('password', this)"
                >👁️</span
              >
            </div>

            <label for="confirmPassword">Confirm Password</label>
            <div class="password-wrapper">
              <input
                type="password"
                id="confirmPassword"
                name="confirmPassword"
                placeholder="Confirm password"
                required
              />
              <span
                class="toggle-password"
                onclick="togglePassword('confirmPassword', this)"
                >👁️</span
              >
            </div>

            <div class="button-group">
              <button type="submit" class="submit-btn">Submit</button>
              <button
                type="button"
                class="cancel-btn"
                onclick="window.location.href='principal-dashboard.html'"
              >
                Cancel
              </button>
            </div>
          </form>
        </div>
      </main>
    </div>

    <footer>
      <p>&copy; 2025 KLECET Chikodi | All Rights Reserved</p>
    </footer>

    <script>
      function togglePassword(fieldId, icon) {
        const input = document.getElementById(fieldId);
        if (input.type === "password") {
          input.type = "text";
          icon.textContent = "🙈";
        } else {
          input.type = "password";
          icon.textContent = "👁️";
        }
      }
    </script>
  </body>
</html>
