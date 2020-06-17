<!DOCTYPE>
<?php
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
                Welcome Guest! <b style="color:yellow">Shopping: </b>  
                Items: <?php total_items(); ?> - Price:  USD $<?php total_price(); ?>,00
                <a href="cart.php" style="color:yellow;text-decoration:none"><b>Check Cart</b></a>
            
                </span>
            

            </div>

            <?php
            //Echoing the IP address to test the getIP function
            //echo $ip=getIp(); 
            ?>

            <div id="products_box">

                <?php
                //If not set SESSION customer ID
                if(!isset($_SESSION['customer_email'])){

                    //Then ask the customer to logon
                    include("customer_login.php");

                }
                else {

                 //Bring the customer to pay
                 include("payment.php");

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