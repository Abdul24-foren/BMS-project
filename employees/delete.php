<?php
require "../config/db.php";
$pdo->prepare("DELETE FROM employees WHERE id=?")->execute([$_GET['id']]);
header("Location: view.php");
