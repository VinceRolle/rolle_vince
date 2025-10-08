<!DOCTYPE html>
<html>
<head>
    <title>Students List</title>
    <style>
        /* Luxury + modern theme to match auth pages */
        :root {
            --bg-start: #0f172a;
            --bg-end: #1f2937;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #6b7280;
            --gold-500: #f59e0b;
            --gold-600: #d97706;
            --gold-700: #b45309;
            --border: #e5e7eb;
            --ring: rgba(245, 158, 11, 0.35);
            --shadow: 0 10px 30px rgba(2, 6, 23, 0.25);
        }

        body {
            font-family: "Segoe UI", Roboto, Inter, Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(1200px 600px at 10% 10%, rgba(245, 158, 11, 0.08), transparent 40%),
                radial-gradient(1200px 600px at 80% 20%, rgba(234, 179, 8, 0.06), transparent 45%),
                linear-gradient(135deg, var(--bg-start), var(--bg-end));
            color: #111827;
        }

        /* Page container */
        body > * { box-sizing: border-box; }
        .page-wrap { max-width: 1100px; margin: 32px auto; padding: 0 20px; }

        h2 {
            text-align: center;
            margin: 12px 0 24px 0;
            font-size: 28px;
            background: linear-gradient(90deg, var(--gold-500), var(--gold-700));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: 0.3px;
        }

        a { text-decoration: none; color: var(--gold-600); }
        a:hover { color: var(--gold-700); text-decoration: underline; }

        p { margin-bottom: 15px; color: var(--text-muted); text-align: center; }

        /* Search bar */
        form { margin: 20px auto; text-align: center; }
        input[type="text"] {
            padding: 12px 14px;
            width: 320px;
            max-width: 90vw;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #ffffff;
            color: var(--text-main);
            outline: none;
            transition: border-color 180ms ease, box-shadow 180ms ease;
        }
        input[type="text"]:focus { border-color: var(--gold-500); box-shadow: 0 0 0 4px var(--ring); }

        button {
            padding: 12px 18px;
            background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
            border: none;
            border-radius: 12px;
            color: #111827;
            font-weight: 700;
            letter-spacing: 0.2px;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35);
            transition: transform 120ms ease, box-shadow 200ms ease, filter 200ms ease;
        }
        button:hover { filter: brightness(0.98); box-shadow: 0 10px 24px rgba(245, 158, 11, 0.45); transform: translateY(-1px); }
        button:active { transform: translateY(0); box-shadow: 0 6px 16px rgba(245, 158, 11, 0.35); }

        /* Table card */
        .table-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: transparent;
        }
        th, td {
            border-bottom: 1px solid var(--border);
            padding: 14px 12px;
            text-align: center;
        }
        th {
            background: linear-gradient(135deg, #111827, #1f2937);
            color: #f9fafb;
            font-weight: 700;
            letter-spacing: 0.3px;
        }
        tr:nth-child(even) td { background: #fafafa; }
        tr:hover td { background: #f5f5f4; }

        /* Buttons */
        .btn {
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 13px;
            color: white;
            margin: 2px;
            display: inline-block;
            box-shadow: 0 4px 10px rgba(0,0,0,0.12);
            transition: transform 120ms ease, filter 150ms ease;
        }
        .btn:hover { transform: translateY(-1px); filter: brightness(1.02); }
        .edit { background: #16a34a; }
        .delete { background: #ef4444; }
        .restore { background: #f59e0b; color: #111827; }
        .hard-delete { background: #b91c1c; }

        img { border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }

        /* Horizontal Pagination without bullets */
        .pagination ul {
            list-style: none;
            padding: 0;
            margin: 14px 0 0 0;
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .pagination li { display: inline-block; }

        .pagination li a,
        .pagination li span {
            display: inline-block;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--gold-600);
            background: #ffffff;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.06);
        }

        .pagination li a:hover {
            background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
            color: #111827;
            border-color: transparent;
        }

        .pagination li span.active {
            background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
            color: #111827;
            border: 1px solid transparent;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="page-wrap">
        <h2>Students List</h2>

    <p>
        <a href="/students/create">➕ Add New Student</a> | 
        <a href="/auth/logout">🚪 Logout</a>
    </p>

    <!-- Toggle Active / Deleted -->
    <p>
        <?php if (!empty($show_deleted)): ?>
            <a href="/students/get-all">👥 Show Active Students</a>
        <?php else: ?>
            <a href="/students/get-all?show=deleted">🗑️ Show Deleted Students</a>
        <?php endif; ?>
    </p>

    <!-- Search -->
    <form method="get" action="/students/get-all">
        <input type="hidden" name="show" value="<?= $show_deleted ? 'deleted' : 'active' ?>">
        <input type="text" name="search" placeholder="Search..." value="<?= htmlspecialchars($search ?? '') ?>">
        <input type="hidden" name="per_page" value="<?= $per_page ?>">
        <button type="submit">Search</button>
    </form>

    <div class="table-card">
    <table>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php $counter = 1; ?>
            <?php if (!empty($records)): ?>
                <?php foreach ($records as $r): ?>
                    <tr>
                        <td><?= $counter ?></td>
                        <td>
                            <?php if (!empty($r['photo'])): ?>
                                <img src="<?= $upload_url . htmlspecialchars($r['photo']) ?>" width="50" alt="Photo">
                            <?php else: ?>
                                No Photo
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($r['first_name'] . ' ' . $r['last_name']) ?></td>
                        <td><?= htmlspecialchars($r['email']) ?></td>
                        <td>
                            <?php if (empty($show_deleted)): ?>
                                <a class="btn edit" href="/students/update/<?= $r['id'] ?>">📝 Edit</a>
                                <a class="btn delete" href="/students/delete/<?= $r['id'] ?>" onclick="return confirm('Delete student?')">🗑️ Delete</a>
                            <?php else: ?>
                                <a class="btn restore" href="/students/restore/<?= $r['id'] ?>">♻️ Restore</a>
                                <a class="btn hard-delete" href="/students/hard_delete/<?= $r['id'] ?>" onclick="return confirm('Permanently delete this student?')">❌ Hard Delete</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php $counter++; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No records found.</td></tr>
            <?php endif; ?>
        </table>
        </div>

        <div class="pagination">
            <?= $pagination_links ?? '' ?>
        </div>
    </div>
</body>
</html>