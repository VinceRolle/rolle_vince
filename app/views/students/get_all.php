<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(135deg, #0f2027 0%, #2c5364 100%);
      min-height: 100vh;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .container {
      max-width: 1100px;
      margin: 40px auto;
      background: rgba(20, 24, 50, 0.85);
      border-radius: 24px;
      box-shadow: 0 8px 32px 0 rgba(0,255,255,0.18), 0 0px 40px 0 #00ffe7cc;
      padding: 40px 32px 32px 32px;
      backdrop-filter: blur(18px);
      border: 2.5px solid #00ffe7cc;
      position: relative;
      overflow: hidden;
    }
    .container:before {
      content: '';
      position: absolute;
      top: -60px; left: -60px;
      width: 220px; height: 220px;
      background: radial-gradient(circle, #00ffe7 0%, #6c4ee6 100%);
      opacity: 0.18;
      z-index: 0;
      border-radius: 50%;
      filter: blur(2px);
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 32px;
      position: relative;
      z-index: 1;
    }
    h2 {
      margin: 0;
      font-size: 2.6rem;
      font-weight: 900;
      color: #00ffe7;
      letter-spacing: -1.5px;
      text-shadow: 0 2px 24px #00ffe799, 0 0px 8px #6c4ee6cc;
      background: linear-gradient(90deg, #00ffe7 0%, #6c4ee6 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 0.6em;
      padding: 12px 28px;
      border-radius: 12px;
      font-size: 1.08rem;
      font-weight: 700;
      border: none;
      cursor: pointer;
      transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
      box-shadow: 0 2px 12px 0 #00ffe799;
      background: linear-gradient(90deg, #00ffe7 0%, #6c4ee6 100%);
      color: #181c2f;
      position: relative;
      overflow: hidden;
      text-shadow: 0 1px 8px #00ffe799;
    }
    .btn-success {
      background: linear-gradient(90deg, #00ffb3 0%, #00ffe7 100%);
      color: #181c2f;
      text-shadow: 0 1px 8px #00ffe799;
    }
    .btn-success:hover {
      background: linear-gradient(90deg, #00ffe7 0%, #00ffb3 100%);
      transform: translateY(-2px) scale(1.04);
      box-shadow: 0 4px 24px 0 #00ffe799;
    }
    .btn-warning {
      background: linear-gradient(90deg, #fffb00 0%, #ff00c8 100%);
      color: #181c2f;
      text-shadow: 0 1px 8px #fffb0099;
    }
    .btn-warning:hover {
      background: linear-gradient(90deg, #ff00c8 0%, #fffb00 100%);
      transform: translateY(-2px) scale(1.04);
      box-shadow: 0 4px 24px 0 #fffb0099;
    }
    .btn-danger {
      background: linear-gradient(90deg, #ff00c8 0%, #ff5858 100%);
      color: #fff;
      text-shadow: 0 1px 8px #ff00c899;
    }
    .btn-danger:hover {
      background: linear-gradient(90deg, #ff5858 0%, #ff00c8 100%);
      transform: translateY(-2px) scale(1.04);
      box-shadow: 0 4px 24px 0 #ff00c899;
    }
    .btn-primary {
      background: linear-gradient(90deg, #00ffe7 0%, #6c4ee6 100%);
      color: #181c2f;
      text-shadow: 0 1px 8px #00ffe799;
    }
    .btn-primary:hover {
      background: linear-gradient(90deg, #6c4ee6 0%, #00ffe7 100%);
      transform: translateY(-2px) scale(1.04);
      box-shadow: 0 4px 24px 0 #00ffe799;
    }
    .search-form {
      display: flex;
      gap: 12px;
      margin-bottom: 24px;
      z-index: 1;
      position: relative;
    }
    .search-form input {
      padding: 12px 18px;
      border-radius: 10px;
      border: 2px solid #00ffe7cc;
      background: rgba(0,0,0,0.18);
      color: #00ffe7;
      font-size: 1.08rem;
      font-weight: 500;
      flex: 1;
      transition: border 0.2s, box-shadow 0.2s;
      box-shadow: 0 1px 8px #00ffe799;
    }
    .search-form input:focus {
      border: 2px solid #ff00c8;
      outline: none;
      box-shadow: 0 2px 12px #ff00c899;
      color: #ff00c8;
    }
    .card {
      overflow-x: auto;
      border-radius: 18px;
      border: 2px solid #00ffe7cc;
      background: rgba(20, 24, 50, 0.92);
      box-shadow: 0 4px 32px 0 #00ffe799;
      margin-bottom: 0;
      position: relative;
      z-index: 1;
    }
    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      background: transparent;
      border-radius: 18px;
      overflow: hidden;
    }
    th, td {
      padding: 18px 22px;
      border-bottom: none;
      text-align: left;
      font-size: 1.08rem;
      position: relative;
      background: transparent;
    }
    td {
      background: rgba(255,255,255,0.92);
      color: #232946;
      box-shadow: 0 1px 4px rgba(0,0,0,0.04);
      border-bottom: 1px solid #e0e0e0;
      border-radius: 0;
    }
    th {
      background: linear-gradient(90deg, #26334d 0%, #2c5364 100%);
      color: #fff;
      font-weight: 900;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      border: none;
      text-shadow: 0 2px 8px #000a, 0 1px 0 #26334d;
      position: relative;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
      opacity: 1;
    }
    tr {
      transition: background 0.18s;
    }
    tr:hover {
      background: #00ffe71a;
      box-shadow: 0 2px 16px #00ffe799;
    }
    .actions {
      display: flex;
      gap: 10px;
      justify-content: center;
    }
    .actions a.btn {
      display: flex;
      align-items: center;
      gap: 7px;
      font-size: 1.05rem;
      padding: 10px 18px;
      border-radius: 10px;
      background: linear-gradient(90deg, #181c2f 0%, #2c5364 100%);
      color: #00ffe7;
      border: 2px solid #00ffe7cc;
      box-shadow: 0 1px 8px #00ffe799;
      transition: background 0.18s, color 0.18s, box-shadow 0.18s, transform 0.15s;
      font-weight: 700;
      position: relative;
      overflow: hidden;
      text-shadow: 0 1px 8px #00ffe799;
    }
    .actions a.btn i {
      font-size: 1.2em;
      transition: color 0.18s, transform 0.18s;
      filter: drop-shadow(0 0 4px #00ffe7cc);
    }
    .actions a.btn:hover {
      background: linear-gradient(90deg, #00ffe7 0%, #ff00c8 100%);
      color: #181c2f;
      box-shadow: 0 4px 24px #00ffe799;
      transform: translateY(-2px) scale(1.07);
      text-shadow: 0 1px 12px #ff00c899;
    }
    .actions a.btn-warning:hover i {
      color: #fffb00;
      filter: drop-shadow(0 0 8px #fffb00cc);
      transform: rotate(-10deg) scale(1.2);
    }
    .actions a.btn-danger:hover i {
      color: #ff00c8;
      filter: drop-shadow(0 0 8px #ff00c8cc);
      transform: rotate(10deg) scale(1.2);
    }
    .actions a.btn-success:hover i {
      color: #00ffb3;
      filter: drop-shadow(0 0 8px #00ffb3cc);
      transform: scale(1.2);
    }
    .actions a.btn-primary:hover i {
      color: #00ffe7;
      filter: drop-shadow(0 0 8px #00ffe7cc);
      transform: scale(1.2);
    }
    .pagination-container {
      margin-top: 32px;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1;
      position: relative;
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
      padding: 12px 20px;
      background: linear-gradient(90deg, #181c2f 0%, #2c5364 100%);
      color: #00ffe7;
      border: 2px solid #00ffe7cc;
      border-radius: 10px;
      font-weight: 700;
      font-size: 1.05rem;
      text-decoration: none;
      min-width: 44px;
      height: 44px;
      transition: background 0.18s, color 0.18s, box-shadow 0.18s;
      box-shadow: 0 1px 8px #00ffe799;
    }
    .pagination-container a:hover {
      background: linear-gradient(90deg, #00ffe7 0%, #ff00c8 100%);
      color: #181c2f;
      border-color: #ff00c8;
      box-shadow: 0 2px 12px #ff00c899;
    }
    .pagination-container .current,
    .pagination-container span {
      background: linear-gradient(90deg, #00ffe7 0%, #ff00c8 100%);
      color: #181c2f;
      border-color: #ff00c8;
      cursor: default;
      box-shadow: 0 2px 12px #ff00c899;
    }
    @media (max-width: 900px) {
      .container {
        padding: 16px 4vw 16px 4vw;
      }
      th, td {
        padding: 12px 10px;
      }
    }
    @media (max-width: 700px) {
      .container {
        padding: 8px 2vw 8px 2vw;
      }
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead tr {
        display: none;
      }
      tr {
        margin-bottom: 1.2rem;
        border-radius: 14px;
        box-shadow: 0 2px 8px #a18cd122;
        background: rgba(255,255,255,0.9);
      }
      td {
        border: none;
        position: relative;
        padding-left: 54%;
        min-height: 40px;
        font-size: 1.01rem;
      }
      td:before {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        font-weight: 800;
        color: #a18cd1;
        content: attr(data-label);
        font-size: 0.98em;
      }
      .actions {
        justify-content: flex-start;
      }
    }
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: #f6f8fa;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 1100px;
      margin: 40px auto;
  background: linear-gradient(135deg, #181c2f 60%, #2c5364 100%);
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
  background: linear-gradient(135deg, #181c2f 60%, #2c5364 100%);
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
  background: linear-gradient(90deg, #232946 0%, #2c5364 100%);
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
  background: linear-gradient(135deg, #181c2f 60%, #2c5364 100%);
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
      <h2>Students List 
        <?php if(isset($user_role) && $user_role === 'admin'): ?>
          <span style="font-size: 0.6em; color: #ff00c8; background: rgba(255,0,200,0.1); padding: 4px 8px; border-radius: 6px; margin-left: 12px;">👑 ADMIN</span>
        <?php else: ?>
          <span style="font-size: 0.6em; color: #00ffe7; background: rgba(0,255,231,0.1); padding: 4px 8px; border-radius: 6px; margin-left: 12px;">👨‍🎓 STUDENT</span>
        <?php endif; ?>
      </h2>
      <div style="display: flex; gap: 12px; align-items: center;">
        <?php if(isset($user_role) && $user_role === 'admin'): ?>
          <a class="btn btn-success" href="<?= site_url('students/create') ?>">Add Student</a>
        <?php endif; ?>
        <a class="btn btn-danger" href="<?= site_url('auth/logout') ?>" style="background: linear-gradient(90deg, #ff00c8 0%, #ff5858 100%); color: #fff; text-shadow: 0 1px 8px #ff00c899;">🚪 Logout</a>
      </div>
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
          <th><i class="fa fa-hashtag" title="ID"></i> ID</th>
          <th><i class="fa fa-user" title="First Name"></i> First Name</th>
          <th><i class="fa fa-user-astronaut" title="Last Name"></i> Last Name</th>
          <th><i class="fa fa-envelope" title="Email"></i> Email</th>
          <th><i class="fa fa-gears" title="Actions"></i> Actions</th>
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
              <?php if(isset($user_role) && $user_role === 'admin'): ?>
                <a href="<?= site_url().'students/update/'.$s['id'] ?>" class="btn btn-warning" title="Edit"><i class="fa fa-pen-to-square"></i> <span class="d-none d-md-inline">Edit</span></a>
                <a href="<?= site_url().'students/delete/'.$s['id'] ?>" class="btn btn-danger" title="Delete" onclick="return confirm('Delete student?')"><i class="fa fa-trash"></i> <span class="d-none d-md-inline">Delete</span></a>
              <?php else: ?>
                <span style="color: #666; font-style: italic;">View Only</span>
              <?php endif; ?>
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
