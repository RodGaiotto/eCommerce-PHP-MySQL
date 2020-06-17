<!DOCTYPE>
<?php
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
            <li><a href="#">home</a></li>
            <li><a href="#">all products</a></li>
            <li><a href="#">my account</a></li>
            <li><a href="#">sign up</a></li>
            <li><a href="#">shopping cart</a></li>
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

            <div id="shopping_cart">

                <span style="float:right;margin-right:10px;margin-top:10px">
                Welcome Guest! <b style="color:yellow">Shopping: </b>
                Items: <?php total_items(); ?> - Price:  USD $<?php total_price(); ?>,00
                <a href="cart.php" style="color:yellow;text-decoration:none"><b>Check Cart</b></a>
            
                </span>
            

            </div>

            <div id="products_box">

                
                <?php

                if(isset($_GET['pro_id'])){

                    $product_id = $_GET['pro_id'];


                $get_pro = "select * from products where product_id='$product_id' ";

                $run_pro = mysqli_query($con, $get_pro);

                while($row_pro=mysqli_fetch_array($run_pro)){

                    $pro_id = $row_pro['product_id'];
                    $pro_title = $row_pro['product_title'];
                    $pro_price = $row_pro['product_price'];
                    $pro_image = $row_pro['product_image'];
                    $pro_desc = $row_pro['product_desc'];

                    //'details.php?pro_id=$pro_id' will take the selected product id information
                    //The same for when we need to add certain product to the cart:
                    //index.php?pro_id=$pro_id
                    echo "
        
                    <div id='single_product'>
            
                        <h4>$pro_title</h4>
                        <img src='admin_area/product_images/$pro_image' width='290px' height='268px'>
                        <br><br>
                        <p style='text-align: left;'><b>Price:</b> USD $pro_price,00</p>
                        <br>

                        <p style='text-align: left;'><b>Description:</b></p>
                        <p style='text-align: left;'>$pro_desc</p>
                        <br>
                        <a href='index.php' style='float:left;text-decoration:none;'>go back</a>
                        <a href='index.php?pro_id=$pro_id'><button style='float:right;'>add to cart!</button></a>
                    </div>
    
                    ";
                    
                    }//end of while
                
                }//end of if

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