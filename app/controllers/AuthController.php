<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller {

	public function __construct()
	{
		parent::__construct();
		$this->call->library('session');
		$this->call->library('form_validation');
	}

	public function login()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->form_validation->name('email')->required()->valid_email();
			$this->form_validation->name('password')->required()->min_length(6);

			if ($this->form_validation->run()) {
				$email = trim($_POST['email']);
				$password = trim($_POST['password']);

				$user = $this->StudentsModel->find_by_email($email);

				if ($user) {
					$valid = isset($user['password']) && (password_verify($password, $user['password']) || $user['password'] === $password);
					if ($valid) {
						$this->session->set_userdata('logged_in', true);
						$this->session->set_userdata('user_id', $user['id']);
						$this->session->set_userdata('user_role', $user['role'] ?? 'student');
						redirect('students/get-all');
						return;
					}
					$error = 'Incorrect password.';
				} else {
					$error = 'Email not found.';
				}
				$this->call->view('auth/login', ['error' => $error]);
				return;
			}
		}
		$this->call->view('auth/login');
	}

	public function register()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->form_validation->name('first_name')->required();
			$this->form_validation->name('last_name')->required();
			$this->form_validation->name('email')->required()->valid_email();
			$this->form_validation->name('password')->required()->min_length(6);

			if ($this->form_validation->run()) {
				$email = trim($_POST['email']);
				$password = trim($_POST['password']);

				// Check if email already exists
				if ($this->StudentsModel->find_by_email($email)) {
					$error = 'Email already exists. Please use a different email address.';
					$this->call->view('auth/register', ['error' => $error]);
					return;
				}

				try {
					$this->StudentsModel->create_account([
						'first_name' => $_POST['first_name'],
						'last_name'  => $_POST['last_name'],
						'email'      => $email,
						'password'   => $password
					]);

					redirect('auth/login');
					return;
				} catch (Exception $e) {
					// Handle database constraint violations
					if (strpos($e->getMessage(), 'Duplicate entry') !== false && strpos($e->getMessage(), 'uq_students_email') !== false) {
						$error = 'Email already exists. Please use a different email address.';
					} else {
						$error = 'Registration failed. Please try again.';
					}
					$this->call->view('auth/register', ['error' => $error]);
					return;
				}
			}
		}
		$this->call->view('auth/register');
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_role');
		redirect('auth/login');
	}
}
