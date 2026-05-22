<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  if ($username === 'Anish Thakur' && $password === 'bjp123') {
    $_SESSION['admin'] = true;
    header('Location: admin.php');
    exit();
  } else {
    $error = 'Invalid username or password!';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - BB College</title>
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    body {
      background: #0A0A0A;
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background: #161616;
      border: 1px solid rgba(139, 0, 0, 0.4);
      border-radius: 20px;
      padding: 50px 40px;
      width: 100%;
      max-width: 420px;
      text-align: center;
      box-shadow: 0 20px 60px rgba(139, 0, 0, 0.15);
    }

    .login-logo {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      border: 3px solid #880000;
      margin-bottom: 20px;
    }

    h2 {
      color: white;
      font-size: 1.8rem;
      margin-bottom: 5px;
    }

    .subtitle {
      color: #888;
      font-size: 0.9rem;
      margin-bottom: 30px;
    }

    .input-group {
      margin-bottom: 20px;
      text-align: left;
    }

    .input-group label {
      color: #aaa;
      font-size: 0.85rem;
      display: block;
      margin-bottom: 8px;
    }

    .input-group input {
      width: 100%;
      padding: 14px 16px;
      background: #1a1a2e;
      border: 1px solid #880000;
      border-radius: 8px;
      color: white;
      font-size: 1rem;
      font-family: 'Poppins', sans-serif;
      outline: none;
      transition: border-color 0.3s;
    }

    .input-group input:focus {
      border-color: #cc0000;
      box-shadow: 0 0 10px rgba(139,0,0,0.3);
    }

    .error-msg {
      background: rgba(139, 0, 0, 0.2);
      border: 1px solid #880000;
      color: #ff6666;
      padding: 10px 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 0.9rem;
    }

    .login-btn {
      width: 100%;
      padding: 14px;
      background: #880000;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      font-family: 'Poppins', sans-serif;
      transition: all 0.3s ease;
    }

    .login-btn:hover {
      background: #aa0000;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(139,0,0,0.4);
    }

    .back-link {
      display: block;
      margin-top: 20px;
      color: #888;
      font-size: 0.85rem;
      text-decoration: none;
      transition: color 0.3s;
    }

    .back-link:hover {
      color: #cc0000;
    }

    .badge {
      display: inline-block;
      background: rgba(139,0,0,0.2);
      border: 1px solid rgba(139,0,0,0.4);
      color: #cc0000;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.75rem;
      margin-bottom: 25px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <img src="Images/logo.JPG" alt="BB College" class="login-logo">
    <h2>Admin Login</h2>
    <p class="subtitle">Banwarilal Bhalotia College</p>
    <span class="badge">🔒 Secure Admin Access</span>

    <?php if ($error): ?>
      <div class="error-msg">❌ <?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter username" required>
      </div>
      <div class="input-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password" required>
      </div>
      <button type="submit" class="login-btn">Login to Admin Panel</button>
    </form>
    <a href="index.html" class="back-link">← Back to Website</a>
  </div>
</body>
</html>