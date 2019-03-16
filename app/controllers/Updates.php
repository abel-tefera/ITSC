<?php
class Updates extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->contentModel = $this->model('Content');
    }

    public function editCertificate($id)
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Admin') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'id' => $id,
                    'name' => trim($_POST['name']),
                    'vendor' => trim($_POST['vendor']),
                    'description' => trim($_POST['description']),
                    'name_err' => '',
                    'vendor_err' => '',
                ];

                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter name of the certificate';
                } else {
                    if ($this->contentModel->findCertificateByName($data['name'])) {
                        if ($data['name'] != ($this->contentModel->getEntityById($id, 'Certificate'))->Name) {
                            $data['name_err'] = 'Name is already taken';
                        }
                    }}

                if (empty($data['vendor'])) {
                    $data['vendor_err'] = 'Please enter certificate\'s vendor';
                }

                if (empty($data['name_err']) && empty($data['vendor_err'])) {
                    if ($this->contentModel->editCertificate($data)) {
                        flash('info', 'You have successfully updated the certificate\'s data');
                        redirect('pages/view_certificates');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    $this->view('pages/editCertificate', $data);
                }

            } else {
                $certificate = $this->contentModel->getEntityById($id, 'Certificate');
                $data = [
                    'id' => $id,
                    'name' => $certificate->Name,
                    'vendor' => $certificate->Vendor,
                    'description' => $certificate->Description,
                    'name_err' => '',
                    'vendor_err' => '',
                ];
                $this->view('pages/editCertificate', $data);
            }} else {
            flash('info', 'You do not have permission', 'alert alert-danger');
            redirect('pages/index');
        }
    }

    public function editCourse($id)
    {

        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Admin') {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'id' => $id,
                    'name' => trim($_POST['name']),
                    'name_err' => '',
                    'description' => trim($_POST['description']),
                    'description_err' => '',
                    'duration' => trim($_POST['duration']),
                    'duration_err' => ''
                ];

                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter name of the course';
                }

                if (empty($data['description'])) {
                    $data['description_err'] = 'Please enter description for the course';
                }

                
                if (empty($data['duration'])) {
                    $data['duration_err'] = 'Please enter duration of the course';
                }
                
                if (empty($data['name_err']) && empty($data['description_err']) && empty($data['duration_err'])) {
                    if ($this->contentModel->editCourse($data)) {
                        // flash('info', 'You have successfully updated the course\'s data');
                        // redirect('pages/view_courses');
                        $ret = upload(null, $data['name']);
                        if ($ret[0] == 0){
                            flash('info', $ret[1]. ' Courses\' data updated');
                        }else{
                            $this->contentModel->uploadImage('Course', $ret[2], $data['name']);
                            flash('info', 'You have succesfully updated the course\'s data');
                        }
                        redirect('pages/view_courses');
                    } else {
                        flash('info', 'Something went wrong', 'alert alert-danger');
                        redirect('pages/view_courses');
                        // die('Something went wrong');
                    }
                } else {
                    $this->view('pages/editCourses', $data);
                }
            } else {
                $course = $this->contentModel->getEntityById($id, 'Course');
                $data = [
                    'id' => $id,
                    'name' => $course->Name,
                    'name_err' => '',
                    'description' => $course->Description,
                    'description_err' => '',
                ];

                $this->view('pages/editCourse', $data);
            }} else {
            flash('info', 'You do not have permission', 'alert alert-danger');
            redirect('pages/index');
        }

    }

    public function editTeacher($id)
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Admin') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'id' => $id,
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'name_err' => '',
                    'email_err' => '',
                ];

                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter email';
                } else {
                    if ($this->userModel->findUserByEmail($data['email'])[0]) {
                        if ($data['email'] != ($this->contentModel->getEntityById($id, 'Teacher'))->Email) {
                            $data['email_err'] = 'Email is already taken';
                        }
                    }
                }

                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter name';
                }

                if (empty($data['email_err']) && empty($data['name_err'])) {
                    if ($this->userModel->editTeacher($data)) {
                        $ret = upload($data['email'], null);
                        if ($ret[0] == 0){
                            flash('info', $ret[1]. ' Teacher\'s data updated');
                        }else{
                            $this->contentModel->uploadImage('Teacher', $ret[2], $data['email']);
                            flash('info', 'You have successfully updated the teacher\'s data');
                        }
                        redirect('pages/view_teachers');
                    } else {
                        flash('info', 'Something went wrong', 'alert alert-danger');
                        redirect('pages/view_teachers');                      }

                } else {
                    $this->view('users/editTeacher', $data);
                }

            } else {
                $teacher = $this->contentModel->getEntityById($id, 'Teacher');
                $data = [
                    'id' => $id,
                    'name' => $teacher->Name,
                    'email' => $teacher->Email,
                    'name_err' => '',
                    'email_err' => '',
                ];

                $this->view('users/editTeacher', $data);
            }} else {flash('info', 'You do not have permission', 'alert alert-danger');
            redirect('pages/index');
        }
    }

    public function editAdmin($id)
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Admin') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'id' => $id,
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'name_err' => '',
                    'email_err' => '',
                ];

                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter email';
                } else {
                    if ($this->userModel->findUserByEmail($data['email'])[0]) {
                        if ($data['email'] != ($this->contentModel->getEntityById($id, 'Admin'))->Email) {
                            $data['email_err'] = 'Email is already taken';
                        }
                    }
                }

                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter name';
                }

                if (empty($data['email_err']) && empty($data['name_err'])) {
                    if ($this->userModel->editAdmin($data)) {
                        if($_SESSION['user_id'] != $id){
                            flash('info', 'You have successfully updated the admin\'s data');
                            redirect('pages/view_admins');
                        }else{
                            logoutAdmin();
                        }
                    } else {
                        die('Something went wrong');
                    }

                } else {
                    $this->view('users/editAdmin', $data);
                }

            } else {
                $admin = $this->contentModel->getEntityById($id, 'Admin');
                $data = [
                    'id' => $id,
                    'name' => $admin->Name,
                    'email' => $admin->Email,
                    'name_err' => '',
                    'email_err' => '',
                ];

                $this->view('users/editAdmin', $data);
            }} else {flash('info', 'You do not have permission', 'alert alert-danger');
            redirect('pages/index');
        }
    }

    public function editStudent($id)
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Admin') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'id' => $id,
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'mobile_tel' => trim($_POST['mobile_tel']),
                    'office_tel' => trim($_POST['office_tel']),
                    'organization' => trim($_POST['organization']),
                    'job_title' => trim($_POST['job_title']),
                    'pobox' => trim($_POST['pobox']),
                    'name_err' => '',
                    'email_err' => '',
                    'mobile_tel_error' => '',
                ];

                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter email';
                } else {
                    if ($this->userModel->findUserByEmail($data['email'])[0]) {
                        if ($data['email'] != ($this->contentModel->getEntityById($id, 'Student'))->Email) {
                            $data['email_err'] = 'Email is already taken';
                        }

                    }
                }

                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter name';
                }

                if (empty($data['mobile_tel'])) {
                    $data['mobile_tel_err'] = 'Please enter mobile telephone number';
                }

                if (empty($data['email_err']) && empty($data['mobile_tel_err']) && empty($data['name_err'])) {

                    if ($this->userModel->editStudent($data)) {
                        // $this->uploadImage();
                        $ret = upload($data['email'], null);
                        if ($ret[0] == 0){
                            flash('info', $ret[1]. ' Student\'s data updated');
                        }else{
                            $this->contentModel->uploadImage('Student', $ret[2], $data['email']);
                            flash('info', 'You have succesfully updated the student\'s data');
                        }
                        redirect('pages/view_students');
                    } else {
                        flash('info', 'Something went wrong', 'alert alert-danger');
                        redirect('pages/view_students');
                    }

                } else {
                    $this->view('users/editStudent', $data);
                }

            } else {
                $student = $this->contentModel->getEntityById($id, 'Student');
                $data = [
                    'id' => $id,
                    'name' => $student->Name,
                    'email' => $student->Email,
                    'mobile_tel' => $student->MobileTel,
                    'office_tel' => $student->OfficeTel,
                    'organization' => $student->Organization,
                    'job_title' => $student->JobTitle,
                    'pobox' => $student->POBox,
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'mobile_tel_err' => '',
                ];

                $this->view('users/editStudent', $data);
            }} else {
            flash('info', 'You do not have permission', 'alert alert-danger');
            redirect('pages/index');
        }
    }

    public function deleteTeacher($id)
    {
        $this->remove('Teacher', $id);
        redirect('pages/view_teachers');
    }

    private function remove($entity, $id){
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Admin') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($this->contentModel->deleteEntity($entity, $id)) {
                    flash('info', $entity." removed");
                } else {
                    die("Something went wrong");
                }
            }
        } else {flash('info', 'You do not have permission', 'alert alert-danger');
            redirect('pages/index');
        }
    }

    public function deleteStudent($id)
    {
        $this->remove('Student', $id);
        redirect('pages/view_students');
    }

    public function deleteCertificate($id)
    {
        $this->remove('Certificate', $id);
        redirect('pages/view_certificates');
    }

    public function deleteCourse($id)
    {
        $this->remove('Course', $id);
        redirect('pages/view_courses');
    }

    public function deleteAdmin($id)
    {
        if($_SESSION['user_id'] != $id){
            $this->remove('Admin', $id);
            redirect('pages/view_admins');
        }else{
            flash('info', 'You cannot delete your own account', 'alert alert-danger');
            redirect('pages/index');
        }

    }

}
