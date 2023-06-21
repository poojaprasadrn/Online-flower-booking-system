<?php

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="flower_shop"; // Database name 

// Connect to server and select database.
$con=mysqli_connect("$host", "$username", "$password") or die ("Unable to connect. Please try again!"); 
mysqli_select_db($con,"$db_name") or die ("Database connection failure.Please try again");

$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$feedback=$_POST['feedback'];

$to       = 'tulipstrinkets@gmail.com';
$subject  = 'Contact form sent by '.$name;
$message  = nl2br('Customer Name: '.$name."\r\n"."\r\n".'Contact details:'."\r\n".
                $phone."\r\n".$email."\r\n"."\r\n".'Message:'.$feedback);
$headers  = 'From:'.$email."\r\n".
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';
if(mail($to, $subject, $message, $headers))
echo "<script type='text/javascript'> alert('We will get back to you shortly! 😁');
window.location='index.html';</script>";
else
echo "<script type='text/javascript'> alert('Uh oh! 😵 Something went wrong. Please try again');
window.location='index.html';</script>";
?>