<?php


include_once 'session.php';

include 'database.php';


$host="localhost";
$username="root"; 
$password=""; 
$db_name="task"; 
$connection=mysqli_connect("$host", "$username", "$password")or die("cannot connect");

mysqli_select_db($connection,"$db_name")or die("cannot select DB");


class user{
    private $db;

    public function __construct(){
        $this->db = new database;
    }


  /* public function userRegistration($data){
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $user_name = $data['user_name'];
        $contact_number = $data['contact_number'];
        $image = $data['image'];
        $Password = $data['Password'];
        $confirm_password = $data['confirm_password'];


      
        if($first_name ==  "" OR $last_name ==  "" OR $user_name ==  "" OR $Password ==  "" OR $confirm_password ==  ""){
            $msg = "<div class='alert alert-danger'>* Fileds are required!</div>";
            return $msg;
        }
        
   if($Password != $confirm_password){
        $msg = "<div class='alert alert-danger'>* Password are not the same</div>";
        return $msg;
    }
    // passwords match
    return true;
    
    
    $insertq = mysqli_query($conn, "insert into user(first_name,last_name,contact_number,image,user_name,password,confirm_password) values('{$first_name}','{$last_name}','{$contact_number}','{$image}','{$user_name}','{$password}','{$confirm_password}')") or die(mysqli_error($conn)); 
    if($insertq)
    {
      
        echo "<script>alert('Record Inserted');window.location='login.php';</script>";
    }
    }
*/


    //user login mechanism is created here
    public function userLogin($data){
        $user_name = $data['user_name'];
        $Password = $data['Password'];

        //empty value validation
        if($user_name == "" OR $Password == ""){
            $msg = "<div class='alert alert-danger'>* Fields are required</div>";
            return $msg;
        }


       

        //user will be login if there is no error

        $result = $this->getLoginUserData($user_name, $Password);
        
        if($result){
            session::init();
            session::set("login", true);
            session::set("user_id", $result->user_id);
            session::set("first_name", $result->first_name);
            session::set("last_name", $result->last_name);
            session::set("user_name", $result->user_name);
            session::set("contact_number", $result->contact_number);
            session::set("image", $result->image);
            session::set("Password", $result->Password);
            session::set("confirm_password", $result->confirm_password);
            session::set("loginmsg", "<div class='container'><div class='alert alert-success'>You are logged in</div></div>");
            header("location: index.php");
        }else{
            echo "<div class='container mt-5'><div class='alert alert-danger'>Username and Passwords are not correct</div></div>";
        }
    }


    
    //user data fetch form database
    public function getLoginUserData($user_name, $Password){

        $query = "SELECT * FROM user WHERE `user_name` = :user_name AND `Password` = :Password";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':user_name', $user_name);
        $sql->bindValue(':Password', $Password);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_OBJ);
        return $result;
    }


}