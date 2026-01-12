<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Department Students</title>
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
      max-width: 900px;
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
    }
  </style>
</head>
<body>

  <header>
    <h1>HOD Dashboard</h1>
  </header>

  <div class="container">
    <h2>Department Students</h2>
    <p>Below is the list of approved students in your department.</p>

    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Mobile Number</th>
          <th>Department</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Rahul Desai</td>
          <td>9876543210</td>
          <td>Computer Science</td>
          <td>Approved</td>
        </tr>
        <tr>
          <td>Kavya Kulkarni</td>
          <td>9765432109</td>
          <td>Computer Science</td>
          <td>Approved</td>
        </tr>
      </tbody>
    </table>
  </div>

  <footer>
    &copy; 2025 KLECET Chikodi | All Rights Reserved
  </footer>

</body>
</html>
