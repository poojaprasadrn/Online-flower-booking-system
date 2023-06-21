<?php

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="flower_shop"; // Database name 
$tbl_name="orders"; // Table name 

// Connect to server and select database.
$con=@mysqli_connect("$host", "$username", "$password") or die ("Unable to connect. Please try again!"); 
mysqli_select_db($con,$db_name) or die ("Database connection failure.Please try again");

// Get values from form 
$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$address=$_POST['address'];

$sql = "INSERT INTO orders (Uname,Cust_Email,Phone,DAddress) VALUES ( '$name', '$email', '$phone','$address')";

$query = mysqli_query($con,$sql);

if($query){
    echo "<script>window.location='redirect.html';</script>";
}

else {
    echo "<script type='text/javascript'> alert('Uh oh! Something went wrong. Please try again :( ');
    window.location='shop.php';</script>";
}
?>