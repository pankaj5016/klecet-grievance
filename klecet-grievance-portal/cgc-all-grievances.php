<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>All Department Grievances - CGC Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f7f7f7;
    }

    header {
      background-color: #003366;
      color: #fff;
      padding: 20px;
      text-align: center;
    }

    .container {
      max-width: 1000px;
      margin: 20px auto;
      background-color: #fff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }

    h2 {
      color: #003366;
      margin-top: 0;
      text-align: center;
    }

    p {
      text-align: center;
      color: #555;
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
      color: #fff;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    footer {
      text-align: center;
      padding: 10px;
      background-color: #003366;
      color: #fff;
      font-size: 0.9rem;
      margin-top: 20px;
    }

    @media (max-width: 600px) {
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
    <h1>Central Grievance Coordinator Dashboard</h1>
  </header>

  <div class="container">
    <h2>All Department Grievances</h2>
    <p>Below is the list of all student grievances across all departments.</p>

    <table>
      <thead>
        <tr>
          <th>Grievance ID</th>
          <th>Student Name</th>
          <th>Department</th>
          <th>Description</th>
          <th>Status</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>G101</td>
          <td>Rahul Desai</td>
          <td>Computer Science</td>
          <td>Lab equipment is not working in Lab-3.</td>
          <td>Pending</td>
          <td>2025-06-10</td>
        </tr>
        <tr>
          <td>G102</td>
          <td>Kavya Kulkarni</td>
          <td>Mechanical</td>
          <td>Request for more reference books in library.</td>
          <td>Resolved</td>
          <td>2025-06-05</td>
        </tr>
        <tr>
          <td>G103</td>
          <td>Akshay Patil</td>
          <td>Electronics</td>
          <td>Classroom projector not working.</td>
          <td>In Progress</td>
          <td>2025-06-12</td>
        </tr>
        <tr>
          <td>G104</td>
          <td>Sneha Patil</td>
          <td>MBA</td>
          <td>Wi-Fi issues in hostel.</td>
          <td>Pending</td>
          <td>2025-06-11</td>
        </tr>
      </tbody>
    </table>
  </div>

  <footer>
    &copy; 2025 KLECET Chikodi | All Rights Reserved
  </footer>

</body>
</html>
