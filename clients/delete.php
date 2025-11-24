<?php
require "../config/db.php";
$pdo->prepare("DELETE FROM clients WHERE id=?")->execute([$_GET['id']]);
header("Location: view.php");
