<?php 
session_start();
require "../config/db.php";
$clients=$pdo->query("SELECT * FROM clients")->fetchAll();
include "../includes/layout.php";
?>

<div class="card">
<h2>Clients</h2>
<a class="btn" href="add.php">+ Add Client</a>

<table>
<tr><th>Name</th><th>Email</th><th>Company</th><th>Phone</th><th>Action</th></tr>
<?php foreach($clients as $c): ?>
<tr>
<td><?= $c['name'] ?></td>
<td><?= $c['email'] ?></td>
<td><?= $c['company'] ?></td>
<td><?= $c['phone'] ?></td>
<td><a class="delete" href="delete.php?id=<?= $c['id'] ?>">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
</div>

</div></div></body></html>
