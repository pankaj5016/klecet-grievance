<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Submit Grievance - Student Dashboard</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f0f2f5;
    }

    header {
      background-color: #003366;
      color: white;
      padding: 20px;
      text-align: center;
    }

    nav {
      background-color: #0055aa;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }

    nav a {
      color: #fff;
      text-decoration: none;
      padding: 14px 20px;
      display: block;
      transition: background-color 0.3s;
    }

    nav a:hover {
      background-color: #003366;
    }

    .container {
      max-width: 600px;
      margin: 30px auto;
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    h2 {
      color: #003366;
      text-align: center;
      margin-top: 0;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-top: 15px;
      margin-bottom: 5px;
      font-weight: bold;
      color: #003366;
    }

    input[type="text"],
    textarea,
    input[type="file"] {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      width: 100%;
      box-sizing: border-box;
      resize: vertical;
    }

    textarea {
      min-height: 100px;
    }

    .buttons {
      text-align: center;
      margin-top: 20px;
    }

    button {
      padding: 10px 18px;
      margin: 0 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    .submit-btn {
      background-color: #003366;
      color: white;
    }

    .cancel-btn {
      background-color: #aaa;
      color: white;
    }

    .submit-btn:hover {
      background-color: #0055aa;
    }

    .cancel-btn:hover {
      background-color: #888;
    }

    footer {
      text-align: center;
      padding: 10px;
      background-color: #003366;
      color: white;
      font-size: 0.9rem;
      margin-top: 30px;
    }

    @media (max-width: 600px) {
      nav {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>KLECET Grievance Redressal Portal</h1>
  </header>

  <nav>
    <a href="#">Home</a>
    <a href="#">My Profile</a>
    <a href="#">Submit Grievance</a>
    <a href="#">View My Grievances</a>
    <a href="#">Change Password</a>
    <a href="#">Logout</a>
  </nav>

  <div class="container">
    <h2>Submit Grievance</h2>
    <form>
      <label for="title">Grievance Title</label>
      <input type="text" id="title" name="title" placeholder="Enter grievance title" required>

      <label for="description">Description / Details</label>
      <textarea id="description" name="description" placeholder="Describe your grievance in detail" required></textarea>

      <label for="attachment">Optional Attachment (Image/PDF)</label>
      <input type="file" id="attachment" name="attachment" accept="image/*,.pdf">

      <div class="buttons">
        <button type="submit" class="submit-btn">Submit</button>
        <button type="reset" class="cancel-btn">Cancel</button>
      </div>
    </form>
  </div>

  <footer>
    &copy; 2025 KLECET Chikodi | All Rights Reserved
  </footer>

</body>
</html>
