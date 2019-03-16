<?php
function upload($email = null, $name = null)
    {
        $target_dir = MAINROOT . "\public\img\\";
        $ext = explode(".", basename($_FILES["fileToUpload"]["name"]));
        if(null !== $email){
            $id = explode(".", $email); 
            $fileName = $id[0].'com'.'.'.$ext[1]; 
            $target_file = $target_dir.$fileName;
        }else if(null !== $name){
            $fileName = $name.'.'.$ext[1];
            $target_file = $target_dir.$fileName;
        }
        // die($fileName);
        // mkdir(MAINROOT . "\public\img\\".$email);

        // $target_file = $target_dir . $email;
        // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                // echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // if (file_exists($target_file)) {
        //     echo "Sorry, file already exists.";
        //     $uploadOk = 0;
        // }
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $uploadOk = 0;
            return array($uploadOk, "Sorry, your file is too large.");
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $uploadOk = 0;
            return array($uploadOk, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }
        
        if ($uploadOk == 0) {
            return array($uploadOk, "Sorry, your file was not uploaded.");
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                return array($uploadOk, "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.", $fileName);
            } else {
                return array(0, "Sorry, there was an error uploading your file.");
            }
        }
    }
    