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



?>

<html>

<div class="container mt-5">
    <table class="table table-hover">
    <thead class="thead-dark">
        <tr>
        <th scope="col">Employee Id</th>
        <th scope="col">Employee Name</th>
        <th scope="col">Email Address</th>
        <th scope="col">Contact Number</th>
        <th scope="col">Image</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <tbody>

                                        
<?php 
          
            
            $selectq = mysqli_query($connection, "select * from  employee") or die(mysqli_error($connection));
            
            while($row = mysqli_fetch_array($selectq))
            {
                
                echo "<tr>";
                echo "<td>{$row['Employee_id']}</td>";
                echo "<td>{$row['Employee_name']}</td>";
                echo "<td>{$row['Email_address']}</td>";
                echo "<td>{$row['Contact_number']}</td>";
                echo "<td><img src='images/{$row['image']}' style='width:100px'></td>";
                
                echo "<td><a href='editemployee.php?editid=$row[0]'><img>Edit</a> </td>";
           
                echo "<tr>";
            }
            
            ?>
            

                                       </tbody>


    </tbody>
    </table>
</div>
</html>