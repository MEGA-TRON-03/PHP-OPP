<?php
include ('library/database.php');
class Register{
    public $db;
    public function __construct(){
        $this->db = new Database();
    }

    //! data insert procedure

    public function addRegister($data, $file){
        $name        = $data['name'];
        $email       = $data['email'];
        $phone       = $data['phone'];
        $address     = $data['address'];

        //! Image Uploading Procedure Starts.
        
        $permission   = array('jpg', 'png', 'jpeg', 'gif');
        $image_name   = $file['photo']['name'];
        $image_size   = $file['photo']['size'];
        $tmp_file     = $file['photo']['tmp_name'];

        $divided      = explode('.', $image_name);
        $image_ext    = strtolower(end($divided));
        $rand_1       = rand (0,99999999);
        $rand_2       = rand (0,99999999);
        $final_image  = $rand_1.'_'.$rand_2.'.'.$image_ext;
        $upload_image = "img/".$final_image;

        //@ Image Uploading Procedure Ends.


        if (empty($name)|| empty($email)|| empty($phone)|| empty($address)|| empty($image_name)){
            
           $massage = "Field must not be empty!";
           return $massage;

        }elseif ($image_size > 1048567){
            
            $massage = "File size must be less than 1 MB!";
            return $massage; 

        }elseif (in_array($image_ext, $permission) == false){

            $massage = "You must be uploaded ".implode(',', $permission)."files";
            return $massage;

        }else{

            move_uploaded_file($tmp_file, $upload_image);
            
            //! Insert Data Query Starts.
            
            $query = "INSERT INTO `student_registration`( `name`, `email`, `phone`, `photo`, `address`) VALUES ('$name', '$email', '$phone', '$upload_image', '$address')";
                                                        
            $result = $this->db->insert($query);

            if ($result){

                $massage = "Registration successful!";
                return $massage;

            }else{

                $massage = "Registration failed!";
                return $massage;

            }

            //@ Insert Data Query Ends.
        }
    }

    //! Select Data Query Starts.

    public function studentInfo(){

        $qurrey = "SELECT * FROM student_registration ORDER BY id ASC";
        $result = $this->db->select($qurrey);
        return $result;

    }

    //@ Select Data Query Ends.

    public function getStudentByID($id){

        $qurrey = "SELECT * FROM student_registration WHERE id = '$id'";
        $result = $this->db->select($qurrey);
        return $result;

    }


    //! Update Data Procedure. 

    public function updateStudent($data, $file, $id){

        $name         = $data['name'];
        $email        = $data['email'];
        $phone        = $data['phone'];
        $address      = $data['address'];
        
        $permission   = array('jpg', 'png', 'jpeg', 'gif');
        $image_name   = $file['photo']['name'];
        $image_size   = $file['photo']['size'];
        $tmp_file     = $file['photo']['tmp_name'];

        $divided      = explode('.', $image_name);
        $image_ext    = strtolower(end($divided));
        $rand_1       = rand (0,99999999);
        $rand_2       = rand (0,99999999);
        $final_image  = $rand_1.'_'.$rand_2.'.'.$image_ext;
        $upload_image = "img/".$final_image;

        if (empty($name)|| empty($email)|| empty($phone)|| empty($address)){
            
            $massage = "Field must not be empty!";
            return $massage;
        }if (!empty($image_name)){

            if ($image_size > 1048567){
            
                $massage = "File size must be bigger than 1 MB!";
                    return $massage; 
                }elseif (in_array($image_ext, $permission) == false){
                    $massage = "You must be uploaded ".implode(',', $permission)."files";
                    return $massage;
                }else{

                    //! Old Image Delete Code Starts.

                    $img_query = "SELECT * FROM student_registration  WHERE id= '$id'";
                    $img_res = $this->db->select($img_query);
                    if ($img_res){
                        while ($row = mysqli_fetch_assoc($img_res)){
                            $photo = $row['photo'];
                            unlink ($photo);
                        }
                    }

                    //@ Old Image Delete Code Ends.

                    move_uploaded_file($tmp_file, $upload_image);
        
                    
                    //! Update Data Query Starts. 
                    
                                        
                    $query = "UPDATE student_registration SET name = '$name', email = '$email', phone = '$phone', photo = '$upload_image', address = '$address' WHERE id = '$id'";

                    $result = $this->db->insert($query);
        
                    if ($result){
                        $massage = "Student information updated successful!";
                        return $massage;
                    }else{
                        $massage = "Update failed!";
                        return $massage;
                    }

                    //@Update Data Query Ends. 
                    
                } 

        } else {

           //! Update Data Query Starts. 
                                        
            $query = "UPDATE student_registration SET name = '$name', email = '$email', phone = '$phone', photo = '$upload_image', address = '$address' WHERE id = '$id'";

            $result = $this->db->insert($query);

            if ($result){
                $massage = "Student information updated successful!";
                return $massage;
            }else{
                $massage = "Update failed!";
                return $massage;
            }

            //@Update Data Query Ends. 

        }
           
    }

    //! Delete Data Query Starts.

    public function deleteStudent($id){
    
        //! Old Image Delete Code Starts.

        $img_query = "SELECT * FROM student_registration  WHERE id= '$id'";
        $img_res = $this->db->select($img_query);
        if ($img_res){
            while ($row = mysqli_fetch_assoc($img_res)){
                $photo = $row['photo'];
                unlink ($photo);
            }
        }

        //@ Old Image Delete Code Ends.


        $delete_query = "DELETE FROM student_registration WHERE id= '$id'";
        $delete = $this->db->delete($delete_query);
        if ($delete){
            $massage = "Student information deleted successful!";
            return $massage;
        }else{
            $massage = "Delete request failed!";
            return $massage;
        }
    }

    //@ Delete Data Query Ends.
}
?>