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
      transition: all 0.3s ease;
      animation: fadeInBody 0.8s ease-out;
    }
    .container {
      width: 100%;
      max-width: 1200px;
      animation: slideInUp 0.6s ease-out;
    }
    @keyframes fadeInBody {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    @keyframes slideInUp {
      from { 
        opacity: 0; 
        transform: translateY(30px); 
      }
      to { 
        opacity: 1; 
        transform: translateY(0); 
      }
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
      flex-wrap: wrap;
      gap: 16px;
      animation: slideInDown 0.7s ease-out;
    }
    h2 {
      margin: 0;
      font-size: 2.5rem;
      font-weight: 800;
      color: var(--primary);
      letter-spacing: -0.025em;
      display: flex;
      align-items: center;
      gap: 12px;
      animation: pulse 2s infinite;
    }
    @keyframes slideInDown {
      from { 
        opacity: 0; 
        transform: translateY(-20px); 
      }
      to { 
        opacity: 1; 
        transform: translateY(0); 
      }
    }
    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.02); }
    }
    .search-form {
      display: flex;
      gap: 12px;
      align-items: center;
      margin-bottom: 24px;
      animation: slideInLeft 0.8s ease-out;
    }
    .search-form input {
      padding: 14px 18px;
      border-radius: var(--radius);
      border: 2px solid var(--border);
      background: var(--input-bg);
      color: var(--text);
      font-size: 1rem;
      font-weight: 500;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: var(--shadow);
      flex: 1;
      position: relative;
    }
    .search-form input:focus {
      outline: none;
      border-color: var(--primary);
      background: var(--input-focus);
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1), var(--shadow-lg);
      transform: translateY(-2px);
    }
    .search-form input::placeholder {
      color: var(--muted);
      transition: color 0.3s ease;
    }
    .search-form input:focus::placeholder {
      color: var(--primary);
      opacity: 0.7;
    }
    @keyframes slideInLeft {
      from { 
        opacity: 0; 
        transform: translateX(-30px); 
      }
      to { 
        opacity: 1; 
        transform: translateX(0); 
      }
    }
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 14px 24px;
      border-radius: var(--radius);
      border: none;
      text-decoration: none;
      font-weight: 600;
      font-size: 1rem;
      color: #fff;
      box-shadow: var(--shadow);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      letter-spacing: 0.025em;
      position: relative;
      z-index: 1;
      cursor: pointer;
      overflow: hidden;
      animation: slideInRight 0.8s ease-out;
    }
    .btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }
    .btn:hover::before {
      left: 100%;
    }
    @keyframes slideInRight {
      from { 
        opacity: 0; 
        transform: translateX(30px); 
      }
      to { 
        opacity: 1; 
        transform: translateX(0); 
      }
    }
    .btn-primary {
      background: var(--primary);
    }
    .btn-primary:hover {
      background: var(--primary-hover);
      transform: translateY(-3px) scale(1.05);
      box-shadow: var(--shadow-lg);
    }
    .btn-success {
      background: var(--success);
    }
    .btn-success:hover {
      background: var(--success-hover);
      transform: translateY(-3px) scale(1.05);
      box-shadow: var(--shadow-lg);
    }
    .btn-warning {
      background: var(--warning);
    }
    .btn-warning:hover {
      background: var(--warning-hover);
      transform: translateY(-3px) scale(1.05);
      box-shadow: var(--shadow-lg);
    }
    .btn-danger {
      background: var(--danger);
    }
    .btn-danger:hover {
      background: var(--danger-hover);
      transform: translateY(-3px) scale(1.05);
      box-shadow: var(--shadow-lg);
    }
    .card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow: auto;
      animation: slideInUp 0.8s ease-out;
      padding: 24px 0;
      position: relative;
      backdrop-filter: blur(10px);
    }
    .card::before {
      content: '';
      position: absolute;
      top: -50px; left: -50px;
      width: 100px; height: 100px;
      background: radial-gradient(circle, #3B82F6 40%, transparent 70%);
      opacity: 0.1;
      z-index: 0;
      pointer-events: none;
      animation: float 6s ease-in-out infinite;
    }
    .card::after {
      content: '';
      position: absolute;
      bottom: -30px; right: -30px;
      width: 60px; height: 60px;
      background: radial-gradient(circle, #FCD34D 40%, transparent 70%);
      opacity: 0.1;
      z-index: 0;
      pointer-events: none;
      animation: float 4s ease-in-out infinite reverse;
    }
    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
    }
    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 600px;
      position: relative;
      z-index: 1;
      animation: fadeInTable 1s ease-out;
    }
    th, td {
      padding: 16px 20px;
      border-bottom: 1px solid var(--border);
      text-align: left;
      font-size: 1rem;
      transition: all 0.3s ease;
    }
    th {
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      font-weight: 700;
      color: var(--muted);
      font-size: 0.95rem;
      letter-spacing: 0.025em;
      text-transform: uppercase;
      position: sticky;
      top: 0;
      z-index: 10;
    }
    tr {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      animation: slideInRow 0.6s ease-out;
      animation-fill-mode: both;
    }
    tr:nth-child(even) {
      animation-delay: 0.1s;
    }
    tr:nth-child(odd) {
      animation-delay: 0.2s;
    }
    tr:hover {
      transform: translateX(8px);
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
    }
    tr:hover td {
      background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    }
    @keyframes fadeInTable {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideInRow {
      from { 
        opacity: 0; 
        transform: translateX(-20px); 
      }
      to { 
        opacity: 1; 
        transform: translateX(0); 
      }
    }
    .actions {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }
    .actions a {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      padding: 8px 16px;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      position: relative;
      overflow: hidden;
      min-width: 80px;
    }
    .actions a::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
      transition: left 0.5s;
    }
    .actions a:hover::before {
      left: 100%;
    }
    .pagination-container {
      margin-top: 32px;
      text-align: center;
      position: relative;
      z-index: 1;
      animation: slideInUp 1s ease-out;
    }
    
    /* Pagination Styling */
    .pagination-container a,
    .pagination-container span {
      display: inline-block;
      padding: 12px 16px;
      margin: 0 4px;
      background: var(--card-bg);
      color: var(--primary);
      text-decoration: none;
      border: 2px solid var(--border);
      border-radius: var(--radius);
      font-weight: 600;
      font-size: 0.95rem;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: var(--shadow);
      position: relative;
      overflow: hidden;
    }
    
    .pagination-container a:hover {
      background: var(--primary);
      color: #fff;
      border-color: var(--primary);
      transform: translateY(-2px) scale(1.05);
      box-shadow: var(--shadow-lg);
    }
    
    .pagination-container a::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }
    
    .pagination-container a:hover::before {
      left: 100%;
    }
    
    .pagination-container .current,
    .pagination-container span {
      background: var(--primary);
      color: #fff;
      border-color: var(--primary);
      cursor: default;
    }
    
    .pagination-container .disabled {
      background: var(--muted);
      color: #fff;
      border-color: var(--muted);
      cursor: not-allowed;
      opacity: 0.6;
    }
    
    .pagination-container .disabled:hover {
      transform: none;
      box-shadow: var(--shadow);
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(18px);}
      to { opacity: 1; transform: translateY(0);}
    }
    
    /* Responsive Design */
    @media (max-width: 1024px) {
      .container { max-width: 95%; }
      .card { padding: 20px 0; }
      table { min-width: 100%; }
    }
    
    @media (max-width: 768px) {
      body { padding: 16px; }
      .container { max-width: 100%; }
      .header { 
        flex-direction: column; 
        align-items: flex-start; 
        gap: 16px; 
        margin-bottom: 20px;
      }
      h2 { font-size: 2rem; }
      .search-form { 
        flex-direction: column; 
        gap: 12px; 
        width: 100%;
      }
      .search-form input { width: 100%; }
      table { 
        font-size: 0.9rem; 
        min-width: 100%;
      }
      th, td { 
        padding: 12px 8px; 
      }
      .actions { 
        flex-direction: column; 
        gap: 6px;
      }
      .actions a { 
        width: 100%; 
        justify-content: center;
      }
    }
    
    @media (max-width: 480px) {
      body { padding: 12px; }
      h2 { font-size: 1.5rem; }
      .card { padding: 16px 0; }
      table { font-size: 0.85rem; }
      th, td { 
        padding: 8px 6px; 
      }
      .btn { 
        font-size: 0.9rem; 
        padding: 12px 16px; 
      }
      .search-form input {
        padding: 12px 14px;
        font-size: 0.9rem;
      }
    }
    /* Button ripple effect */
    .btn:active::after {
      content: '';
      position: absolute;
      left: 50%; top: 50%;
      width: 120%;
      height: 120%;
      background: rgba(59, 130, 246, 0.2);
      border-radius: 50%;
      transform: translate(-50%, -50%);
      z-index: 0;
      animation: ripple 0.4s linear;
    }
    @keyframes ripple {
      from { opacity: 0.7; }
      to { opacity: 0; }
    }
    
    /* Loading animation for empty state */
    .loading {
      display: inline-block;
      width: 20px;
      height: 20px;
      border: 3px solid var(--border);
      border-radius: 50%;
      border-top-color: var(--primary);
      animation: spin 1s ease-in-out infinite;
    }
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    
    /* Smooth scroll behavior */
    html {
      scroll-behavior: smooth;
    }
    
    /* Focus styles for accessibility */
    .btn:focus,
    .search-form input:focus {
      outline: 2px solid var(--primary);
      outline-offset: 2px;
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
              <a href="<?= base_url().'students/update/'.$s['id'] ?>" class="btn btn-warning">Edit</a>
              <a href="<?= base_url().'students/delete/'.$s['id'] ?>" class="btn btn-danger" onclick="return confirm('Delete student?')">Delete</a>
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
