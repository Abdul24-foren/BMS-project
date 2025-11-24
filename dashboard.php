<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$empCount = $pdo->query("SELECT COUNT(*) FROM employees")->fetchColumn();
$clientCount = $pdo->query("SELECT COUNT(*) FROM clients")->fetchColumn();
$projectCount = $pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();

$recentProjects = $pdo->query("
SELECT projects.title, clients.name as client_name, projects.status, projects.start_date
FROM projects
LEFT JOIN clients ON projects.client_id = clients.id
ORDER BY projects.id DESC LIMIT 5
")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<title>BMS-Pro Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    background: radial-gradient(circle at top, #0a2540, #020617);
    font-family: 'Inter', sans-serif;
    color: #fff;
}

/* Top */
.topbar {
    height: 70px;
    background: linear-gradient(90deg, #0f172a, #020617);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 40px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.6);
}

.logo {
    font-size: 20px;
    font-weight: 700;
    color: #38bdf8;
}

.user-area a {
    color: #38bdf8;
    text-decoration: none;
    margin-left: 15px;
}

/* Layout */
.wrapper {
    display: flex;
}

/* Sidebar */
.sidebar {
    width: 260px;
    background: rgba(10, 25, 47, 0.9);
    height: 100vh;
    padding: 35px 20px;
}

.sidebar a {
    display: block;
    padding: 14px;
    margin-bottom: 12px;
    color: #cbd5e1;
    text-decoration: none;
    border-radius: 10px;
    transition: 0.3s;
}

.sidebar a:hover {
    background: linear-gradient(90deg, #38bdf8, #2563eb);
    color: white;
}

/* Main */
.main {
    flex: 1;
    padding: 40px;
}

/* Welcome Card */
.welcome-card {
    display: flex;
    align-items: center;
    background: rgba(255,255,255,0.05);
    border-radius: 20px;
    padding: 30px;
    backdrop-filter: blur(20px);
    box-shadow: 0 20px 30px rgba(0,0,0,0.4);
    margin-bottom: 30px;
}

.welcome-text {
    flex: 1;
}

.welcome-text h1 {
    font-size: 26px;
    margin-bottom: 10px;
}

.welcome-text p {
    color: #a1a1aa;
}

.welcome-card img {
    width: 300px;
    border-radius: 16px;
}

/* Stats */
.stats {
    display: flex;
    gap: 20px;
    margin-bottom: 40px;
}

.stat-box {
    flex: 1;
    background: linear-gradient(145deg, #0f172a, #020617);
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.5);
}

.stat-box h3 {
    color: #94a3b8;
}

.stat-box span {
    font-size: 32px;
    font-weight: 700;
    color: #38bdf8;
}

.stat-box a {
    color: #38bdf8;
    display: block;
    margin-top: 8px;
}

/* Table */
.table-box {
    background: rgba(255,255,255,0.05);
    padding: 25px;
    border-radius: 16px;
    backdrop-filter: blur(20px);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th, td {
    padding: 14px;
    text-align: left;
}

th {
    color: #38bdf8;
    border-bottom: 1px solid #334155;
}

tr:not(:last-child) {
    border-bottom: 1px solid #1e293b;
}
</style>
</head>
<body>

<div class="topbar">
    <div class="logo">BMS-PRO</div>
    <div class="user-area">
        Hi <?= $_SESSION['username'] ?> 👋 |
        <a href="/emp-reg/logout.php">Logout</a>
    </div>
</div>
<div class="wrapper">

<div class="sidebar">
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="employees/view.php">👔 Employees</a>
    <a href="clients/view.php">👥 Clients</a>
    <a href="projects/view.php">📁 Projects</a>
    <a href="settings.php">⚙️ Account Settings</a>

</div>

<div class="main">

<div class="welcome-card">
    <div class="welcome-text">
        <h1>Corporate Performance Management</h1>
        <p>Track, analyze and manage your entire business performance efficiently.</p>
    </div>
    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=900&q=80">
</div>

<div class="stats">
    <div class="stat-box">
        <h3>Employees</h3>
        <span><?= $empCount ?></span>
        <a href="employees/view.php">View details →</a>
    </div>

    <div class="stat-box">
        <h3>Clients</h3>
        <span><?= $clientCount ?></span>
        <a href="clients/view.php">View details →</a>
    </div>

    <div class="stat-box">
        <h3>Projects</h3>
        <span><?= $projectCount ?></span>
        <a href="projects/view.php">View details →</a>
    </div>
</div>

<div class="table-box">
    <h3>Recent Projects</h3>
    <table>
        <tr>
            <th>Title</th>
            <th>Client</th>
            <th>Status</th>
            <th>Start</th>
        </tr>

        <?php if(count($recentProjects) > 0): ?>
            <?php foreach($recentProjects as $row): ?>
        <tr>
            <td><?= $row['title']; ?></td>
            <td><?= $row['client_name'] ?? 'N/A'; ?></td>
            <td><?= $row['status']; ?></td>
            <td><?= $row['start_date']; ?></td>
        </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No Projects Found</td></tr>
        <?php endif; ?>
    </table>
</div>

</div>
</div>

</body>
</html>
