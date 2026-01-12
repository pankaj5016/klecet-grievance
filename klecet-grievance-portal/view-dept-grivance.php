<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Department Grievances</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f7f7f7;
    }

    header {
      background-color: #003366;
      color: #fff;
      padding: 15px;
      text-align: center;
    }

    .container {
      max-width: 1000px;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }

    h2 {
      color: #003366;
      margin-top: 0;
      text-align: center;
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
    <h1>HOD Dashboard</h1>
  </header>

  <div class="container">
    <h2>Department Grievances</h2>
    <p>Below is the list of all student grievances submitted in your department.</p>

    <table>
      <thead>
        <tr>
          <th>Grievance ID</th>
          <th>Student Name</th>
          <th>Description</th>
          <th>Status</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>G101</td>
          <td>Rahul Desai</td>
          <td>Lab equipment is not working properly in Lab-3.</td>
          <td>Pending</td>
          <td>2025-06-10</td>
        </tr>
        <tr>
          <td>G102</td>
          <td>Kavya Kulkarni</td>
          <td>Request for more reference books in library.</td>
          <td>Resolved</td>
          <td>2025-06-05</td>
        </tr>
        <tr>
          <td>G103</td>
          <td>Akshay Patil</td>
          <td>Classroom projector not working.</td>
          <td>In Progress</td>
          <td>2025-06-12</td>
        </tr>
      </tbody>
    </table>
  </div>

  <footer>
    &copy; 2025 KLECET Chikodi | All Rights Reserved
  </footer>

</body>
</html>
