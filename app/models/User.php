<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function registerStudent($data)
    {
        $this->db->query('INSERT INTO students (Name, Email, password, MobileTel, OfficeTel, Organization, JobTitle, POBox) VALUES(:name, :email, :password, :mobiletel, :officetel, :organization, :jobtitle, :pobox)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':mobiletel', $data['mobile_tel']);
        $this->db->bind(':officetel', $data['office_tel']);
        $this->db->bind(':organization', $data['organization']);
        $this->db->bind(':jobtitle', $data['job_title']);
        $this->db->bind(':pobox', $data['pobox']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function registerTeacher($data)
    {
        $this->db->query('INSERT INTO teachers (Name, Email, password) VALUES(:name, :email, :password)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function registerAdmin($data)
    {
        $this->db->query('INSERT INTO admins (Name, Email, password) VALUES(:name, :email, :password)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // private function registerUser($data)
    // {
    //     $this->db->query('INSERT INTO users (email) VALUE (:email)');
    //     $this->db->bind(':email', $data['email']);
    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function login($email, $password, $role)
    {
        if ($role == 'Student') {
            $this->db->query('SELECT * FROM students WHERE Email = :email');
        } else if ($role == 'Teacher') {
            $this->db->query('SELECT * FROM teachers WHERE Email = :email');
        } else if ($role == 'Admin') {
            $this->db->query('SELECT * FROM admins WHERE Email = :email');
        }

        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }

    }

    public function findUserByEmail($email)
    {
        $roles = ['Student', 'Teacher', 'Admin'];
        foreach ($roles as $role) {
            if ($role == 'Student') {
                $this->db->query('SELECT * FROM students WHERE Email = :email');
            } else if ($role == 'Teacher') {
                $this->db->query('SELECT * FROM teachers WHERE Email = :email');
            } else if ($role == 'Admin') {
                $this->db->query('SELECT * FROM admins WHERE Email = :email');
            }

            $this->db->bind(':email', $email);

            $row = $this->db->single();

            if ($this->db->rowCount() > 0) {
                return array(true, $role);
            }
        }
        return array(false);
    }

    public function editStudent($data){
        $this->db->query('UPDATE students SET Name = :name, Email = :email, MobileTel = :mobile_tel, OfficeTel = :office_tel, Organization = :organization, JobTitle = :job_title, POBOX = :pobox WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':mobile_tel', $data['mobile_tel']);
        $this->db->bind(':office_tel', $data['office_tel']);
        $this->db->bind(':organization', $data['organization']);
        $this->db->bind(':job_title', $data['job_title']);
        $this->db->bind(':pobox', $data['pobox']);

        return $this->db->execute();
    }

    public function editTeacher($data){
        // $this->db->query('UPDATE teachers SET Name = :name, Email = :email, Certificates = :certificates WHERE id = :id');
        $this->db->query('UPDATE teachers SET Name = :name, Email = :email WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        return $this->db->execute();
    }

    public function editAdmin($data){
        $this->db->query('UPDATE admins SET Name = :name, Email = :email WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']); 
        return $this->db->execute();
    }

}
