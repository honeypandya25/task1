<?php

include 'inc/header.php';


include 'lib/user.php';

$user = new user;

session::userSession();

$host="localhost";
$username="root"; 
$password=""; 
$db_name="task"; 
$connection=mysqli_connect("$host", "$username", "$password")or die("cannot connect");

mysqli_select_db($connection,"$db_name")or die("cannot select DB");


$editid = $_GET['editid'];

 

$selectquery = mysqli_query($connection, "select * from employee where Employee_id='{$editid}'") or die("error in query".mysqli_error($connection));
$rowfromdb = mysqli_fetch_array($selectquery);
    
if($_POST)
{
    
  
    $employee_id = mysqli_real_escape_string($connection,$_POST['Employee_id']);
    $Employee_name = mysqli_real_escape_string($connection,$_POST['Employee_name']);
    $Email_address = mysqli_real_escape_string($connection,$_POST['Email_address']);
    $Contact_number = mysqli_real_escape_string($connection,$_POST['Contact_number']);
    $image = mysqli_real_escape_string($connection,$_POST['image']);
 
    $updatequery = mysqli_query($connection,"update employee set Employee_id='{$Employee_id}',Employee_name='{$Employee_name}',Email_address='{$Email_address}',Contact_number='{$Contact_number}',image='{$image}' where Employee_id='{$editid}'") or die("error in update query".mysqli_error($connection));

    
    if($updatequery)
    {
        echo "<script>alert('record updated');window.location='index.php';</script>";
    }    
    
}   


?>
<html>

<div class="container mt-5">
<form id="" class="form-horizontal"   method="post">
                                <div class="md-group-add-on p-relative">
                                
                                    

                                <div class="md-group-add-on p-relative">
                                 <span class="md-add-on">
                                    <i class="icofont icofont-ui-edit"></i>
                                 </span>
                                    <div class="md-input-wrapper">
                                         <label for="user_name"></label>
                                        <input type="text" class="md-form-control" value="<?php echo $rowfromdb['Employee_name'] ?>" required="true"  name="Employee_name" id="Employee_name" >
                                    
                                        <span class="messages"></span>
                                    </div>
                                </div>
                                <br>
                                  <div class="md-group-add-on p-relative">
                                 <span class="md-add-on">
                                    <i class="icofont icofont-ui-edit"></i>
                                 </span>
                                    <div class="md-input-wrapper">
                                         <label for="email_id"></label>
                                        <input type="email" class="md-form-control" value="<?php echo $rowfromdb['Email_address'] ?>" required="true"  name="Email_address" id="Email_address" >
                                    
                                        <span class="messages"></span>
                                    </div>
                                </div>    
                                    <br>
                                     <div class="md-group-add-on p-relative">
                                 <span class="md-add-on">
                                    <i class="icofont icofont-ui-edit"></i>
                                 </span>
                                    <div class="md-input-wrapper">
                                         <label for="contact"></label>
                                        <input type="contact" class="md-form-control" value="<?php echo $rowfromdb['Contact_number'] ?>" required="true"  name="Contact_number" id="Contact_number" >
                                    
                                        <span class="messages"></span>
                                    </div>
                                </div>  
                                    
                                    
                                    <br>
                                <div class="md-input-wrapper">
                                 <span class="md-add-on">
                                    <i class=""></i>
                                 </span>
                                    <div class="">
                                         <label for="photo"></label>
                                         <label for="file">File input</label>
                                         <input type="file" name="image" id="image">
                                        <img src="{{ asset('images/'. $employee->image)}}" width="100px;" height="100px;" alt="image">
                                        <span class="messages"></span>
                                       
                                    </div>
                                </div> 
                                    <br>
                                    
                               
                                <div class="md-input-wrapper">
                                    <input type="submit" value="Update" class="btn btn-primary waves-effect waves-light">
                               
                                </div>
                            
                        </div>
                                </form>
 
</div>
</html>