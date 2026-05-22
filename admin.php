<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

$conn = mysqli_connect("localhost", "root", "", "bbcollege", 3307);
$result = mysqli_query($conn, "SELECT * FROM inquiries ORDER BY submitted_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - BB College</title>
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Poppins', sans-serif;
      background: #0A0A0A;
      color: white;
      padding: 30px;
    }

    .admin-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 2px solid #880000;
    }

    .admin-header h1 {
      color: #880000;
      font-size: 1.8rem;
    }

    .admin-header p {
      color: #888;
      font-size: 0.9rem;
      margin-top: 5px;
    }

    .logout-btn {
      background: #880000;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-family: 'Poppins', sans-serif;
      font-size: 0.9rem;
      text-decoration: none;
      transition: all 0.3s;
    }

    .logout-btn:hover {
      background: #aa0000;
      transform: translateY(-2px);
    }

    .stats-row {
      display: flex;
      gap: 20px;
      margin-bottom: 30px;
    }

    .stat-card {
      background: #161616;
      border: 1px solid rgba(139,0,0,0.4);
      border-radius: 12px;
      padding: 20px 30px;
      text-align: center;
    }

    .stat-card h3 {
      font-size: 2rem;
      color: #cc0000;
    }

    .stat-card p {
      color: #888;
      font-size: 0.85rem;
      margin-top: 5px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #111;
      border-radius: 12px;
      overflow: hidden;
    }

    th {
      background: #880000;
      padding: 15px;
      text-align: left;
      font-size: 0.9rem;
      letter-spacing: 0.05em;
    }

    td {
      padding: 15px;
      border-bottom: 1px solid #222;
      font-size: 0.9rem;
      color: #ddd;
    }

    tr:hover td {
      background: #1a1a1a;
    }

    tr:last-child td {
      border-bottom: none;
    }

    .no-data {
      text-align: center;
      padding: 40px;
      color: #555;
    }

    .back-btn {
      display: inline-block;
      margin-bottom: 20px;
      color: #888;
      text-decoration: none;
      font-size: 0.9rem;
      transition: color 0.3s;
    }

    .back-btn:hover {
      color: #cc0000;
    }

    .badge {
      background: rgba(139,0,0,0.2);
      border: 1px solid rgba(139,0,0,0.4);
      color: #cc0000;
      padding: 3px 10px;
      border-radius: 20px;
      font-size: 0.75rem;
    }
  </style>
</head>
<body>

  <div class="admin-header">
    <div>
      <h1>🏫 BB College — Admin Panel</h1>
      <p>Manage all contact form submissions</p>
    </div>
    <a href="logout.php" class="logout-btn">🚪 Logout</a>
  </div>

  <a href="index.html" class="back-btn">← Back to Website</a>

  <?php
  $countResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM inquiries");
  $countRow = mysqli_fetch_assoc($countResult);
  $total = $countRow['total'];

  $todayResult = mysqli_query($conn, "SELECT COUNT(*) as today FROM inquiries WHERE DATE(submitted_at) = CURDATE()");
  $todayRow = mysqli_fetch_assoc($todayResult);
  $today = $todayRow['today'];
  ?>

  <div class="stats-row">
    <div class="stat-card">
      <h3><?= $total ?></h3>
      <p>Total Inquiries</p>
    </div>
    <div class="stat-card">
      <h3><?= $today ?></h3>
      <p>Today's Inquiries</p>
    </div>
    <div class="stat-card">
      <h3>🟢</h3>
      <p>System Online</p>
    </div>
  </div>

  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Message</th>
      <th>Date & Time</th>
      <th>Status</th>
    </tr>
    <td>
  <a href="delete.php?id=<?= $row['id'] ?>" 
     onclick="return confirm('Delete this inquiry?')"
     style="color:#cc0000;">🗑️ Delete</a>
</td>

    <?php
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
      <td><span class="badge">#<?= $row['id'] ?></span></td>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= htmlspecialchars($row['email']) ?></td>
      <td><?= htmlspecialchars($row['message']) ?></td>
      <td><?= $row['submitted_at'] ?></td>
      <td><span class="badge">✅ Received</span></td>
    </tr>
    <?php
      }
    } else {
      echo '<tr><td colspan="6" class="no-data">No inquiries yet.</td></tr>';
    }
    ?>
  </table>

</body>
</html>