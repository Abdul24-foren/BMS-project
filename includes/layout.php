<?php if (!isset($_SESSION['user_id'])) header("Location: ../index.php"); ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>BMS-Pro</title>
<style>
body{
  margin:0;
  font-family:Poppins,Arial;
  background:#020617;
  color:#e5ecff;
}
.topbar{
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:16px 30px;
  background:#071826;
}
.brand{font-weight:700;font-size:20px}
.logout{
  background:#2563eb;
  padding:8px 14px;
  border-radius:6px;
  color:white;
  text-decoration:none;
}

.layout{display:flex}
.sidebar{
  width:220px;
  background:#071223;
  padding:15px;
  min-height:100vh;
}
.sidebar a{
  display:block;
  color:#9fb8d9;
  text-decoration:none;
  padding:10px;
  margin-bottom:6px;
  border-radius:6px;
}
.sidebar a:hover,.sidebar .active{background:#0f172a;color:white}

.content{
  flex:1;
  padding:25px;
}

.card{
  background:#0f172a;
  padding:18px;
  border-radius:12px;
  margin-bottom:20px;
}

.btn{
  background:#2563eb;
  padding:8px 14px;
  border-radius:6px;
  color:white;
  text-decoration:none;
  border:none;
  cursor:pointer;
}

table{
  width:100%;
  border-collapse:collapse;
  margin-top:12px;
}
th,td{
  padding:14px;
  border-bottom:1px solid #1e293b;
}
th{color:#38bdf8;}
.delete{
  color:#f87171;
  text-decoration:none;
}
input,textarea,select{
  width:100%;
  padding:10px;
  margin:6px 0 12px;
  border-radius:6px;
  border:none;
  background:#1e293b;
  color:white;
}
</style>
</head>

<body>
<div class="topbar">
  <div class="brand">💼 BMS-Pro</div>
  <div>Hi <?= $_SESSION['username'] ?> | <a class="logout" href="../logout.php">Logout</a></div>
</div>

<div class="layout">
<div class="sidebar">
    <a href="/emp-reg/dashboard.php">🏠 Dashboard</a>
    <a href="/emp-reg/employees/view.php">👔 Employees</a>
    <a href="/emp-reg/clients/view.php">👥 Clients</a>
    <a href="/emp-reg/projects/view.php">📁 Projects</a>
    <a href="/emp-reg/settings.php">⚙️ Account Settings</a>
    <a href="/emp-reg/logout.php">🚪 Logout</a>
</div>

<div class="content">
