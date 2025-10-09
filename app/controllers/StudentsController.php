<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentsController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->call->library('session');
        $this->call->helper('role');
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
            return;
        }
    }
    function get_all() {
        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 10;

        $all = $this->StudentsModel->page($q, $records_per_page, $page);
        $data['all'] = $all['records'];
        $data['user_role'] = $this->session->userdata('user_role');
        $total_rows = $all['total_rows'];
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap'); // or 'tailwind', or 'custom'
        $this->pagination->initialize($total_rows, $records_per_page, $page, site_url('students/get-all').'?q='.$q);
        $data['page'] = $this->pagination->paginate();
        $this->call->view('students/get_all', $data);
    }
     function create() {
        // Only admin can create new students
        if (!RoleHelper::is_admin()) {
            redirect('students/get-all');
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'last_name'  => $_POST['last_name'],
                'first_name' => $_POST['first_name'],
                'email'      => $_POST['email']
            ];
            $this->StudentsModel->insert($data);
            redirect('students');
        }
        $this->call->view('students/create');
    }
    function update($id) {
        // Only admin can update students
        if (!RoleHelper::is_admin()) {
            redirect('students/get-all');
            return;
        }
        
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
        // Only admin can delete students
        if (!RoleHelper::is_admin()) {
            redirect('students/get-all');
            return;
        }
        
        $this->StudentsModel->delete($id);
        redirect('students');
    }
    function soft_delete($id) {
        // Only admin can soft delete students
        if (!RoleHelper::is_admin()) {
            redirect('students/get-all');
            return;
        }
        
        $this->StudentsModel->soft_delete($id);
        redirect('students');
    }
}
