<?php
session_start();
include('db.php');
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($con,"SELECT * FROM `products` WHERE `code`='$code'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];

$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'>Product is added to your cart!</div>";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($code,$array_keys)) {
		$status = "<div class='box' style='color:red; font-weight:bold;'>
		Product is already added to your cart!</div>";	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}
?>
<html>
<head>
<title>Shop</title>
	<link rel='stylesheet' href='css/cart.css' type='text/css' media='all' />
	<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
	<link rel="stylesheet" type="text/css" href="css/footer.css" />
	<link rel="stylesheet" type="text/css" href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>        
	<script type="text/javascript" src="javascript/contactValidation.js"></script>
</head>
<body>
<header id="myHeader" class="header">
    <div id="navbar">
    <a href="index.html" id="logo">Tulips & Trinkets</a>
    <a href="index.html">Home</a>
    <a href="#shop">Shop</a>
    <a href="AboutUs.html">About Us</a>
    <a href="faq.html">FAQ</a>
    <a href="#contact">Contact</a>
	<div style="float: right;">
		<?php
			if(!empty($_SESSION["shopping_cart"])) {
			$cart_count = count(array_keys($_SESSION["shopping_cart"]));
		?>
		<div class="cart_div">
			<a href="cart.php"><img src="cart-icon.png" /> 
				Cart<span><?php echo $cart_count; ?>
		</div>
    </div>              
    </header>        
        <div id="left"></div>
        <div id="right"></div>
        <div id="bottom"></div>
	<div style="width:100%; ">
		</span></a>
		</div>

		<div style="clear:both;"></div>

		<div class="message_box" style="margin:10px 0px;">
		<?php echo $status; ?>
		</div>
		</div>
		<?php
		}
$result = mysqli_query($con,"SELECT * FROM `products`");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='".$row['image']."' /></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>₹. ".$row['price']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
        }
mysqli_close($con);
?>
<footer class="footer">
        <div class="left-footer">
          <img src="images/icon.png"/>
          <div style="float:right; margin-top: 5px; font-family: 'Now Alt Light',Calibri; color: white; text-align: left;">
            <h4 style="margin:15px;">Head Office:</h4>
            <p style="margin:15px;">5th Street, 18th Cross,<br/>90, Richmond Town, Bangalore, India</p>
            <h4 style="margin:15px;">Check us Out:</h4>
            <p style="margin:15px;"> 
              <a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i></a>
              <a href="https://www.instagram.com" target="_blank"><i class="fa fa-instagram"></i></a>
              <a href="https://www.twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
            </p>
            <i class="fa fa-phone"></i>
            : +91 8310728758 <br/><br/>
            <a href="adminlogin.html" style="text-decoration: none; color: white;">Admin Login</a>
          </div>  
          <div class="vl"></div>
          <p>Tulips & Trinkets Co.</p>                 
        </div>
        <div class="right-footer" id="contact">
			<form name='contact' id='contact' onSubmit="return contactValidation();" method="POST" action="send-mail.php">
                <fieldset>
                    <legend><h4 style="margin: 5px;">Contact Us</h4></legend>
                    <input type="text" placeholder="Name" name="name" id="name" style="width: 70%; margin-bottom: 10px;" />
                    <input type="text" placeholder="Email Id (required)" name="email" id="email" style="width: 70%; margin-bottom: 10px;" />
                    <input type="text" placeholder="Phone" name="phone" id="phone" style="width: 70%; margin-bottom: 10px;" />
                    <textarea name="feedback" placeholder="How can we help?" rows="4" style="width: 70%"></textarea><br/>
                    <input class="button" type="Submit" name="submit">
                </fieldset>
            </form>
        </div>
      </footer>

</body>
</html>