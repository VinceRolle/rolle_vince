<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style>
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
			background:
				radial-gradient(1200px 600px at 10% 10%, rgba(245, 158, 11, 0.08), transparent 40%),
				radial-gradient(1200px 600px at 80% 20%, rgba(234, 179, 8, 0.06), transparent 45%),
				linear-gradient(135deg, var(--bg-start), var(--bg-end));
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			padding: 20px;
		}
		.container {
			background: var(--card-bg);
			padding: 32px;
			border-radius: 16px;
			box-shadow: var(--shadow);
			width: 360px;
			border: 1px solid var(--border);
			backdrop-filter: saturate(1.1);
		}
		h2 {
			text-align: center;
			margin-bottom: 24px;
			font-size: 24px;
			line-height: 1.2;
			background: linear-gradient(90deg, var(--gold-500), var(--gold-700));
			-webkit-background-clip: text;
			background-clip: text;
			color: transparent;
			letter-spacing: 0.3px;
		}
		input[type="email"],
		input[type="password"] {
			width: 100%;
			padding: 12px 14px;
			margin: 8px 0 12px 0;
			border: 1px solid var(--border);
			border-radius: 12px;
			background: #ffffff;
			color: var(--text-main);
			transition: border-color 180ms ease, box-shadow 180ms ease, transform 120ms ease;
			outline: none;
		}
		.input-group { position: relative; }
		input:focus {
			border-color: var(--gold-500);
			box-shadow: 0 0 0 4px var(--ring);
		}
		button {
			width: 100%;
			padding: 12px 16px;
			background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
			border: none;
			border-radius: 12px;
			color: #111827;
			font-weight: 700;
			letter-spacing: 0.3px;
			cursor: pointer;
			box-shadow: 0 20px 20px rgba(245, 158, 11, 0.35);
			transition: transform 120ms ease, box-shadow 100ms ease, filter 100ms ease;
		}
		button:hover {
			filter: brightness(0.98);
			box-shadow: 0 10px 24px rgba(245, 158, 11, 0.45);
			transform: translateY(-1px);
			background: linear-gradient(135deg, var(--gold-600), var(--gold-700));
			color: #111827;
		}
		button:active {
			transform: translateY(0);
			box-shadow: 0 6px 16px rgba(245, 158, 11, 0.35);
		}
		p {
			text-align: center;
			margin-top: 16px;
			color: var(--text-muted);
		}
		p a {
			color: var(--gold-600);
			font-weight: 600;
			text-decoration: none;
		}
		p a:hover {
			color: var(--gold-700);
			text-decoration: underline;
		}
		.error {
			color: #dc2626;
			text-align: center;
			margin-bottom: 12px;
			background: #fee2e2;
			border: 1px solid #fecaca;
			border-radius: 10px;
			padding: 8px 10px;
		}
	</style>
</head>
<body>
	<div class="container">
		<h2>Login</h2>

		<?php if (!empty($error)): ?>
			<p class="error"><?= htmlspecialchars($error) ?></p>
		<?php endif; ?>

		<form method="post" action="<?= site_url('auth/login') ?>">
			<input type="email" name="email" placeholder="👨‍🎓 Email" required>
			<div class="input-group">
				<input type="password" name="password" placeholder="🔐 Password" required>
			</div>
			<button type="submit">Login</button>
		</form>

		<p>Don’t have an account? <a href="<?= site_url('auth/register') ?>">Register</a></p>
	</div>
</body>
</html>
