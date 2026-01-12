<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>All Department Grievances | Principal Dashboard</title>
  <link rel="stylesheet" href="style.css" />

  <style>
    .status {
  padding: 4px 8px;
  border-radius: 4px;
  font-weight: bold;
  font-size: 0.9rem;
}

.status.pending {
  background-color: #ffcc00;
  color: #000;
}

.status.in-progress {
  background-color: #17a2b8;
  color: #fff;
}

.status.resolved {
  background-color: #28a745;
  color: #fff;
}

.view-btn,
.update-btn,
.delete-btn {
  padding: 6px 10px;
  font-size: 0.85rem;
  border: none;
  border-radius: 4px;
  margin-right: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.view-btn {
  background-color: #6c757d;
  color: #fff;
}

.view-btn:hover {
  background-color: #5a6268;
}

.update-btn {
  background-color: #ffc107;
  color: black;
}

.update-btn:hover {
  background-color: #e0a800;
}

.delete-btn {
  background-color: #dc3545;
  color: white;
}

.delete-btn:hover {
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
      <h2>All Department Grievances</h2>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Student Name</th>
              <th>Department</th>
              <th>Title</th>
              <th>Description</th>
              <th>Status</th>
              <th>Date Submitted</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Aryan Joshi</td>
              <td>Computer Science</td>
              <td>Internet Issues</td>
              <td>Wi-Fi not working in lab.</td>
              <td><span class="status pending">Pending</span></td>
              <td>2025-06-12</td>
              <td>
                <button class="view-btn">View</button>
                <button class="update-btn">Update</button>
                <button class="delete-btn">Delete</button>
              </td>
            </tr>
            <tr>
              <td>Sneha Patil</td>
              <td>Electrical</td>
              <td>Equipment Issue</td>
              <td>Lab equipment damaged.</td>
              <td><span class="status in-progress">In Progress</span></td>
              <td>2025-06-10</td>
              <td>
                <button class="view-btn">View</button>
                <button class="update-btn">Update</button>
                <button class="delete-btn">Delete</button>
              </td>
            </tr>
            <tr>
              <td>Rahul Kumar</td>
              <td>Mechanical</td>
              <td>Classroom Maintenance</td>
              <td>Broken chairs in class.</td>
              <td><span class="status resolved">Resolved</span></td>
              <td>2025-06-08</td>
              <td>
                <button class="view-btn">View</button>
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
