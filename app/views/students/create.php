<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Student</title>
  <style>
    :root {
      --bg: linear-gradient(135deg, #ffb347 0%, #ffcc80 100%);
      --card-bg: #fff6e9;
      --primary: #ff7043;
      --primary-hover: #ff9800;
      --border: #ffd699;
      --text: #4e260e;
      --muted: #b85c38;
      --radius: 18px;
      --input-bg: #fffbe6;
      --input-focus: #fff;
      --shadow: 0 8px 32px 0 rgba(255, 140, 0, 0.18);
      font-family: 'Segoe UI', system-ui, sans-serif;
    }
    body {
      margin: 0;
      background: var(--bg);
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      color: var(--text);
      transition: background 0.4s;
    }
    .container {
      width: 100%;
      max-width: 480px;
      padding: 20px;
    }
    .card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 36px 28px;
      animation: fadeIn 0.5s;
      position: relative;
      overflow: hidden;
    }
    .card::before {
      content: '';
      position: absolute;
      top: -60px; left: -60px;
      width: 120px; height: 120px;
      background: radial-gradient(circle, #ff9800 40%, transparent 70%);
      opacity: 0.18;
      z-index: 0;
      pointer-events: none;
    }
    .header {
      text-align: center;
      margin-bottom: 26px;
      position: relative;
      z-index: 1;
    }
    .header h2 {
      margin: 0;
      font-size: 2rem;
      font-weight: 700;
      color: var(--primary);
      letter-spacing: 1px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 20px;
      position: relative;
      z-index: 1;
    }
    input {
      padding: 14px 16px;
      border-radius: var(--radius);
      border: 1px solid var(--border);
      font-size: 1rem;
      background: var(--input-bg);
      transition: all 0.2s;
      color: var(--text);
      box-shadow: 0 2px 8px rgba(255, 140, 0, 0.07);
    }
    input:focus {
      outline: none;
      border-color: var(--primary);
      background: var(--input-focus);
      box-shadow: 0 0 0 4px rgba(255, 140, 0, 0.13);
    }
    button {
      background: var(--primary);
      color: #fff;
      padding: 14px;
      border: none;
      border-radius: var(--radius);
      font-size: 1.08rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
      box-shadow: 0 4px 14px rgba(255, 140, 0, 0.22);
      letter-spacing: 0.5px;
      position: relative;
      z-index: 1;
    }
    button:hover, button:focus {
      background: var(--primary-hover);
      transform: translateY(-2px) scale(1.04);
      box-shadow: 0 6px 18px rgba(255, 140, 0, 0.32);
    }
    .back-link {
      display: inline-block;
      margin-top: 20px;
      font-size: 1rem;
      text-decoration: none;
      color: var(--muted);
      transition: color 0.2s;
      position: relative;
      z-index: 1;
    }
    .back-link:hover {
      color: var(--primary);
      text-decoration: underline;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(18px);}
      to { opacity: 1; transform: translateY(0);}
    }
    @media (max-width: 600px) {
      .card { padding: 18px 8px; }
      .header h2 { font-size: 1.3rem; }
      input, button { font-size: 0.98rem; }
    }
    /* Interactive input animation */
    input:focus::placeholder {
      color: #ff9800;
      opacity: 0.7;
      transition: color 0.2s;
    }
    /* Button ripple effect */
    button:active::after {
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
  <div class="container">
    <div class="card">
      <div class="header">
        <h2>Add Student</h2>
      </div>
      <form method="POST">
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Save Student</button>
      </form>
      <a class="back-link" href="<?= base_url() ?>students">Back to Students</a>
    </div>
  </div>
</body>
</html>