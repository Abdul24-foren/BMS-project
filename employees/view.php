<?php
session_start();
require "../config/db.php";
$rows=$pdo->query("SELECT * FROM employees ORDER BY id DESC")->fetchAll();
include "../includes/layout.php";
?>

<div class="card">
<h2>Employees</h2>
<a class="btn" href="add.php">+ Add Employee</a>

<table>
<tr><th>Name</th><th>Email</th><th>Position</th><th>Phone</th><th>Action</th></tr>

<?php foreach($rows as $r): ?>
<tr>
<td><?= $r['name'] ?></td>
<td><?= $r['email'] ?></td>
<td><?= $r['position'] ?></td>
<td><?= $r['phone'] ?></td>
<td><a class="delete" href="delete.php?id=<?= $r['id'] ?>">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
</div>

</div></div></body></html>
