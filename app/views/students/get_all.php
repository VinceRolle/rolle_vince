<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
	<div class="container mt-3">
		<form action="<?=site_url('students/get-all');?>" method="get" class="col-sm-4 float-end d-flex">
			<?php
			$q = '';
			if(isset($_GET['q'])) {
				$q = $_GET['q'];
			}
			?>
			<input class="form-control me-2" name="q" type="text" placeholder="Search" value="<?=html_escape($q);?>">
			<button type="submit" class="btn btn-primary" type="button">Search</button>
		</form>
		<h2>Students List</h2>
		<div class="mb-3">
			<a href="<?= base_url().'students/create' ?>" class="btn btn-success">Add Student</a>
		</div>
		<table class="table table-striped">
			<thead>
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Actions</th>
			</tr>
			</thead>
			<tbody>
			<?php if(isset($all) && !empty($all)): ?>
				<?php foreach($all as $s): ?>
				<tr>
					<td><?=$s['id'];?></td>
					<td><?=$s['first_name'];?></td>
					<td><?=$s['last_name'];?></td>
					<td><?=$s['email'];?></td>
					<td>
						<a href="<?= base_url().'students/update/'.$s['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="<?= base_url().'students/delete/'.$s['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete student?')">Delete</a>
					</td>
				</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="5" class="text-center">No students found.</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
		<?php
		if(isset($page) && !empty($page)) {
			echo $page;
		}
		?>
	</div>
</body>
</html>
