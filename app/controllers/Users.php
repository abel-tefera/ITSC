<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->contentModel = $this->model('Content');
    }

    public function registerStudent()
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Admin') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'mobile_tel' => trim($_POST['mobile_tel']),
                    'office_tel' => trim($_POST['office_tel']),
                    'organization' => trim($_POST['organization']),
                    'job_title' => trim($_POST['job_title']),
                    'pobox' => trim($_POST['pobox']),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'mobile_tel_error' => '',
                ];

                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter email';
                } else {
                    if ($this->userModel->findUserByEmail($data['email'])[0]) {
                        $data['email_err'] = 'Email is already taken';
                    }
                }

                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter name';
                }

                if (empty($data['mobile_tel'])) {
                    $data['mobile_tel_err'] = 'Please enter mobile telephone number';
                }

                if (empty($data['password'])) {
                    $data['password_err'] = 'Please enter password';
                } elseif (strlen($data['password']) < 6) {
                    $data['password_err'] = 'Password must be at least 6 characters';
                }

                if (empty($data['confirm_password'])) {
                    $data['confirm_password_err'] = 'Please confirm password';
                } else {
                    if ($data['password'] != $data['confirm_password']) {
                        $data['confirm_password_err'] = 'Passwords do not match';
                    }
                }

                if (empty($data['email_err']) && empty($data['mobile_tel_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {

                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    if ($this->userModel->registerStudent($data)) {
                        // $this->uploadImage();
                        flash('info', 'You have succesfully registered the student');
                        redirect('users/login');
                    } else {
                        die('Something went wrong');
                    }

                } else {
                    $this->view('users/registerStudent', $data);
                }

            } else {
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'mobile_tel' => '',
                    'office_tel' => '',
                    'organization' => '',
                    'job_title' => '',
                    'pobox' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'mobile_tel_err' => '',
                ];

                $this->view('users/registerStudent', $data);
            }} else {
            flash('info', 'You do not have permission', 'alert alert-danger');
            redirect('pages/index');
        }
    }

    // private function uploadImage()
    // {
    //     $target_dir = "../../public/img/";
    //     $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    //     $uploadOk = 1;
    //     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    //     if (isset($_POST["submit"])) {
    //         $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    //         if ($check !== false) {
    //             echo "File is an image - " . $check["mime"] . ".";
    //             $uploadOk = 1;
    //         } else {
    //             echo "File is not an image.";
    //             $uploadOk = 0;
    //         }
    //     }
    // }

    public function registerTeacher()
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Admin') {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                ];

                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter email';
                } else {
                    if ($this->userModel->findUserByEmail($data['email'])[0]) {
                        $data['email_err'] = 'Email is already taken';
                    }
                }

                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter name';
                }

                if (empty($data['password'])) {
                    $data['password_err'] = 'Please enter password';
                } elseif (strlen($data['password']) < 6) {
                    $data['password_err'] = 'Password must be at least 6 characters';
                }

                if (empty($data['confirm_password'])) {
                    $data['confirm_password_err'] = 'Please confirm password';
                } else {
                    if ($data['password'] != $data['confirm_password']) {
                        $data['confirm_password_err'] = 'Passwords do not match';
                    }
                }

                if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    if ($this->userModel->registerTeacher($data)) {
                        flash('info', 'You have successfully registered the teacher');
                        redirect('users/login');
                    } else {
                        die('Something went wrong');
                    }

                } else {
                    $this->view('users/registerTeacher', $data);
                }

            } else {
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                ];

                $this->view('users/registerTeacher', $data);
            }
        } else {
            flash('info', 'You do not have permission', 'alert alert-danger');
            redirect('pages/index');
        }
    }

    public function registerAdmin()
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Admin') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                ];

                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter email';
                } else {
                    if ($this->userModel->findUserByEmail($data['email'])[0]) {
                        $data['email_err'] = 'Email is already taken';
                    }
                }

                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter name';
                }

                if (empty($data['password'])) {
                    $data['password_err'] = 'Please enter password';
                } elseif (strlen($data['password']) < 6) {
                    $data['password_err'] = 'Password must be at least 6 characters';
                }

                if (empty($data['confirm_password'])) {
                    $data['confirm_password_err'] = 'Please confirm password';
                } else {
                    if ($data['password'] != $data['confirm_password']) {
                        $data['confirm_password_err'] = 'Passwords do not match';
                    }
                }

                if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    if ($this->userModel->registerAdmin($data)) {
                        flash('info', 'You have successfully registered the administrator');
                        redirect('users/login');
                    } else {
                        die('Something went wrong');
                    }

                } else {
                    $this->view('users/registerAdmin', $data);
                }

            } else {
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                ];

                $this->view('users/registerAdmin', $data);
            }} else {flash('info', 'You do not have permission', 'alert alert-danger');
            redirect('pages/index');

        }

    }
    public function login()
    {
        if (!($this->isLoggedIn())) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => '',
                ];

                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter email';
                }

                if (empty($data['password'])) {
                    $data['password_err'] = 'Please enter password';
                }

                if ($this->userModel->findUserByEmail($data['email'])[0] == false) {
                    $data['email_err'] = 'No user found';
                } else {
                    $role = $this->userModel->findUserByEmail($data['email'])[1];
                }
                if (empty($data['email_err']) && empty($data['password_err'])) {
                    $loggedInUser = $this->userModel->login($data['email'], $data['password'], $role);
                    if ($loggedInUser) {
                        $this->createUserSession($loggedInUser, $role);
                    } else {
                        $data['password_err'] = 'Password incorrect';
                        $this->view('users/login', $data);
                    }
                } else {
                    $this->view('users/login', $data);
                }

            } else {
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => '',
                ];
                $this->view('users/login', $data);
            }
        } else {
            redirect('pages/index');
        }
    }

    public function createUserSession($user, $role)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->Email;
        $_SESSION['user_name'] = $user->Name;
        $_SESSION['user_role'] = $role;
        redirect('pages/index');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        session_destroy();
        redirect('users/login');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
}
