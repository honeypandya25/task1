<?php

//header file is included here
include 'inc/header.php';

//user file is included here

include 'lib/user.php';

//if user logged in redirect user to index page
session::userLogin();


$host="localhost";
$username="root"; 
$password=""; 
$db_name="task"; 
$conn=mysqli_connect("$host", "$username", "$password")or die("cannot connect");

mysqli_select_db($conn,"$db_name")or die("cannot select DB");


if($_POST)
{
  

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_number = $_POST['contact_number'];
    $image = $_POST['image'];
    $user_name = $_POST['user_name'];   
    $Password = $_POST['Password'];
    $confirm_password = $_POST['confirm_password'];


    if(is_numeric($contact_number)){
        if($contact_number>=1000000000 && $contact_number<=9999999999){
        $contact_number="0".$contact_number ;
        }
        else{
        echo "<script>alert('Invalid Mobile Number');window.location='registration.php';</script>";
        }
    }
   
        if($Password != $confirm_password){
            echo "<script>alert('password not match');window.location='registration.php';</script>";
        }
       
       

        $insertq = mysqli_query($conn, "insert into user(first_name,last_name,contact_number,image,user_name,Password,confirm_password) values('{$first_name}','{$last_name}','{$contact_number}','{$image}','{$user_name}','{$Password}','{$confirm_password}')") or die(mysqli_error($conn)); 
        if($insertq)
        {
          
            echo "<script>alert('Record Inserted');window.location='login.php';</script>";
        }
        
        // passwords match
        return true;
        
}


	

  
?>

<!-- body area started form here -->

<div class="container w-50 mt-5">
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-white">Create a new account</h5>
        </div>
        <div class="card-body">
<?php

if(isset($userRegistration)){
    echo $userRegistration;
}

?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" name="first_name" pattern="[A-Za-z]*" <?php echo"abvd"; ?> class="form-control" id="first_name" required>
                
                </div>
                <div class="form-group">
                    <label for="name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="user_name" class="form-control" id="user_name" required>
                </div>
                <div class="form-group">
                    <label for="number">Contact Number</label>
                    <input type="number" name="contact_number" class="form-control" id="contact_number" required>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control" id="image" required>
                </div>
                <div class="form-group">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" id="confirm_password"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="Password" class="form-control" id="Password"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" required>
                </div>

                <button type="submit" name="submit" class="btn btn-sm btn-primary mt-4">Submit</button>
            </form>
        </div>
    </div>
</div>