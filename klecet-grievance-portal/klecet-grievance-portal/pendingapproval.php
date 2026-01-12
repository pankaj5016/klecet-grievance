<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pending Approvals | Principal Dashboard</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .table-container {
  overflow-x: auto;
  margin-top: 20px;
}

table {
  width: 100%;
  border-collapse: collapse;
  min-width: 600px;
}

table thead {
  background-color: #003366;
  color: #fff;
}

table th,
table td {
  border: 1px solid #ddd;
  padding: 12px;
  text-align: left;
}

table tr:nth-child(even) {
  background-color: #f9f9f9;
}

.approve-btn,
.reject-btn {
  padding: 6px 12px;
  font-size: 0.85rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-right: 5px;
  transition: background-color 0.3s ease;
}

.approve-btn {
  background-color: #28a745;
  color: #fff;
}

.approve-btn:hover {
  background-color: #218838;
}

.reject-btn {
  background-color: #dc3545;
  color: #fff;
}

.reject-btn:hover {
  background-color: #b21f2d;
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
      <h2>Pending Student Approvals</h2>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Student Name</th>
              <th>Department</th>
              <th>Mobile Number</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Aryan Joshi</td>
              <td>Computer Science</td>
              <td>9876543210</td>
              <td>
                <button class="approve-btn">Approve</button>
                <button class="reject-btn">Reject</button>
              </td>
            </tr>
            <tr>
              <td>Sneha Patil</td>
              <td>Electrical</td>
              <td>9765432109</td>
              <td>
                <button class="approve-btn">Approve</button>
                <button class="reject-btn">Reject</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>

  <footer>
    <p>&copy; 2025 KLECET Chikodi | All Rights Reserved</p>
  </footer>
</body>
</html>
