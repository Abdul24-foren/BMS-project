<?php
require 'config/db.php';
$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT);
$fullname = 'Administrator';
$stmt = $pdo->prepare('INSERT INTO users (username,password,fullname) VALUES (?,?,?)');
$stmt->execute([$username, $password, $fullname]);
echo "Admin created. username=admin password=admin123";
