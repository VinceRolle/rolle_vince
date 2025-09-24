<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: #f6f8fa;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 1100px;
      margin: 40px auto;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.07);
      padding: 32px 32px 24px 32px;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
    }
    h2 {
      margin: 0;
      font-size: 2.2rem;
      font-weight: 700;
      color: #222;
    }
    .btn {
      display: inline-block;
      padding: 7px 18px;
      border-radius: 6px;
      font-size: 1rem;
      font-weight: 500;
      border: none;
      cursor: pointer;
      transition: background 0.2s;
    }
    .btn-success { background: #1976d2; color: #fff; }
    .btn-success:hover { background: #1256a0; }
    .btn-warning { background: #fbc02d; color: #222; }
    .btn-warning:hover { background: #c49000; }
    .btn-danger { background: #e53935; color: #fff; }
    .btn-danger:hover { background: #b71c1c; }
    .btn-primary { background: #43a047; color: #fff; }
    .btn-primary:hover { background: #2e7031; }
    .search-form {
      display: flex;
      gap: 10px;
      margin-bottom: 18px;
    }
    .search-form input {
      padding: 8px 14px;
      border-radius: 5px;
      border: 1px solid #d1d5db;
      font-size: 1rem;
      flex: 1;
    }
    .search-form button {
      min-width: 90px;
    }
    .card {
      overflow-x: auto;
      border-radius: 8px;
      border: 1px solid #e0e0e0;
      background: #fff;
      box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
    }
    th, td {
      padding: 12px 16px;
      border-bottom: 1px solid #e0e0e0;
      text-align: left;
      font-size: 1rem;
    }
    th {
      background: #f3f4f6;
      color: #555;
      font-weight: 600;
      text-transform: none;
    }
    tr:last-child td {
      border-bottom: none;
    }
    .actions {
      display: flex;
      gap: 6px;
    }
    .actions a.btn {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 0.98rem;
      padding: 7px 14px;
      transition: background 0.2s, color 0.2s, box-shadow 0.2s;
      box-shadow: 0 1px 3px rgba(25, 118, 210, 0.07);
    }
    .actions a.btn i {
      font-size: 1.1em;
    }
    @media (max-width: 700px) {
      .container {
        padding: 10px;
      }
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead tr {
        display: none;
      }
      tr {
        margin-bottom: 1rem;
        border-radius: 8px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        background: #fff;
      }
      td {
        border: none;
        position: relative;
        padding-left: 50%;
        min-height: 40px;
        font-size: 0.98rem;
      }
      td:before {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        font-weight: 600;
        color: #1976d2;
        content: attr(data-label);
      }
    }
    .pagination-container {
      margin-top: 24px;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .pagination-container ul {
      list-style: none;
      display: flex;
      gap: 4px;
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
      padding: 7px 13px;
      background: #f3f4f6;
      color: #1976d2;
      border: 1px solid #e0e0e0;
      border-radius: 5px;
      font-size: 1rem;
      text-decoration: none;
      min-width: 36px;
      height: 36px;
      transition: background 0.2s, color 0.2s;
    }
    .pagination-container a:hover {
      background: #1976d2;
      color: #fff;
      border-color: #1976d2;
    }
    .pagination-container .current,
    .pagination-container span {
      background: #1976d2;
      color: #fff;
      border-color: #1976d2;
      cursor: default;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Students List</h2>
      <a class="btn btn-success" href="<?= site_url('students/create') ?>">Add Student</a>
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
              <a href="<?= site_url().'students/update/'.$s['id'] ?>" class="btn btn-warning" title="Edit"><i class="fa fa-pen-to-square"></i> <span class="d-none d-md-inline">Edit</span></a>
              <a href="<?= site_url().'students/delete/'.$s['id'] ?>" class="btn btn-danger" title="Delete" onclick="return confirm('Delete student?')"><i class="fa fa-trash"></i> <span class="d-none d-md-inline">Delete</span></a>
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
