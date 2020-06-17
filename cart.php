<!DOCTYPE>
<?php

//Start session to be used below to hold the QuanTitY of products
session_start();

//Including the function php file
include("functions/functions.php");
?>

<html>
    <head>
        <title>e-Commerce App</title>

        <link rel="stylesheet" href="styles/style.css" media="all" >
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> 


    </head>

<body>

<!-- Main div Container-->
<div class="main_wrapper">

    <!--  Header div Container-->
    <div class="header_wrapper">

        <h1>e-Commerce App</h1>

        <!--<img class="logo" src="images/logo.png">-->

    </div>

    <!-- Menu bar div Container-->
    <div class="menubar">

        <ul id="menu">
            <li><a href="index.php">home</a></li>
            <li><a href="all_products.php">all products</a></li>
            <li><a href="customer/my_account.php">my account</a></li>
            <li><a href="#">sign up</a></li>
            <li><a href="cart.php">shopping cart</a></li>
            <li><a href="#">contact us</a></li>
        </ul>

        <div id="form">
            <form method="get" action="results.php" enctype="multipart/form-data">
                <input type="text" name="user_query" placeholder="search for products...">
                <input type="submit" name="search" value="search" >
            </form>
        </div>



    </div>


    <!-- Main Content div Container-->
    <div class="content_wrapper">

        <!-- Sidebar div Container-->
        <div id="sidebar">
        
            <div id="sidebar_title">categories</div>

                <ul id="cats">

                <!--Calling PHP function-->
                <?php getCats(); ?>
                
                <!-- HTML static categories...
                <li><a href="#">laptops</a></li>
                <li><a href="#">computers</a></li>
                <li><a href="#">mobiles</a></li>
                <li><a href="#">cameras</a></li>
                <li><a href="#">ipads</a></li>
                <li><a href="#">tablets</a></li>-->
                
                </ul>

            <div id="sidebar_title">brands</div>

                <ul id="cats">
            
                <!--Calling PHP function-->
                <?php getBrands(); ?>
                
                <!-- HTML static brands...
                <li><a href="#">hp</a></li>
                <li><a href="#">dell</a></li>
                <li><a href="#">motorola</a></li>
                <li><a href="#">sony</a></li>
                <li><a href="#">lg</a></li>
                <li><a href="#">apple</a></li>-->
            
                </ul>            
        </div>

        <!-- Content div Container-->
        <div id="content_area">

        <!--Adding the cart function-->
        <?php cart(); ?>

            <div id="shopping_cart">

                <span style="float:right;margin-right:10px;margin-top:10px">

                <?php 
					if(isset($_SESSION['customer_email'])){
					echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'>Your</b>" ;
					}
					else {
					echo "Welcome Guest:";
					}
				?>


                <b style="color:yellow">Shopping: </b>  
                Items: <?php total_items(); ?> - Price:  USD $<?php total_price(); ?>,00
                <a href="index.php" style="color:yellow;text-decoration:none"><b>Back to Shop</b></a>
            
                <?php 
					if(!isset($_SESSION['customer_email'])){
					
					echo "<a href='checkout.php' style='color:orange;'>Login</a>";
					
					}
					else {
					echo "<a href='logout.php' style='color:orange;'>Logout</a>";
					}
					
					
					
					?>

                </span>
            

            </div>

            <?php
            //Echoing the IP address to test the getIP function
            //echo $ip=getIp(); 
            ?>

            <div id="products_box">


                    <br><br>
                <form action="" method="post" enctype="multipart/form-data">
                    
                    <table align="center" width="700">
                            <tr>
                                <th>Remove</th>
                                <th>Product(s)</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>        

                    <?php 
                    
                    $total = 0;

                    global $con;
                
                    $ip = getIp();
                
                    //Thru the ip address we'll isolate each customer before loging on
                    $sel_price = "select * from cart where ip_add='$ip'";
                
                    $run_price = mysqli_query($con, $sel_price);
                
                    while($p_price=mysqli_fetch_array($run_price)){
                
                        //taking the p_id from the query above
                        $pro_id = $p_price['p_id'];
                
                        //Establishing relationship between table cart and table product
                        $pro_price = "select * from products where product_id='$pro_id'";
                
                        $run_pro_price = mysqli_query($con, $pro_price);
                
                        while ($pp_price = mysqli_fetch_array($run_pro_price)){
                
                            $product_price = array($pp_price ['product_price']);

                            $product_title = $pp_price['product_title'];

                            $product_image = $pp_price['product_image'];

                            $single_price = $pp_price['product_price'];
                
                            //calculating prices
                            $values = array_sum($product_price);
                
                            //Total price
                            $total +=$values;
                
                            //echo $total;

                            //$qty = 1;

                    ?>
                    

                    <tr align="center">
                        <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"></td>
                        <td><?php echo $product_title; ?><br>
                        <img src="admin_area/product_images/<?php echo $product_image; ?>" width="60" height="60">
                        </td>

                        <?php

                                $qty=1;

                                if(isset($_POST['update_cart'])){

                                    //(float) will convert from string to float
                                    $qty = (float)$_POST['qty'];

                                    $update_qty = "update cart set qty='$qty'";

                                    $run_qty = mysqli_query($con, $update_qty);

                                    $_SESSION['qty']=$qty;

                                    //Testing $qty OUTPUT details
                                    var_dump($qty);

                                    var_dump($_SESSION['qty']);

                                    $total = $total * $qty;

                                }


                            ?>

                        <td><input type="text" size="4" name="qty" value="<?php echo $qty; ?>"></td>

                            

                        <td>USD <?php echo $single_price; ?>,00</td>
                    </tr>

                    <?php } } ?>

                    </table>
                    <br>
                    <p style="text-align:right;margin-right:70px"><b>Sub Total:</b> USD <?php echo $total; ?>,00</p> 
                    <br><br>
                    <div align="right" style="margin-right:70px">
                    <input type="submit" name="update_cart" value="Update"><br><br>
                    <input type="submit" name="continue" value="Continue Shopping"><br><br>
                    <button><a href="checkout.php" style="text-decoration:none">CHECKOUT!</a></button>
                    </div>
                </form>

            <?php

                $ip = getIp();

                if(isset($_POST['update_cart'])){

                    foreach($_POST['remove'] as $remove_id) {

                      $delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";

                      $run_delete = mysqli_query($con, $delete_product);

                        if($run_delete) {

                            echo "<script>window.open('cart.php', '_self')</script>";

                        }

                    }

                }

                if(isset($_POST['continue'])){

                    echo "<script>window.open('index.php', '_self')</script>";

                }

            ?>

        
            </div>

        </div>

    </div>

    <!-- Footer div Container-->
    <div id="footer">
    
    <h4 style="text-align:center; padding-top:20px;">&copy; 2020 - RodGaiotto</h4>
    
    </div>

</div>
</body>
</html>