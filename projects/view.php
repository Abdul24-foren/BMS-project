<?php
session_start();
require "../config/db.php";

$projects=$pdo->query("SELECT p.*, c.name client 
FROM projects p LEFT JOIN clients c 
ON p.client_id=c.id")->fetchAll();

include "../includes/layout.php";
?>

<div class="card">
<h2>Projects</h2>
<a class="btn" href="add.php">+ Add Project</a>

<table>
<tr><th>Title</th><th>Client</th><th>Status</th><th>Action</th></tr>
<?php foreach($projects as $p): ?>
<tr>
<td><?= $p['title'] ?></td>
<td><?= $p['client'] ?></td>
<td><?= $p['status'] ?></td>
<td><a class="delete" href="delete.php?id=<?= $p['id'] ?>">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
</div>

</div></div></body></html>
