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
        $this->db->query('INSERT INTO courses (Name, Description, Duration) VALUE(:name, :description, :duration)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':duration', $data['duration']);

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
    
    public function uploadImage($entity, $dir, $id){
        if ($entity == 'Teacher'){
            $this->db->query('UPDATE teachers SET image_directory = :dir WHERE Email = :id');
        }else if($entity == 'Student'){
            $this->db->query('UPDATE students SET image_directory = :dir WHERE Email = :id'); 
        }else if ($entity == 'Course'){
            $this->db->query('UPDATE courses SET image_directory = :dir WHERE Name = :id'); 
        }
        $this->db->bind(':id', $id);
        $this->db->bind(':dir', $dir);
        return $this->db->execute();
    }

    public function editCertificate($data){
        $this->db->query('UPDATE certificates SET Name = :name, Vendor = :vendor, Description = :description WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':vendor', $data['vendor']);
        $this->db->bind(':description', $data['description']);
        return $this->db->execute();
    }

    public function editCourse($data){
        $this->db->query('UPDATE courses SET Name = :name, Description = :description, Duration = :duration WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':duration', $data['duration']);
        return $this->db->execute();
    }


      public function getEntityById($id, $entity){
          if($entity == 'Student'){
            $this->db->query('SELECT * FROM students WHERE id = :id');
          }else if($entity == 'Teacher'){
            $this->db->query('SELECT * FROM teachers WHERE id = :id');
          }else if($entity == 'Admin'){
            $this->db->query('SELECT * FROM admins WHERE id = :id');
          }else if($entity == 'Certificate'){
            $this->db->query('SELECT * FROM certificates WHERE id = :id');
          }else if($entity == 'Course'){
            $this->db->query('SELECT * FROM courses WHERE id = :id');
          }else{
              
          }
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
      }

      public function deleteEntity($entity, $id){
        if($entity == 'Student'){
            $this->db->query('DELETE FROM students WHERE id = :id');
        }else if($entity == 'Teacher'){
            $this->db->query('DELETE FROM teachers WHERE id = :id');
        }else if($entity == 'Admin'){
            $this->db->query('DELETE FROM admins WHERE id = :id');
        }else if($entity == 'Certificate'){
            $this->db->query('DELETE FROM certificates WHERE id = :id');
        }else if($entity == 'Course'){
            $this->db->query('DELETE FROM courses WHERE id = :id');
        }
        $this->db->bind(':id', $id);
        return $this->db->execute();
      }

      public function findCertificateByName($name){
            $this->db->query('SELECT * FROM certificates WHERE Name = :name');
            $this->db->bind(':name', $name);
            $row = $this->db->single();
            if ($this->db->rowCount() > 0) {
                return true;
            }else{
                return false;
            }
      }
}