<?php
session_start();
require "../config/db.php";
$clients=$pdo->query("SELECT * FROM clients")->fetchAll();

if($_POST){
$pdo->prepare("INSERT INTO projects(title,client_id,description,start_date,end_date,status)
VALUES(?,?,?,?,?,?)")
->execute([
$_POST['title'],$_POST['client_id'],$_POST['desc'],
$_POST['start_date'],$_POST['end_date'],$_POST['status']
]);
header("Location: view.php");
}

include "../includes/layout.php";
?>

<div class="card">
<h2>Add Project</h2>
<form method="post">
<input name="title" placeholder="Title">
<select name="client_id">
<?php foreach($clients as $c): ?>
<option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
<?php endforeach; ?>
</select>

<textarea name="desc" placeholder="Description"></textarea>
<input type="date" name="start_date">
<input type="date" name="end_date">

<select name="status">
<option>Planned</option>
<option>Running</option>
<option>Completed</option>
</select>

<button class="btn">Save Project</button>
</form>
</div>

</div></div></body></html>
