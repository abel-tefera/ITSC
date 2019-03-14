<?php
class Pages extends Controller
{
    public function __construct()
    {
        $this->Model = $this->model('Content');
    }

    public function index()
    {
        $result = $this->Model->fetch_courses();
        $data = [
            'title' => 'Home',
            'description' => 'Simple DB system built for ITSC academy',
            'rows' => $result[1]
        ];
        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'ITSC DB System',
            'description' => 'Simple DB system built for ITSC academy',
        ];

        $this->view('pages/about', $data);
    }

    public function add_certificate()
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Admin') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'name' => trim($_POST['name']),
                    'vendor' => trim($_POST['vendor']),
                    'description' => trim($_POST['description']),
                    'name_err' => '',
                    'vendor_err' => '',
                ];

                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter name of the certificate';
                }else {
                    if ($this->Model->findCertificateByName($data['name'])) {
                            $data['name_err'] = 'Name is already taken';
                    }
                }

                if (empty($data['vendor'])) {
                    $data['vendor_err'] = 'Please enter certificate\'s vendor';
                }

                if (empty($data['name_err']) && empty($data['vendor_err'])) {
                    if ($this->Model->add_certificate($data)) {
                        flash('add_success', 'You have successfully added the certificate');
                        redirect('pages/index');
                    } else {
                        flash('info', 'Something went wrong', 'alert alert-danger');
                        redirect('pages/index');                    }
                } else {
                    $this->view('pages/certificates', $data);
                }

            } else {
                $data = [
                    'name' => '',
                    'vendor' => '',
                    'description' => '',
                    'name_err' => '',
                    'vendor_err' => '',
                ];

                $this->view('pages/certificates', $data);
            }} else {
            flash('info', 'You do not have permission', 'alert alert-danger');
            redirect('pages/index');
        }
    }

    public function add_course()
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Admin') {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'name' => trim($_POST['name']),
                    'name_err' => '',
                    'description' => trim($_POST['description']),
                    'description_err' => '',
                ];

                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter name of the course';
                }

                if (empty($data['description'])) {
                    $data['description_err'] = 'Please enter description for the course';
                }

                if (empty($data['name_err']) && empty($data['description_err'])) {
                    if ($this->Model->add_course($data)) {
                        // flash('info', 'You have successfully added the course');
                        $ret = upload(null, $data['name']);
                        if ($ret[0] == 0){
                            flash('info', $ret[1]. ' Course has been registered');
                        }else{
                            $this->Model->uploadImage('Course', $ret[2], $data['name']);
                            flash('info', 'You have successfully added the course');
                        }
                        redirect('pages/index');
                    } else {
                        flash('info', 'Something went wrong', 'alert alert-danger');
                        redirect('pages/index');                    }
                } else {
                    $this->view('pages/courses', $data);
                }
            } else {
                $data = [
                    'name' => '',
                    'name_err' => '',
                    'description' => '',
                    'description_err' => '',
                ];

                $this->view('pages/courses', $data);
            }} else {
            flash('info', 'You do not have permission', 'alert alert-danger');
            redirect('pages/index');
        }
    }

    public function view_courses()
    {
        $result = $this->Model->fetch_courses();
        $this->generateTable($result, 'Courses');
    }

    // public function view_courses_index()
    // {
    //     $result = $this->Model->fetch_courses();
    //     // $this->generateTable($result, 'Courses');
    //     $data = [
    //         'rows' => $result[1]
    //     ];
    // }

    public function view_certificates()
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Admin') {

        $result = $this->Model->fetch_certificates();
        $this->generateTable($result, 'Certificates');
        }else{
            flash('info', 'You do not have permission', 'alert alert-danger');
            redirect('pages/index');
        }
    }

    public function view_students(){
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Admin') {

        $result = $this->Model->fetch_students();
        $this->generateTable($result, 'Students');
        }else{
            flash('info', 'You do not have permission', 'alert alert-danger');
            redirect('pages/index');
        }
    }

    public function view_teachers(){
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Admin') {

        $result = $this->Model->fetch_teachers();
        $this->generateTable($result, 'Teachers');}else{
            flash('info', 'You do not have permission', 'alert alert-danger');
            redirect('pages/index');
        }

    }

    public function view_admins(){
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Admin') {

        $result = $this->Model->fetch_admins();
        $this->generateTable($result, 'Admins');}else{
            flash('info', 'You do not have permission', 'alert alert-danger');
            redirect('pages/index');
        }
    }

    private function generateTable($result, $header){
        $data = [
            'header' => $header,
            'fields' => $result[0],
            'rows' => $result[1]
        ];
        $this->view('pages/tables', $data);
    }

    // public function modalStudent(){
    //     $result = $this->Model->fetch_admins();

    // }


}
