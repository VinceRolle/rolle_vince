<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
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
			width: 100%;
			max-width: 450px;
			padding: 20px;
			background: rgba(20, 24, 50, 0.85);
			border-radius: 24px;
			box-shadow: 0 8px 32px 0 rgba(0,255,255,0.18), 0 0px 40px 0 #00ffe7cc;
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
		h2 {
			text-align: center;
			margin: 0 0 32px 0;
			font-size: 2.6rem;
			font-weight: 900;
			color: #00ffe7;
			letter-spacing: -1.5px;
			text-shadow: 0 2px 24px #00ffe799, 0 0px 8px #6c4ee6cc;
			background: linear-gradient(90deg, #00ffe7 0%, #6c4ee6 100%);
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			background-clip: text;
			position: relative;
			z-index: 1;
		}
		label {
			display: block;
			margin-top: 8px;
			margin-bottom: 6px;
			color: #00ffe7;
			font-size: 14px;
			font-weight: 600;
			letter-spacing: 0.2px;
			position: relative;
			z-index: 1;
		}
		input[type="text"],
		input[type="email"],
		input[type="password"] {
			width: 100%;
			padding: 14px 18px;
			margin: 12px 0 20px 0;
			border: 2px solid #00ffe7cc;
			border-radius: 12px;
			background: rgba(255,255,255,0.98);
			color: #181c2f;
			font-size: 1.1rem;
			font-weight: 500;
			transition: all 0.3s ease;
			box-shadow: 0 2px 12px rgba(0,255,231,0.3);
			outline: none;
			position: relative;
			z-index: 1;
			box-sizing: border-box;
		}
		input:focus {
			border: 2px solid #ff00c8;
			outline: none;
			box-shadow: 0 4px 20px rgba(255,0,200,0.4);
			color: #ff00c8;
			transform: translateY(-1px);
		}
		button {
			width: 100%;
			padding: 12px 28px;
			background: linear-gradient(90deg, #00ffe7 0%, #6c4ee6 100%);
			border: none;
			border-radius: 12px;
			color: #181c2f;
			font-weight: 700;
			font-size: 1.08rem;
			cursor: pointer;
			box-shadow: 0 2px 12px 0 #00ffe799;
			transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
			text-shadow: 0 1px 8px #00ffe799;
			position: relative;
			z-index: 1;
		}
		button:hover {
			background: linear-gradient(90deg, #6c4ee6 0%, #00ffe7 100%);
			transform: translateY(-2px) scale(1.04);
			box-shadow: 0 4px 24px 0 #00ffe799;
		}
		button:active {
			transform: translateY(0);
			box-shadow: 0 2px 12px 0 #00ffe799;
		}
		p {
			text-align: center;
			margin-top: 20px;
			color: #00ffe7;
			position: relative;
			z-index: 1;
		}
		p a {
			color: #ff00c8;
			font-weight: 600;
			text-decoration: none;
			transition: color 0.2s;
		}
		p a:hover {
			color: #00ffe7;
			text-decoration: underline;
		}
		.error {
			color: #ff00c8;
			text-align: center;
			margin-bottom: 16px;
			background: rgba(255, 0, 200, 0.1);
			border: 2px solid #ff00c8;
			border-radius: 12px;
			padding: 12px 16px;
			position: relative;
			z-index: 1;
		}
	</style>
</head>
<body>
	<div class="container">
		<h2>Register</h2>

		<?php if (!empty($error)): ?>
			<p class="error"><?= htmlspecialchars($error) ?></p>
		<?php endif; ?>

		<form method="post" action="<?= site_url('auth/register') ?>">
			<input type="text" name="first_name" placeholder="First Name" required>
			<input type="text" name="last_name" placeholder="Last Name" required>
			<input type="email" name="email" placeholder="Email" required>
			<input type="password" name="password" placeholder="Password" required>
			<button type="submit">Register</button>
		</form>

		<p>Already have an account? <a href="<?= site_url('auth/login') ?>">Login</a></p>
	</div>
</body>
</html>
