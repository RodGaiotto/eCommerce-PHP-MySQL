<!DOCTYPE>
<?php
session_start();
//Including the function php file
include("../functions/functions.php");
?>

<?php

                        //IF NOT LOGGED IN AS CHECKED BY !isset($_SESSION)
                        if(!isset($_SESSION['customer_email'])){
                    
                            //Then as the customer to login
                            echo "<a href='../checkout.php' style='color:orange;'>Login</a>";
                            
                            }
                            else {  
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
            <li><a href="../index.php">home</a></li>
            <li><a href="../all_products.php">all products</a></li>
            <li><a href="../customer/my_account.php">my account</a></li>
            <li><a href="#">sign up</a></li>
            <li><a href="../cart.php">shopping cart</a></li>
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
        
            <div id="sidebar_title">my account</div>

                <ul id="cats">

                <?php 
				$user = $_SESSION['customer_email'];
				
				$get_img = "select * from customers where customer_email='$user'";
				
				$run_img = mysqli_query($con, $get_img); 
				
				$row_img = mysqli_fetch_array($run_img); 
				
				$c_image = $row_img['customer_image'];
				
				$c_name = $row_img['customer_name'];
				
				echo "<p style='text-align:center;'><img src='customer_images/$c_image' width='150' height='150'/></p>";
				
				?>
                
                <li><a href="my_account.php?my_orders">my orders</a></li>
                <li><a href="my_account.php?edit_account">edit account</a></li>
                <li><a href="my_account.php?change_pass">ch password</a></li>
                <li><a href="my_account.php?delete_account">delete account</a></li>
                
                
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
					echo "<b>Welcome:</b>" . $_SESSION['customer_email'] ;
                    }
					
				?>

                       <?php

                        //IF NOT LOGGED IN AS CHECKED BY !isset($_SESSION)
                        if(!isset($_SESSION['customer_email'])){
                    
                            //Then as the customer to login
                            echo "<a href='../checkout.php' style='color:orange;'>Login</a>";
                            
                            }
                            else {

                            //Otherwise if already logged on:
                            echo "<a href='../logout.php' style='color:orange;'>Logout</a>";
                            }   
                    ?>


                </span>
            

            </div>

            <?php
            //Echoing the IP address to test the getIP function
            //echo $ip=getIp(); 
            ?>

            <div id="products_box">

            <?php 
				if(!isset($_GET['my_orders'])){
					if(!isset($_GET['edit_account'])){
						if(!isset($_GET['change_pass'])){
							if(!isset($_GET['delete_account'])){
							
				echo "
				<h3 style='padding:20px;'>Welcome:  $c_name </h3>
				<b>You can see your orders progress by clicking this <a href='my_account.php?my_orders'>link</a></b>";
				}
				}
				}
				}
				?>
				
				<?php

                //The statement "edit_account" will be received using $_GET method
                //from here <a href="my_account.php?edit_account">edit account</a>
                //When the link be accessed it will thru GET include the edit_account.php page
                //The same with the rest of the options
				if(isset($_GET['edit_account'])){
				include("edit_account.php");
				}
				if(isset($_GET['change_pass'])){
				include("change_pass.php");
				}
				if(isset($_GET['delete_account'])){
				include("delete_account.php");
				}
                
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