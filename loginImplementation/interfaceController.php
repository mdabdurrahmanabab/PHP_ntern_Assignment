<?php
session_start();
interface LoggerInterface{
    public function registration($name, $email, $password, $confirmPassword);
    // public function loggedin($usernameemail, $password);
    // public function selectUserById($id);
}

class DatabaseLogger implements LoggerInterface{
    public $host = "localhost";
    public $user = "root";
    public $pass = "";
    public $db_name = "oop_reglog";
    public $conn;
    public function __construct(){
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db_name);
    } 
    public function registration($name, $email, $password, $confirmPassword){
        $duplicate = mysqli_query($this->conn,"SELECT * FROM tb_user WHERE username='$name' OR email = '$email'");
        if (mysqli_num_rows($duplicate) > 0) {
            return 10;
        }else{
            if ($password == $confirmPassword) {
                $query = "INSERT INTO tb_user VALUES ('','$name','$email','$password','','')";
                mysqli_query($this->conn, $query);
                return 1;
            }else{
                return 100;
            }
        }
    }

    //login section 
    public $id;
    public function loggedin($usernameemail, $password){       
        $result = mysqli_query($this->conn, "SELECT * FROM tb_user WHERE username = '$usernameemail' OR email = '$usernameemail'");
        $row =mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) > 0) {
            if($password == $row["password"]){
                $this->id = $row['id'];
                return 1;
                //login successfull.
            }else{
                return 10;
                //wrong password.
            }
        }else{
            return 100;
            //user not registraed.
        }
    }
    public function idUser(){
        return $this->id;
    }


    public function selectUserById($id){
        $query = mysqli_query($this->conn,"SELECT * FROM tb_user WHERE id = '$id'");
        // print_r($query);
        // die();
        return mysqli_fetch_assoc($query);
        

    }
}








