<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        /* Luxury + modern theme */
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
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 32px 16px;
        }
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 30px;
            width: 100%;
            max-width: 560px;
        }
        h2 {
            color:#d97706 ;
            margin: 0 0 16px 0;
            text-align: center;
            font-size: 26px;
            background: linear-gradient(90deg, var(--gold-500), var(--gold-700));
            -webkit-background-clip: text;
            background-clip: text;
            letter-spacing: 0.3px;
        }
        label {
            display: inline-block;
            font-weight: 600;
            color: var(--text-muted);
            margin: 8px 0 6px 0;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="file"] {
            padding: 12px 14px;
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 12px;
            margin-bottom: 12px;
            background: #ffffff;
            color: var(--text-main);
            outline: none;
            transition: border-color 180ms ease, box-shadow 180ms ease;
        }
        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, input[type="file"]:focus {
            border-color: var(--gold-500);
            box-shadow: 0 0 0 4px var(--ring);
        }
        .photo-preview { margin: 10px 0; }
        .photo-preview img { border: 1px solid var(--border); border-radius: 8px; padding: 3px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
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
        .back-link { display: block; text-align: center; margin-top: 14px; color: var(--gold-600); text-decoration: none; font-weight: 600; }
        .back-link:hover { color: var(--gold-700); text-decoration: underline; }
    </style>
</head>
<body>
    <div class="card">
       <h2>✏️ Edit Student</h2>


        <form method="post" action="/students/update/<?= (int) $user['id'] ?>" enctype="multipart/form-data">
            <label>First Name:</label><br>
            <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required><br>

            <label>Last Name:</label><br>
            <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required><br>

            <label>Email:</label><br>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br>

            <label>Password (leave blank to keep current):</label><br>
            <input type="password" name="password"><br>

            <label>Photo:</label><br>
            <?php if (!empty($user['photo'])): ?>
                <div class="photo-preview">
                    <img src="<?= $upload_url . htmlspecialchars($user['photo']) ?>" width="80" alt="Student Photo">
                </div>
            <?php endif; ?>
            <input type="file" name="photo" accept="image/*"><br><br>

            <button type="submit">Update</button>
        </form>

        <a class="back-link" href="/students/get-all">⬅️ Back to List</a>
    </div>
</body>
</html>
