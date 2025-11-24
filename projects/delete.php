<?php
require "../config/db.php";
$pdo->prepare("DELETE FROM projects WHERE id=?")
->execute([$_GET['id']]);
header("Location: view.php");
