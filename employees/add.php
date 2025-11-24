<?php
session_start();
require "../config/db.php";

if($_POST){
  $pdo->prepare("INSERT INTO employees(name,email,position,phone,hire_date)
  VALUES(?,?,?,?,?)")
  ->execute([$_POST['name'],$_POST['email'],
  $_POST['position'],$_POST['phone'],$_POST['hire_date']]);

  header("Location: view.php");
}

include "../includes/layout.php";
?>

<div class="card">
<h2>Add Employee</h2>
<form method="post">
<input name="name" placeholder="Name">
<input name="email" placeholder="Email">
<input name="position" placeholder="Position">
<input name="phone" placeholder="Phone">
<input type="date" name="hire_date">
<button class="btn">Save Employee</button>
</form>
</div>

</div></div></body></html>
