<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>View My Grievances - Student Dashboard</title>
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
      max-width: 900px;
      margin: 30px auto;
      background-color: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    h2 {
      color: #003366;
      text-align: center;
      margin-top: 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: left;
      vertical-align: top;
    }

    th {
      background-color: #003366;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .status {
      padding: 5px 10px;
      border-radius: 4px;
      color: white;
      font-size: 0.9rem;
      display: inline-block;
    }

    .pending {
      background-color: #e67e22;
    }

    .inprogress {
      background-color: #f1c40f;
      color: black;
    }

    .resolved {
      background-color: #27ae60;
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

      table, thead, tbody, th, td, tr {
        display: block;
        width: 100%;
      }

      tr {
        margin-bottom: 15px;
      }

      th {
        text-align: left;
      }

      td {
        border: none;
        border-bottom: 1px solid #ddd;
        padding: 10px 0;
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
    <h2>My Submitted Grievances</h2>
    <p>Below is the list of all grievances you have submitted and their current status.</p>

    <table>
      <thead>
        <tr>
          <th>Grievance ID</th>
          <th>Title</th>
          <th>Description</th>
          <th>Status</th>
          <th>Date Submitted</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>STU101</td>
          <td>Lab Equipment Issue</td>
          <td>Lab equipment in Room 202 is not working properly.</td>
          <td><span class="status pending">Pending</span></td>
          <td>2025-06-12</td>
        </tr>
        <tr>
          <td>STU102</td>
          <td>Library Book Request</td>
          <td>Requesting new editions for Data Science books.</td>
          <td><span class="status inprogress">In Progress</span></td>
          <td>2025-06-10</td>
        </tr>
        <tr>
          <td>STU103</td>
          <td>Cleanliness Issue</td>
          <td>Classroom needs regular cleaning schedule.</td>
          <td><span class="status resolved">Resolved</span></td>
          <td>2025-06-05</td>
        </tr>
      </tbody>
    </table>
  </div>

  <footer>
    &copy; 2025 KLECET Chikodi | All Rights Reserved
  </footer>

</body>
</html>
