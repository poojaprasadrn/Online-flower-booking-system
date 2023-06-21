<!DOCTYPE HTML>
<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" type="text/css" href="css/dashboard.css">
        <script src="javascript/updateStock.js"></script>
    </head>
    <body background="images/background.jpg">
        <div class="container">
            <h1 id="top" class="heading">Welcome, Admin!</h1>
            <div class="insert">
                    <h2>Menu</h2>
                    <span><a href="#stock">Stock</a></span>
                    <span></span>
                    <span></span>
                    <span><a href="#order">Orders</a></span>
            </div>
            <div class="tables" id="flowers">
                <h2>Product Stock</h2>
                <table class="display">
                    <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Price</th>
                    </tr>
                    <?php
                        $con=mysqli_connect("localhost","root","","flower_shop");
                        if ($con->connect_error) {
                            die ("Connection failed! Try again.".$con->connect_error);
                        }
                        $sql = "SELECT * FROM products";
                        $result=$con->query($sql);

                        if ($result-> num_rows>0) {
                            while ($row=$result->fetch_assoc()) {
                            echo "<tr><td>".$row["name"]."</td><td>".$row["code"]."</td><td>".$row["price"]."</td>";
                            }
                        }
                        else {
                            echo "No results!";
                        }
                        $con -> close();
                        ?>
                </table>                   
            </div> 
            
            <div class="forms" id="productsupdate">
                <h2>Stock Update</h2>
                <form name='products_submit' onSubmit="return updateStock();" method="POST" action="updateStock.php">
                    <table class="update_form">
                        <tr>
                            <td><label>Product Name:</label></td>
                            <td><input type="text" name="name" id="name" required/></td>
                        </tr>
                        <tr>
                            <td><label>Product Code:</label></td>
                            <td><input type="text" name="code" id="code" required/></td>
                        </tr>
                        <tr>
                            <td><label>Product Price:</label></td>
                            <td><input type="text" name="price" id="price" required/></td>
                        </tr>
                        <tr>
                            <td><label>Product Image</label></td>
                            <td><input type="file" name="images" id="images" required/></td>
                        </tr>
                        <tr><td colspan="2"><input type="Submit" value=Submit class="submit"> </td></tr>
                    </table>          
                </form>
            </div>

            <div class="forms" id="productsdelete">
                <h2>Remove from Stock</h2>
                <form name='products_submit' method="POST" action="deleteStock.php">
                    <table class="update_form">
                        <tr>
                            <td><label>Product code:</label></td>
                            <td><input type="text" name="code" id="code" required/></td>
                        </tr>
                        <tr><td colspan="2"><input type="Submit" value=Submit class="submit"> </td></tr>
                    </table>          
                </form>
            </div>

            <div class="insert" id="order" style="clear: both;">
                <h2>Orders</h2>
                <table class="display">
                    <tr>
                    <th>Order Id</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Order Date</th>
                    <th>Address</th>
                    </tr>
                    <?php
                        $con=mysqli_connect("localhost","root","","flower_shop");
                        if ($con->connect_error) {
                            die ("Connection failed! Try again.".$con->connect_error);
                        }
                        $sql = "SELECT * FROM orders";
                        $result=$con->query($sql);

                        if ($result-> num_rows>0) {
                            while ($row=$result->fetch_assoc()) {
                            echo "<tr><td>".$row["Order_id"]."</td><td>".$row["Uname"]."</td><td>".$row["Cust_Email"]."</td><td>".$row["Phone"]."</td><td>".$row["Date"]."</td><td>".$row["DAddress"]."</td><td>";
                            }
                        }
                        else {
                            echo "No results!";
                        }
                        $con -> close();
                        ?>
                </table>                   
            </div> 
            <a href="index.html" class="logout">Logout</a>
            <a href="#top" class="logout">Top</button>
        </div>
    </body>
</html>