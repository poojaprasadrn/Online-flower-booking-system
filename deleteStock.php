<?php

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="flower_shop"; // Database name 

// Connect to server and select database.
$con=@mysqli_connect("$host", "$username", "$password") or die ("Unable to connect. Please try again!"); 
mysqli_select_db($con,$db_name) or die ("Database connection failure.Please try again");

// Get values from form 
$code=$_POST['code'];

// Insert data into mysql 
$sql="DELETE FROM products WHERE code='$code'";
$result=mysqli_query($con,$sql);

// if successfully insert data into database. 
if($result){
    echo "<script type='text/javascript'> alert('Stock updated successfully!');
    window.location='admindashboard.php';</script>";
}

else {
    echo "<script type='text/javascript'> alert('Error in updation! Please try again.');
    window.location='admindashboard.php';</script>";
}

// close connection 
mysqli_close($con);
?>