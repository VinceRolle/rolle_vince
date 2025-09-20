<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentsController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }
    function get_all() {
            $students = $this->StudentsModel->all();   
            $this->call->view('students/get_all', ['students' => $students]);
        }
     function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'last_name'  => $_POST['last_name'],
                'first_name' => $_POST['first_name'],
                'email'      => $_POST['email']
            ];
            $this->StudentsModel->insert($data);
            redirect('students');
        }
        $this->call->view('/students/create');
    }
    function update($id) {
        $student = $this->StudentsModel->find($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'last_name'  => $_POST['last_name'],
                'first_name' => $_POST['first_name'],
                'email'      => $_POST['email']
            ];
            $this->StudentsModel->update($id, $data);
            redirect('students');
        }
        $this->call->view('students/update', ['student' => $student]);
    }
    function delete($id) {
         $this->StudentsModel->delete($id);
         redirect('students');
    }
    function soft_delete($id) {
        $this->StudentsModel->soft_delete($id);
        redirect('students');
    }
}
