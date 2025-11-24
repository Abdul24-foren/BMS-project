<?php
session_start();
require "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

$success = $error = "";

if (isset($_POST['add_client'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $company = trim($_POST['company']);
    $phone = trim($_POST['phone']);

    if ($name == "" || $email == "") {
        $error = "All required fields must be filled ❌";
    } else {
        $stmt = $pdo->prepare("INSERT INTO clients (name, email, company, phone) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $company, $phone]);

        $success = "Client added successfully ✅";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Client | BMS</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<style>
body{
    margin:0;
    font-family:Inter, sans-serif;
    background:#020617;
    color:#fff;
}
.wrapper{display:flex;}
.sidebar{
    width:260px;
    background:#0f172a;
    min-height:100vh;
    padding:25px
}
.sidebar a{
    display:block;
    padding:12px;
    margin-bottom:10px;
    background:#020617;
    color:#cbd5e1;
    border-radius:8px;
    text-decoration:none;
}
.sidebar a:hover{background:#38bdf8;color:black}

.main{flex:1;padding:40px}

.card{
    max-width:500px;
    background:rgba(255,255,255,0.05);
    padding:30px;
    border-radius:16px;
    box-shadow:0 10px 25px rgba(0,0,0,0.5);
}

input{
    width:100%;
    padding:12px;
    margin:10px 0 18px;
    border-radius:8px;
    border:none;
    background:#0f172a;
    color:white;
    font-size:15px;
}

button{
    width:100%;
    padding:14px;
    background:#38bdf8;
    border:none;
    border-radius:8px;
    font-weight:bold;
    cursor:pointer;
}

.success{color:#4ade80}
.error{color:#f87171}
</style>
</head>
<body>

<div class="wrapper">

<div class="sidebar">
    <a href="/emp-reg/dashboard.php">🏠 Dashboard</a>
    <a href="/emp-reg/employees/view.php">👔 Employees</a>
    <a href="/emp-reg/clients/view.php">👥 Clients</a>
    <a href="/emp-reg/projects/view.php">📁 Projects</a>
    <a href="/emp-reg/settings.php">⚙️ Settings</a>
</div>

<div class="main">

<div class="card">
    <h2>➕ Add New Client</h2>

    <?php if($success) echo "<p class='success'>$success</p>"; ?>
    <?php if($error) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">

        <label>Client Name *</label>
        <input type="text" name="name" placeholder="Enter client full name" required>

        <label>Email *</label>
        <input type="email" name="email" placeholder="Enter email address" required>

        <label>Company</label>
        <input type="text" name="company" placeholder="Company name">

        <label>Phone</label>
        <input type="text" name="phone" placeholder="Mobile or Office number">

        <button name="add_client">➕ Add Client</button>

    </form>

</div>

</div>
</div>

</body>
</html>
