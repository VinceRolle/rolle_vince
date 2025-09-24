<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Student</title>
  <style>
    :root {
      --bg: linear-gradient(135deg, #3B82F6 0%, #FCD34D 100%);
      --card-bg: #ffffff;
      --primary: #3B82F6;
      --primary-hover: #2563eb;
      --secondary: #FCD34D;
      --secondary-hover: #f59e0b;
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
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      color: var(--text);
      transition: all 0.3s ease;
      animation: fadeInBody 0.8s ease-out;
    }
    .container {
      width: 100%;
      max-width: 480px;
      padding: 20px;
      animation: slideInUp 0.6s ease-out;
    }
    .card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 40px 32px;
      animation: slideInUp 0.8s ease-out;
      position: relative;
      overflow: hidden;
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
    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
    }
    .header {
      text-align: center;
      margin-bottom: 32px;
      position: relative;
      z-index: 1;
      animation: slideInDown 0.7s ease-out;
    }
    .header h2 {
      margin: 0;
      font-size: 2.5rem;
      font-weight: 800;
      color: var(--primary);
      letter-spacing: -0.025em;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      animation: pulse 2s infinite;
    }
    .header p {
      margin: 8px 0 0;
      font-size: 1rem;
      color: var(--muted);
      font-weight: 500;
      animation: slideInDown 0.9s ease-out;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 24px;
      position: relative;
      z-index: 1;
      animation: slideInUp 1s ease-out;
    }
    input {
      padding: 16px 20px;
      border-radius: var(--radius);
      border: 2px solid var(--border);
      font-size: 1rem;
      font-weight: 500;
      background: var(--input-bg);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      color: var(--text);
      box-shadow: var(--shadow);
      position: relative;
    }
    input:focus {
      outline: none;
      border-color: var(--primary);
      background: var(--input-focus);
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1), var(--shadow-lg);
      transform: translateY(-2px);
    }
    input::placeholder {
      color: var(--muted);
      transition: color 0.3s ease;
    }
    input:focus::placeholder {
      color: var(--primary);
      opacity: 0.7;
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
    button {
      background: var(--primary);
      color: #fff;
      padding: 16px 24px;
      border: none;
      border-radius: var(--radius);
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: var(--shadow);
      letter-spacing: 0.025em;
      position: relative;
      z-index: 1;
      overflow: hidden;
      animation: slideInUp 1.2s ease-out;
    }
    button::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }
    button:hover::before {
      left: 100%;
    }
    button:hover, button:focus {
      background: var(--primary-hover);
      transform: translateY(-3px) scale(1.05);
      box-shadow: var(--shadow-lg);
    }
    .back-link {
      display: inline-block;
      margin-top: 24px;
      font-size: 1rem;
      font-weight: 500;
      text-decoration: none;
      color: var(--muted);
      transition: all 0.3s ease;
      position: relative;
      z-index: 1;
      animation: slideInUp 1.4s ease-out;
    }
    .back-link:hover {
      color: var(--primary);
      text-decoration: underline;
      transform: translateY(-2px);
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(18px);}
      to { opacity: 1; transform: translateY(0);}
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
      .container { 
        max-width: 95%; 
        padding: 16px;
      }
      .card { 
        padding: 32px 24px; 
      }
      .header h2 { 
        font-size: 2rem; 
      }
      input, button { 
        font-size: 1rem; 
        padding: 14px 18px;
      }
    }
    
    @media (max-width: 480px) {
      .container { 
        padding: 12px;
      }
      .card { 
        padding: 24px 20px; 
      }
      .header h2 { 
        font-size: 1.8rem; 
      }
      input, button { 
        font-size: 0.95rem; 
        padding: 12px 16px;
      }
      form {
        gap: 20px;
      }
    }
    
    /* Button ripple effect */
    button:active::after {
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
    
    /* Focus styles for accessibility */
    button:focus,
    input:focus {
      outline: 2px solid var(--primary);
      outline-offset: 2px;
    }
    
    /* Smooth scroll behavior */
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="header">
        <h2>Edit Student</h2>
      </div>
      <form method="POST">
        <input type="text" name="first_name" value="<?= $student['first_name'] ?>" required>
        <input type="text" name="last_name" value="<?= $student['last_name'] ?>" required>
        <input type="email" name="email" value="<?= $student['email'] ?>" required>
        <button type="submit">Update Student</button>
      </form>
      <a class="back-link" href="<?= site_url().'students' ?>">Back to Students</a>
    </div>
  </div>
</body>
</html>
