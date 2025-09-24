<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students List</title>
  <link rel="stylesheet" href="/public/goat-theme.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
  </style>

  <div class="goat-table-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
      <h2 style="margin: 0; font-size: 2rem; font-weight: 800; color: var(--goat-primary); letter-spacing: -1px;">Students</h2>
      <a href="<?= site_url('students/create') ?>" style="background: var(--goat-primary); color: #fff; border-radius: 8px; padding: 0.7rem 1.5rem; font-weight: 600; text-decoration: none; box-shadow: 0 2px 8px 0 rgba(108, 78, 230, 0.08); display: flex; align-items: center; gap: 0.5rem;">
        <i class="fa fa-plus"></i> Add Student
      </a>
    </div>
    <form action="<?=site_url('students/get-all'); ?>" method="get" style="display: flex; gap: 0.7rem; align-items: center; margin-bottom: 1.5rem;">
      <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
      <input name="q" type="text" placeholder="Search students..." value="<?=html_escape($q);?>" style="flex:1; border-radius: 8px; border: 1.5px solid var(--goat-primary); padding: 0.7rem 1rem; font-size: 1rem;">
      <button type="submit" style="background: var(--goat-primary); color: #fff; border: none; border-radius: 8px; padding: 0.7rem 1.5rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.5rem;">
        <i class="fa fa-search"></i> Search
      </button>
    </form>
    <div style="overflow-x:auto;">
      <table class="goat-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th style="text-align:center;">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php if(isset($all) && !empty($all)): ?>
          <?php foreach($all as $s): ?>
          <tr>
            <td data-label="ID"><?=$s['id'];?></td>
            <td data-label="First Name"><?=$s['first_name'];?></td>
            <td data-label="Last Name"><?=$s['last_name'];?></td>
            <td data-label="Email"><?=$s['email'];?></td>
            <td data-label="Actions" style="text-align:center;">
              <div class="goat-action-icons">
                <a href="<?= site_url().'students/update/'.$s['id'] ?>" title="Edit"><i class="fa fa-pen-to-square"></i></a>
                <a href="<?= site_url().'students/delete/'.$s['id'] ?>" title="Delete" onclick="return confirm('Delete student?')"><i class="fa fa-trash"></i></a>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" style="text-align: center; padding: 40px; color: #aaa;">
              <i class="fa fa-user-slash" style="font-size:1.5rem; margin-bottom:0.5rem;"></i><br>No students found.
            </td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
    <?php if(isset($page) && !empty($page)): ?>
    <div class="pagination-container" style="margin-top:2rem;">
      <?= $page ?>
    </div>
    <?php endif; ?>
  </div>
</body>
</html>
</body>
</html>
