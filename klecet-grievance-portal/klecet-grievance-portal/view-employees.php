<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>View Employees | Principal Dashboard</title>
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

.update-btn,
.delete-btn {
  padding: 6px 12px;
  font-size: 0.9rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-right: 5px;
  transition: background-color 0.3s ease;
}

.update-btn {
  background-color: #0066cc;
  color: #fff;
}

.update-btn:hover {
  background-color: #004999;
}

.delete-btn {
  background-color: #cc0000;
  color: #fff;
}

.delete-btn:hover {
  background-color: #990000;
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
      <h2>View Employees</h2>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Employee Name</th>
              <th>Designation / Role</th>
              <th>Department</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Dr. Smith</td>
              <td>Grievance Central Coordinator</td>
              <td>None / Central</td>
              <td>
                <button class="update-btn">Update</button>
                <button class="delete-btn">Delete</button>
              </td>
            </tr>
            <tr>
              <td>Prof. Johnson</td>
              <td>Department HOD</td>
              <td>Computer Science</td>
              <td>
                <button class="update-btn">Update</button>
                <button class="delete-btn">Delete</button>
              </td>
            </tr>
            <tr>
              <td>Ms. Lee</td>
              <td>Grievance Department Coordinator</td>
              <td>Mechanical</td>
              <td>
                <button class="update-btn">Update</button>
                <button class="delete-btn">Delete</button>
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
