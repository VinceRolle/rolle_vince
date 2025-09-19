<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentsController extends Controller {

    public function __construct()
    {
        parent::__construct();
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

        $all = $this->StudentsModel->get_all($q, $records_per_page, $page);
        $data['all'] = $all['records'];
        $total_rows = $all['total_rows'];
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap'); // or 'tailwind', or 'custom'
        $this->pagination->initialize($total_rows, $records_per_page, $page, site_url('students').'?q='.$q);
        $data['page'] = $this->pagination->paginate();
        $this->view('students/get_all', $data);
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
        $this->call->view('students/create');
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
