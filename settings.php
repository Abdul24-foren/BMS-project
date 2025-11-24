<?php
session_start();
require "config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$success = $error = "";

// Get current user
$stmt = $pdo->prepare("SELECT * FROM users WHERE id=?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (isset($_POST['update'])) {

    $new_username = trim($_POST['username']);
    $old_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    // Verify password
    if (!password_verify($old_password, $user['password'])) {
        $error = "❌ Current password is incorrect";
    } else {

        // Check username exists
        if ($new_username !== $user['username']) {
            $check = $pdo->prepare("SELECT id FROM users WHERE username=? AND id!=?");
            $check->execute([$new_username, $_SESSION['user_id']]);

            if ($check->rowCount() > 0) {
                $error = "❌ Username already taken!";
            } else {
                $pdo->prepare("UPDATE users SET username=? WHERE id=?")
                    ->execute([$new_username, $_SESSION['user_id']]);

                $_SESSION['username'] = $new_username;
            }
        }

        // Update password
        if (!empty($new_password)) {
            $newHash = password_hash($new_password, PASSWORD_DEFAULT);

            $pdo->prepare("UPDATE users SET password=? WHERE id=?")
                ->execute([$newHash, $_SESSION['user_id']]);
        }

        if (!$error) {
            $success = "✅ Account updated successfully";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>BMS-Pro | Account Settings</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<style>
body{
    margin:0;
    font-family:Inter, sans-serif;
    background:#020617;
    color:#fff;
}

/* TOP BAR */
.topbar{
    background:linear-gradient(90deg, #0f172a, #020617);
    padding:18px 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.logo{color:#38bdf8;font-size:20px;font-weight:bold;}
.user-area a{color:#38bdf8;text-decoration:none}

/* SIDEBAR */
.wrapper{
    display:flex;
}
.sidebar{
    width:250px;
    background:#0f172a;
    min-height:100vh;
    padding:25px;
}
.sidebar a {
    display:block;
    margin-bottom:12px;
    padding:12px;
    background:#020617;
    border-radius:8px;
    color:#cbd5e1;
    text-decoration:none;
}
.sidebar a:hover {
    background:#38bdf8;
    color:black;
}

/* MAIN */
.main{
    flex:1;
    padding:40px;
}

/* CARD */
.card{
    max-width:500px;
    background:rgba(255,255,255,0.05);
    padding:25px;
    border-radius:16px;
    box-shadow:0 15px 30px rgba(0,0,0,0.5);
}

input{
    width:100%;
    padding:12px;
    margin:10px 0 18px;
    border-radius:8px;
    border:none;
    background:#0f172a;
    color:white;
}

button{
    width:100%;
    padding:12px;
    background:#38bdf8;
    border:none;
    border-radius:8px;
    font-weight:bold;
}

.success{color:#4ade80}
.error{color:#f87171}
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

<!-- ✅ FIXED SIDEBAR -->
<div class="sidebar">
    <a href="/emp-reg/dashboard.php">🏠 Dashboard</a>
    <a href="/emp-reg/employees/view.php">👔 Employees</a>
    <a href="/emp-reg/clients/view.php">👥 Clients</a>
    <a href="/emp-reg/projects/view.php">📁 Projects</a>
    <a href="/emp-reg/settings.php">⚙️ Account Settings</a>
    <a href="/emp-reg/logout.php">🚪 Logout</a>
</div>

<div class="main">

<div class="card">
<h2>⚙️ Account Settings</h2>

<?php if ($error): ?><p class="error"><?= $error ?></p><?php endif; ?>
<?php if ($success): ?><p class="success"><?= $success ?></p><?php endif; ?>

<form method="post">

    <label>Change Username</label>
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>">

    <label>Current Password</label>
    <input type="password" name="current_password" required>

    <label>New Password</label>
    <input type="password" name="new_password" placeholder="Leave empty if not changing">

    <button name="update">Update Account</button>
</form>

</div>

</div>
</div>
</body>
</html>
