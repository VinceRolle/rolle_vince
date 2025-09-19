<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students List</title>
  <style>
    :root {
      --bg: linear-gradient(135deg, #ffb347 0%, #ffcc80 100%);
      --card-bg: #fff6e9;
      --primary: #ff7043;
      --primary-hover: #ff9800;
      --danger: #ef4444;
      --danger-hover: #dc2626;
      --border: #ffd699;
      --text: #4e260e;
      --muted: #b85c38;
      --radius: 18px;
      font-family: 'Segoe UI', system-ui, sans-serif;
    }
    body {
      margin: 0;
      background: var(--bg);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      padding: 32px 8px;
      color: var(--text);
      transition: background 0.4s;
    }
    .container {
      width: 100%;
      max-width: 980px;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 22px;
      flex-wrap: wrap;
      gap: 12px;
    }
    h2 {
      margin: 0;
      font-size: 2rem;
      font-weight: 700;
      color: var(--primary);
      letter-spacing: 1px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .btn {
      display: inline-block;
      padding: 12px 22px;
      border-radius: var(--radius);
      border: none;
      text-decoration: none;
      font-weight: 600;
      font-size: 1rem;
      background: var(--primary);
      color: #fff;
      box-shadow: 0 4px 14px rgba(255, 140, 0, 0.18);
      transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
      letter-spacing: 0.5px;
      position: relative;
      z-index: 1;
    }
    .btn:hover, .btn:focus {
      background: var(--primary-hover);
      transform: translateY(-2px) scale(1.04);
      box-shadow: 0 6px 18px rgba(255, 140, 0, 0.32);
    }
    .card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: 0 12px 28px rgba(255, 140, 0, 0.08);
      overflow: auto;
      animation: fadeIn 0.5s;
      padding: 18px 0;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 600px;
    }
    th, td {
      padding: 14px 16px;
      border-bottom: 1px solid var(--border);
      text-align: left;
      font-size: 1rem;
    }
    th {
      background: #fffbe6;
      font-weight: 700;
      color: var(--muted);
      font-size: 0.98rem;
      letter-spacing: 0.5px;
    }
    tr {
      transition: background 0.2s;
    }
    tr:hover td {
      background: #fffbe6;
    }
    .actions {
      display: flex;
      gap: 10px;
    }
    .actions a {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 7px 14px;
      border-radius: 10px;
      font-size: 0.98rem;
      font-weight: 500;
      text-decoration: none;
      transition: background 0.2s, color 0.2s, box-shadow 0.2s;
      box-shadow: 0 2px 8px rgba(255, 140, 0, 0.07);
      position: relative;
    }
    .actions a.edit {
      background: rgba(255, 140, 0, 0.08);
      color: var(--primary);
      border: 1px solid var(--primary);
    }
    .actions a.edit:hover {
      background: rgba(255, 140, 0, 0.18);
      color: var(--primary-hover);
      box-shadow: 0 4px 12px rgba(255, 140, 0, 0.18);
    }
    .actions a.delete {
      background: rgba(239,68,68,0.08);
      color: var(--danger);
      border: 1px solid var(--danger);
    }
    .actions a.delete:hover {
      background: rgba(239,68,68,0.18);
      color: var(--danger-hover);
      box-shadow: 0 4px 12px rgba(239,68,68,0.18);
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(18px);}
      to { opacity: 1; transform: translateY(0);}
    }
    @media (max-width: 800px) {
      .container { max-width: 100%; }
      table { min-width: 100%; font-size: 0.95rem; }
      th, td { padding: 10px 6px; }
      h2 { font-size: 1.3rem; }
      .btn { font-size: 0.95rem; padding: 10px 14px; }
    }
    @media (max-width: 600px) {
      .card { padding: 8px 0; }
      table { font-size: 0.92rem; }
      th, td { padding: 8px 4px; }
      .header { flex-direction: column; align-items: flex-start; gap: 8px; }
    }
    /* Button ripple effect */
    .btn:active::after {
      content: '';
      position: absolute;
      left: 50%; top: 50%;
      width: 120%;
      height: 120%;
      background: rgba(255, 152, 0, 0.18);
      border-radius: 50%;
      transform: translate(-50%, -50%);
      z-index: 0;
      animation: ripple 0.4s linear;
    }
    @keyframes ripple {
      from { opacity: 0.7; }
      to { opacity: 0; }
    }
  </style>
</head>
<body>

    <form action="<?=site_url('author');?>" method="get" class="col-sm-4 float-end d-flex">
		<?php
		$q = '';
		if(isset($_GET['q'])) {
			$q = $_GET['q'];
		}
		?>
        <input class="form-control me-2" name="q" type="text" placeholder="Search" value="<?=html_escape($q);?>">
        <button type="submit" class="btn btn-primary" type="button">Search</button>
	</form>

  
  <div class="container">
    <div class="header">
      <h2>Students List</h2>
      <a class="btn" href="<?= base_url().'students/create' ?>">Add Student</a>
    </div>
    <div class="card">
      <table>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
        <?php foreach($students as $s): ?>
        <tr>
          <td><?= $s['id'] ?></td>
          <td><?= $s['first_name'] ?></td>
          <td><?= $s['last_name'] ?></td>
          <td><?= $s['email'] ?></td>
          <td class="actions">
            <a class="edit" href="<?= base_url().'students/update/'.$s['id'] ?>">Edit</a>
            <a class="delete" href="<?= base_url().'students/delete/'.$s['id'] ?>" onclick="return confirm('Delete student?')">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</body>
</html>
