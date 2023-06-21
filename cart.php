<!DOCTYPE html>
<?php
	session_start();
	$status="";
	if (isset($_POST['action']) && $_POST['action']=="remove"){
		if(!empty($_SESSION["shopping_cart"])) {
			foreach($_SESSION["shopping_cart"] as $key => $value) {
				if($_POST["code"] == $key){
					unset($_SESSION["shopping_cart"][$key]);
					$status = "<div class='box' style='color:red; background-color: white;'>
					Product is removed from your cart!</div>";
				}
				if(empty($_SESSION["shopping_cart"]))
					unset($_SESSION["shopping_cart"]);
			}		
		}
	}
	if (isset($_POST['action']) && $_POST['action']=="change"){
		foreach($_SESSION["shopping_cart"] as &$value){
			if($value['code'] === $_POST["code"]){
				$value['quantity'] = $_POST["quantity"];
				break; // Stop the loop after we've found the product
			}
		}
	}
?>
<html>
	<head>
		<title>Your Cart</title>
		<link rel='stylesheet' href='css/cart.css' type='text/css' media='all' />
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="css/pay.css" type='text/css' media='all'>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	</head>
	<body style="background-image: url('images/background.jpg');">
		<h2 style="margin: 20px; font-family: 'Now Alt Light',Calibri; font-weight: bold; ">Your Cart</h2> 
		<button style="text-transform: uppercase; background: #bd1548; border: 1px solid #bd1548; cursor: pointer; color: #fff;
		padding: 8px 40px; margin: 20px;" onclick="window.location.href = 'shop.php';">
			Back
		</button>
		<?php
			if(!empty($_SESSION["shopping_cart"])) {
			$cart_count = count(array_keys($_SESSION["shopping_cart"]));
		?>
		<?php
		}
		?>
		<div class="cart">
			<?php
				if(isset($_SESSION["shopping_cart"])){
				$total_price = 0;
			?>	
			<table class="table">				
					<tr style="border-collapse: collapse;">
						<td></td>
						<th>ITEM NAME</th>
						<th>QUANTITY</th>
						<th>UNIT PRICE</th>
						<th>ITEMS TOTAL</th>
					</tr>	
					<?php		
						foreach ($_SESSION["shopping_cart"] as $product){
					?>
					<tr>
						<td><img src='<?php echo $product["image"]; ?>' width="50" height="40" /></td>
						<td><?php echo $product["name"]; ?><br />
							<form method='post' action=''>
								<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
								<input type='hidden' name='action' value="remove" />
								<button type='submit' class='remove'>Remove Item</button>
							</form>
						</td>
						<td>
							<form method='post' action=''>
								<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
								<input type='hidden' name='action' value="change" />
								<select name='quantity' class='quantity' onchange="this.form.submit()">
									<option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
									<option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
									<option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
									<option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
									<option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
								</select>
							</form>
						</td>
						<td><?php echo "₹. ".$product["price"]; ?></td>
						<td><?php echo "₹. ".$product["price"]*$product["quantity"]; ?></td>
					</tr>
					<?php
						$total_price += ($product["price"]*$product["quantity"]);
						$_SESSION['total'] = $total_price;
						}
					?>
					<tr>
						<td colspan="5" align="right">
							<strong style="color: white;">TOTAL: <?php echo "₹. ".$total_price; ?></strong>
						</td>
					</tr>
				
			</table>
			<?php
			}

			else{
				echo "<script type='text/javascript'> alert('Your Cart is Empty! :(');
				window.location='shop.php';</script>";
				}
			?>
		</div>
		<div style="clear:both;"></div>
		<div class="message_box" style="margin:10px 0px;">
			<?php echo $status; ?>
		</div>

		<div class="w3-container">
			<center><button onclick="document.getElementById('id01').style.display='block'" style=" background: white; border: 1px solid black; cursor: pointer;
			padding: 8px 40px; margin-top: 10px; margin-left: 10px; font-weight: bold;">Buy Now</button></center>
			<div id="id01" class="modal">
				<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
				<form class="modal-content" name="order" id="order" onsubmit="return orders();" method="POST" action="orders.php">
					<div class="container">
						<center><img src="images/order.png"/></center>
						<h1 style="font-family: 'Now Alt Light',Calibri;">Enter Your Details</h1>
						<h2>Total Amount: <span style="color: #bd1548;"><?php echo "₹. ".$total_price; ?></span></h2>
						<hr>
						<label for="Name"><b>Name</b></label>
						<input type="text" placeholder="Enter Name" name="name" id="name">

						<label for="Email"><b>Email</b></label>
						<input type="text" placeholder="Enter Email" name="email" id="email">
						
						<label for="Phone"><b>Phone</b></label>
						<input type="text" placeholder="Enter Phone" name="phone" id="phone">
						
						<label for="Address"><b>Deliver To</b></label><br/>
						<textarea name="address" id="address" placeholder="Enter Delivery Address" rows="4" style="width: 100%; background: #f1f1f1; margin: 5px;"></textarea><br/>

						<label for="Payment"><b>Choose Payment Method: </b></label>
						<select id = "payment" onchange = "ShowHideDiv()">
							<option value="None">Select</option>
							<option value="C">Credit Card</option>
							<option value="D">Debit Card</option> 
							<option value="N">Net Banking</option>             
						</select>
						<div id="creditcard" style="display: none">
							Card Number:
							<input type="text" id="txtPassportNumber" name="card" />
							CVV:
							<input type="password" id="cvv" size="4" name="cvv">
							<div class="form-group" id="expiration-date">
									<label>Expiration Date</label>
									<select>
										<option value="01">January</option>
										<option value="02">February </option>
										<option value="03">March</option>
										<option value="04">April</option>
										<option value="05">May</option>
										<option value="06">June</option>
										<option value="07">July</option>
										<option value="08">August</option>
										<option value="09">September</option>
										<option value="10">October</option>
										<option value="11">November</option>
										<option value="12">December</option>
									</select>
									<select>
										<option value="16"> 2016</option>
										<option value="17"> 2017</option>
										<option value="18"> 2018</option>
										<option value="19"> 2019</option>
										<option value="20"> 2020</option>
										<option value="21"> 2021</option>
									</select>
								</div>
						</div>
						<div id="netbank" style="display: none">
							<input type="radio" name="netbankop" value="sbi"><span><img src="images/netbank1.jpg"></span><br>
							<input type="radio" name="netbankop" value="hdfc"><span><img src="images/netbank2.jpg"></span><br>
							<input type="radio" name="netbankop" value="kotak"><span><img src="images/netbank3.jpg"></span><br>
							Account Number:<input type="text" id="txtPassportNumber" />
    						IFSC Number:<input type="password" id="cvv" size="4">
						</div>
						<button type="button" class="butto" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
						<button type="submit" id="submit" class="butto" disabled>Place Order</button>
					</div>
				</form>
			</div>
		</div>
		<script src="javascript/orders.js"></script>
		<script type="text/javascript">
			function ShowHideDiv() {
				var payment = document.getElementById("payment");
				var creditcard = document.getElementById("creditcard");
				var netbank = document.getElementById("netbank");
				var submitb = document.getElementById("submit");
				if (payment.value=="None")
				{
					submitb.disabled = true;
					alert("Please choose a payment method");
				}
				else{
					submitb.disabled = false;
				}
				if (payment.value == "C" || payment.value == "D")
				{
					creditcard.style.display = payment.value == "C"||"D" ? "block" : "none";
					netbank.style.display = "none";
				}
				else {
					netbank.style.display = payment.value == "N" ? "block" : "none";
					creditcard.style.display = "none";
				}
				
			}
		</script>
	</body>
</html>


