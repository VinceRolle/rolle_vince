<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students List</title>
  <style>
    :root {
      --bg: linear-gradient(135deg, #3B82F6 0%, #FCD34D 100%);
      --card-bg: #ffffff;
      --primary: #3B82F6;
      --primary-hover: #2563eb;
      --secondary: #FCD34D;
      --secondary-hover: #f59e0b;
      --danger: #ef4444;
      --danger-hover: #dc2626;
      --success: #10b981;
      --success-hover: #059669;
      --warning: #f59e0b;
      --warning-hover: #d97706;
      --border: #e5e7eb;
      --text: #1f2937;
      --muted: #6B7280;
      --radius: 12px;
      --input-bg: #f9fafb;
      --input-focus: #ffffff;
      --shadow: 0 10px 25px -3px rgba(59, 130, 246, 0.1), 0 4px 6px -2px rgba(59, 130, 246, 0.05);
      --shadow-lg: 0 20px 25px -5px rgba(59, 130, 246, 0.1), 0 10px 10px -5px rgba(59, 130, 246, 0.04);
      font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
    }
    body {
      margin: 0;
      background: var(--bg);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      padding: 20px;
      color: var(--text);
    }
    .container {
      width: 100%;
      max-width: 1200px;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
      flex-wrap: wrap;
      gap: 16px;
    }
    h2 {
      margin: 0;
      font-size: 2.5rem;
      font-weight: 800;
      color: #ffffff;
    }
    .search-form {
      display: flex;
      gap: 12px;
      align-items: center;
      margin-bottom: 24px;
    }
    .search-form input {
      padding: 14px 18px;
      border-radius: var(--radius);
      border: 2px solid var(--border);
      background: var(--input-bg);
      color: var(--text);
      font-size: 1rem;
      font-weight: 500;
      flex: 1;
    }
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 14px 24px;
      border-radius: var(--radius);
      border: none;
      font-weight: 600;
      font-size: 1rem;
      color: #fff;
      cursor: pointer;
    }
    .btn-primary { background: var(--primary); }
    .btn-success { background: var(--success); }
    .btn-warning { background: var(--warning); }
    .btn-danger { background: var(--danger); }

    .card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow: auto;
      padding: 24px 0;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 600px;
    }
    th, td {
      padding: 16px 20px;
      border-bottom: 1px solid var(--border);
      text-align: left;
    }
    th {
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      font-weight: 700;
      color: var(--muted);
      text-transform: uppercase;
    }
    .actions {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    /* Pagination horizontal fix */
    .pagination-container {
      margin-top: 32px;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
    }
    .pagination-container ul {
      list-style: none;
      display: flex;
      gap: 8px;
      padding: 0;
      margin: 0;
    }
    .pagination-container li {
      display: inline-block;
    }
    .pagination-container a,
    .pagination-container span {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 12px 16px;
      background: var(--card-bg);
      color: var(--primary);
      border: 2px solid var(--border);
      border-radius: var(--radius);
      font-weight: 600;
      font-size: 0.95rem;
      text-decoration: none;
      min-width: 44px;
      height: 44px;
    }
    .pagination-container a:hover {
      background: var(--primary);
      color: #fff;
      border-color: var(--primary);
    }
    .pagination-container .current,
    .pagination-container span {
      background: var(--primary);
      color: #fff;
      border-color: var(--primary);
      cursor: default;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Students List</h2>
      <a class="btn btn-success" href="<?= base_url().'students/create' ?>">Add Student</a>
    </div>
    
    <!-- Search Form -->
    <form action="<?=site_url('students/get-all');?>" method="get" class="search-form">
      <?php
      $q = '';
      if(isset($_GET['q'])) {
        $q = $_GET['q'];
      }
      ?>
      <input name="q" type="text" placeholder="Search students..." value="<?=html_escape($q);?>">
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
    
    <div class="card">
      <table>
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
            <td class="actions">
              <a href="<?= site_url().'students/update/'.$s['id'] ?>" class="btn btn-warning">Edit</a>
              <a href="<?= site_url().'students/delete/'.$s['id'] ?>" class="btn btn-danger" onclick="return confirm('Delete student?')">Delete</a>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" style="text-align: center; padding: 40px; color: var(--muted);">
              No students found.
            </td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
    
    <!-- Pagination -->
    <?php if(isset($page) && !empty($page)): ?>
    <div class="pagination-container">
      <?= $page ?>
    </div>
    <?php endif; ?>
  </div>
</body>
</html>
