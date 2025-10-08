<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class StudentsController extends Controller
{
    private $upload_dir;
    private $upload_url;

    public function __construct()
    {
        parent::__construct();
        $this->call->library('pagination');
        $this->call->library('session');

        // ✅ Absolute path sa server (relative mula sa controller directory)
        $this->upload_dir = realpath(__DIR__ . '/../../public/uploads') . '/';

        // ✅ Public URL na gagamitin sa browser
        $this->upload_url = BASE_URL . 'public/uploads/';

        // Gumawa ng uploads folder kung wala pa
        if (!is_dir($this->upload_dir)) {
            mkdir($this->upload_dir, 0777, true);
        }

        // Require login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $this->pagination->set_theme('custom');
        $this->pagination->set_custom_classes([
            'nav' => 'pagination-nav',
            'ul' => 'pagination',
            'li' => 'pagination-item',
            'a' => 'pagination-link',
            'active' => 'active'
        ]);
    }
    /** GET ALL STUDENTS */
    public function get_all($page = 1)
    {
        $per_page = isset($_GET['per_page']) ? (int) $_GET['per_page'] : 10;
        $allowed_per_page = [10, 25, 50, 100];
        if (!in_array($per_page, $allowed_per_page)) $per_page = 10;

        $search       = isset($_GET['search']) ? trim($_GET['search']) : null;
        $show_deleted = isset($_GET['show']) && $_GET['show'] === 'deleted';

        $offset = ($page - 1) * $per_page;
        $limit_clause = "LIMIT {$offset}, {$per_page}";

        if ($show_deleted) {
            $total_rows = $this->StudentsModel->count_deleted_records($search);
            $base_url   = '/students/get-all?show=deleted';
            $records    = $this->StudentsModel->get_deleted_with_pagination($limit_clause, $search);
        } else {
            $total_rows = $this->StudentsModel->count_all_records($search);
            $base_url   = '/students/get-all';
            $records    = $this->StudentsModel->get_records_with_pagination($limit_clause, $search);
        }

        $pagination_data = $this->pagination->initialize($total_rows, $per_page, $page, $base_url, 5);

        $data = [
            'records'          => $records,
            'total_records'    => $total_rows,
            'per_page'         => $per_page,
            'page'             => $page,
            'pagination_data'  => $pagination_data,
            'pagination_links' => $this->pagination->paginate(),
            'search'           => $search,
            'show_deleted'     => $show_deleted,
            'upload_url'       => $this->upload_url
        ];

        $this->call->view('ui/get_all', $data);
    }

/** CREATE STUDENT */
public function create()
{
    $this->call->library('form_validation');

    $error_message = null; // Variable para sa error

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->form_validation->name('first_name')->required();
        $this->form_validation->name('last_name')->required();
        $this->form_validation->name('email')->required()->valid_email();
        $this->form_validation->name('password')->required()->min_length(6);

        if ($this->form_validation->run()) {
            $photo = null;

            if (isset($_FILES['photo']) && is_uploaded_file($_FILES['photo']['tmp_name'])) {
                $this->call->library('upload', $_FILES['photo']);

                $this->upload->set_dir($this->upload_dir)
                             ->allowed_extensions(['jpg','jpeg','png'])
                             ->allowed_mimes(['image/jpeg','image/png'])
                             ->max_size(2)
                             ->is_image();

                if ($this->upload->do_upload()) {
                    $photo = $this->upload->get_filename();
                } else {
                    error_log("Upload Error: " . implode(', ', $this->upload->get_errors()));
                }
            }

            $data = [
                'first_name' => $_POST['first_name'],
                'last_name'  => $_POST['last_name'],
                'email'      => $_POST['email'],
                'password'   => $_POST['password'],
                'photo'      => $photo
            ];

            try {
                $this->StudentsModel->insert($data);
                redirect('students/get-all');
            } catch (PDOException $e) {
                // Check if it's a duplicate entry error
                if (str_contains($e->getMessage(), 'Duplicate entry')) {
                    $error_message = "The email is already taken.";
                } else {
                    $error_message = "Something went wrong: " . $e->getMessage();
                }
            }
        }
    }

    $this->call->view('ui/create', ['error_message' => $error_message]);
}


    /** UPDATE STUDENT */
    public function update($id)
    {
        $this->call->library('form_validation');
        $contents = $this->StudentsModel->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->name('first_name')->required();
            $this->form_validation->name('last_name')->required();
            $this->form_validation->name('email')->required()->valid_email();

            if ($this->form_validation->run()) {
                $photo = $contents['photo'];

                if (isset($_FILES['photo']) && is_uploaded_file($_FILES['photo']['tmp_name'])) {
                    // Load upload library
                    $this->call->library('upload', $_FILES['photo']);

                    $this->upload->set_dir($this->upload_dir)
                                 ->allowed_extensions(['jpg','jpeg','png'])
                                 ->allowed_mimes(['image/jpeg','image/png'])
                                 ->max_size(2)
                                 ->is_image();

                    if ($this->upload->do_upload()) {
                        $photo = $this->upload->get_filename();
                    } else {
                        error_log("Upload Error: " . implode(', ', $this->upload->get_errors()));
                    }
                }

                $data = [
                    'first_name' => $_POST['first_name'],
                    'last_name'  => $_POST['last_name'],
                    'email'      => $_POST['email'],
                    'password'   => !empty($_POST['password']) ? $_POST['password'] : $contents['password'],
                    'photo'      => $photo
                ];

                $this->StudentsModel->update($id, $data);
                redirect('students/get-all');
            }
        }

        $this->call->view('ui/update', ['user' => $contents, 'upload_url' => $this->upload_url]);
    }

    /** SOFT DELETE */
    public function delete($id)
    {
        $this->StudentsModel->soft_delete($id);
        redirect('students/get-all');
    }

    /** HARD DELETE */
    public function hard_delete($id)
    {
        $this->StudentsModel->hard_delete($id);
        redirect('students/get-all?show=deleted');
    }

    /** RESTORE */
    public function restore($id)
    {
        $this->StudentsModel->restore($id);
        redirect('students/get-all?show=deleted');
    }
}
