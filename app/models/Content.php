<?php
class Content
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function add_certificate($data){
        $this->db->query('INSERT INTO certificates (Name, Vendor, Description) VALUE(:name, :vendor, :description)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':vendor', $data['vendor']);
        $this->db->bind(':description', $data['description']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function add_course($data){
        $this->db->query('INSERT INTO courses (Name, Description) VALUE(:name, :description)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function fetch_certificates(){
        $this->db->query('SELECT * FROM certificates');
        $result = $this->db->resultSet('certificates');
        return $result;
    }

    public function fetch_courses(){
        $this->db->query('SELECT * FROM courses');
        $result = $this->db->resultSet('courses');
        return $result;
    }

    public function fetch_students(){
        $this->db->query('SELECT * FROM students');
        $result = $this->db->resultSet('students');
        return $result;
    }

    public function fetch_teachers(){
        $this->db->query('SELECT * FROM teachers');
        $result = $this->db->resultSet('teachers');
        return $result;
    }

    public function fetch_admins(){
        $this->db->query('SELECT * FROM admins');
        $result = $this->db->resultSet('admins');
        return $result;
    }
}