<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: AuthController
 * 
 * Automatically generated via CLI.
 */
class AuthController extends Controller {
    public function __construct()
    {
        parent::__construct();
         $this->call->library('session');
         $this->call->library('form_validation');
    }

    /** LOGIN */
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
                    if ($user['password'] === $password) { // TIP: gawing password_hash() later
                        $this->session->set_userdata('logged_in', true);
                        $this->session->set_userdata('user_id', $user['id']);
                        redirect('students/get-all');
                        return;
                    } else {
                        $error = "Incorrect password.";
                    }
                } else {
                    $error = "Email not found.";
                }

                $this->call->view('auth/login', ['error' => $error]);
                return;
            }
        }

        $this->call->view('auth/login');
    }

    /** REGISTER */
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

                if ($this->StudentsModel->find_by_email($email)) {
                    $error = "Email already exists.";
                    $this->call->view('auth/register', ['error' => $error]);
                    return;
                }

                $this->StudentsModel->create_account([
                    'first_name' => $_POST['first_name'],
                    'last_name'  => $_POST['last_name'],
                    'email'      => $email,
                    'password'   => $password
                ]);

                redirect('auth/login');
            }
        }

        $this->call->view('auth/register');
    }

    /** LOGOUT */
    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        redirect('auth/login');
    }
}