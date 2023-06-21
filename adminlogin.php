<?php

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="flower_shop"; // Database name 

// Connect to server and select database.
$con=mysqli_connect("$host", "$username", "$password") or die ("Unable to connect. Please try again!"); 
mysqli_select_db($con,"$db_name") or die ("Database connection failure.Please try again");

// Get values from form 
$id=$_POST['id'];
$pass=$_POST['pass'];

if (($id=="karishma" && $pass=="flower123") || ($id=="pooja" && $pass=="flower456"))
{
	header('Location: admindashboard.php');
}

else
{
    echo "<script type='text/javascript'> alert('Wrong Username or Password');
    window.location='adminlogin.html';
    </script>";
}

?>