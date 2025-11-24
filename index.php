<?php
session_start();
require 'config/db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['fullname'] = $user['fullname'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>BMS Login</title>
<link href="https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap" rel="stylesheet">
<style>
body {
  margin:0;
  font-family:Poppins;
  background: linear-gradient(135deg,#4c4cff,#7a7aff);
  display:flex;
  justify-content:center;
  align-items:center;
  height:100vh;
}
.card {
  width:900px;
  height:520px;
  display:flex;
  border-radius:16px;
  overflow:hidden;
  background:white;
  box-shadow:0 20px 40px rgba(0,0,0,0.3);
}
.left {
  width:50%;
  background:url("https://images.unsplash.com/photo-1551434678-e076c223a692?w=1000") center/cover;
}
.right {
  width:50%;
  padding:60px;
}
input {
  width:100%;
  padding:15px;
  margin:15px 0;
  border-radius:8px;
  border:1px solid #ccc;
  font-size:15px;
}
button {
  width:100%;
  padding:15px;
  background:#4c4cff;
  border:none;
  color:white;
  font-weight:bold;
  border-radius:8px;
  cursor:pointer;
}
button:hover { background:#0000cc; }
.error {color:red;margin-top:10px;}
</style>
</head>
<body>

<div class="card">
  <div class="left"></div>
  <div class="right">
    <h2>Welcome Back Buddy 👋</h2>
    <p>Login to Business Management System</p>

    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>

    <?php if($error): ?>
    <div class="error"><?= $error ?></div>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
