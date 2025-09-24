<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Student</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    :root {
      --bg: linear-gradient(135deg, #0f2027 0%, #2c5364 100%);
      --card-bg: linear-gradient(135deg, #181c2f 60%, #2c5364 100%);
      --primary: #00ffe7;
      --primary-hover: #6c4ee6;
      --border: #00ffe7cc;
      --text: #00ffe7;
      --muted: #6B7280;
      --radius: 12px;
      --input-bg: rgba(255,255,255,0.10);
      --input-focus: #232946;
      --shadow: 0 4px 32px 0 #00ffe799;
      --shadow-lg: 0 8px 32px 0 #00ffe799;
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
      border: 2px solid var(--border);
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
      text-shadow: 0 2px 12px #00ffe799, 0 0px 8px #6c4ee6cc;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 24px;
      position: relative;
      z-index: 1;
      animation: slideInUp 1s ease-out;
      align-items: center;
    }
    .input-icon, input, button {
      width: 100%;
      max-width: 350px;
    }
    .input-icon {
      position: relative;
      display: flex;
      align-items: center;
    }
    .input-icon i {
      position: absolute;
      left: 16px;
      color: #00ffe7;
      font-size: 1.1em;
      pointer-events: none;
      opacity: 0.8;
    }
    input {
      padding: 16px 20px 16px 44px;
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
      background: linear-gradient(90deg, #00ffe7 0%, #6c4ee6 100%);
      color: #181c2f;
      padding: 16px 24px 16px 44px;
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
      display: flex;
      align-items: center;
      gap: 10px;
      justify-content: center;
    }
    button i {
      position: absolute;
      left: 18px;
      font-size: 1.2em;
      color: #6c4ee6;
      opacity: 0.9;
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
        <h2>Add Student</h2>
      </div>
      <form method="POST">
        <div class="input-icon"><i class="fa fa-user"></i><input type="text" name="first_name" placeholder="First Name" required></div>
        <div class="input-icon"><i class="fa fa-user-astronaut"></i><input type="text" name="last_name" placeholder="Last Name" required></div>
        <div class="input-icon"><i class="fa fa-envelope"></i><input type="email" name="email" placeholder="Email" required></div>
        <button type="submit"><i class="fa fa-floppy-disk"></i>Save Student</button>
      </form>
      <a class="back-link" href="<?= site_url() ?>students">Back to Students</a>
    </div>
  </div>
</body>
</html>