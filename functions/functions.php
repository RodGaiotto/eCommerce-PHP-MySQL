<?php

//Stablishing connection with the DataBase
$con = mysqli_connect("localhost","root","","ecommerce");


//Get visitors IP address with PHP
function getIp() {

    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

    }

    return $ip;
}



//FUNTION CART
function cart(){

    if(isset($_GET['add_cart'])){

        //Make connection with DB2 usable under this function
        global $con;

        //Receiving from the function getIP
        $ip = getIp();

        //Here we'll receive from the HTML add_cart:
        //<a href='index.php?add_cart=$pro_id'> thanks to the $_GET method function
        //the data will be stored in $pro_id variable
        $pro_id = $_GET['add_cart'];

        //check if other person is buying the same product
        $check_pro = "select * from cart where ip_add='$ip' AND p_id='$pro_id'";

        $run_check = mysqli_query($con, $check_pro);

        //if a record be found in the table
        if(mysqli_num_rows($run_check)>0) {

            echo "";

        }
        //then we can insert the product in the cart table
        else {

            //variable $pro_id comes from the _GET and $ip from the function
            $insert_pro = "insert into cart (p_id,ip_add) values ('$pro_id','$ip')";
            
            //inserting in the table
            $run_pro = mysqli_query($con, $insert_pro);

            echo "<script>window.open('index.php','_self')</script>";

        }
    }
}


//Getting the total added items
function total_items() {

    global $con;

    if(isset($_GET['add_cart'])){

        $ip = getIp();

        $get_items = "select * from cart where ip_add='$ip'";

        $run_items = mysqli_query($con, $get_items);

        $count_items = mysqli_num_rows($run_items);
    } 
    else {

        $ip = getIp();

        $get_items = "select * from cart where ip_add='$ip'";

        $run_items = mysqli_query($con, $get_items);

        $count_items = mysqli_num_rows($run_items);
    }

        echo $count_items;
}

//Getting the total price of the items in the cart
function total_price(){

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

            //calculating prices
            $values = array_sum($product_price);

            $total +=$values;

        }
    }

    echo $total;
}




//FUNCTION Getting CATEGORIES SIDE MENU
function getCats(){

    //Using the variable $con under the function
    global $con;

    //SQL query
    $get_cats = "select * from categories";

    //Making the query
    //1st connect using $con
    //2nd applying the query
    $run_cats = mysqli_query($con, $get_cats);

    //Loop to extract what is comming from the DB
    while ($row_cats=mysqli_fetch_array($run_cats)){

            $cat_id = $row_cats['cat_id'];
            $cat_title = $row_cats['cat_title'];

            //HERE LAYS THE INFORMATION THAT WILL BE CAPTURED BY THE 
            //METHOD GET by the function getCatPro()
            echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
    }
}

//FUNCTION Getting BRANDS SIDE MENU
function getBrands(){

    //Using the variable $con under the function
    global $con;

    //SQL query
    $get_brands = "select * from brands";

    //Making the query
    //1st connect using $con
    //2nd applying the query
    $run_brands = mysqli_query($con, $get_brands);

    //Loop to extract what is comming from the DB
    while ($row_brands=mysqli_fetch_array($run_brands)){

            $brand_id = $row_brands['brand_id'];
            $brand_title = $row_brands['brand_title'];

            //HERE LAYS THE INFORMATION THAT WILL BE CAPTURED BY THE 
            //METHOD GET by the function getBrandPro()
            echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
    }
}


//Showing the products in the CONTENT DIV in the index.php
function getPro(){

    //if not set for category or brand
    if(!isset($_GET['cat'])){
        if(!isset($_GET['brand'])){

    global $con;

    $get_pro = "select * from products order by RAND() LIMIT 0,6";

    $run_pro = mysqli_query($con, $get_pro);

    while($row_pro=mysqli_fetch_array($run_pro)){

        $pro_id = $row_pro['product_id'];
        $pro_cat = $row_pro['product_cat'];
        $pro_brand = $row_pro['product_brand'];
        $pro_title = $row_pro['product_title'];
        $pro_price = $row_pro['product_price'];
        $pro_image = $row_pro['product_image'];

        //'details.php?pro_id=$pro_id' will take the selected product id information
        //The same for when we need to add certain product to the cart:
        //index.php?pro_id=$pro_id
        echo "
        
            <div id='single_product'>
            
                <h4>$pro_title</h4>
                <img src='admin_area/product_images/$pro_image' width='190px' height='168px'>
                <p><b> USD $pro_price,00 </b></p>

                <a href='details.php?pro_id=$pro_id' style='float:left;text-decoration:none;'>details</a>
                <a href='index.php?add_cart=$pro_id'><button style='float:right;'>add to cart!</button></a>
            </div>
    
        ";
        }
      }   
    
    }

}


//FUNCTION TO FILTER THE PRODUCTS PER CATEGORY
function getCatPro(){

    //if set for category
    if(isset($_GET['cat'])){

        $cat_id = $_GET['cat'];

    global $con;

    $get_cat_pro = "select * from products WHERE product_cat='$cat_id'";

    $run_cat_pro = mysqli_query($con, $get_cat_pro);

    $count_cats = mysqli_num_rows($run_cat_pro);

    if($count_cats==0){

        echo "<br><br><br><h3>Sorry. There is no product in this category in stock.</h3>";
    }
        //test counting entries
        //echo "<h2>$count_cats</h2>";


    while($row_cat_pro=mysqli_fetch_array($run_cat_pro)){

        $pro_id = $row_cat_pro['product_id'];
        $pro_cat = $row_cat_pro['product_cat'];
        $pro_brand = $row_cat_pro['product_brand'];
        $pro_title = $row_cat_pro['product_title'];
        $pro_price = $row_cat_pro['product_price'];
        $pro_image = $row_cat_pro['product_image'];

        //'details.php?pro_id=$pro_id' will take the selected product id information
        //The same for when we need to add certain product to the cart:
        //index.php?pro_id=$pro_id
        echo "
        
            <div id='single_product'>
            
                <h4>$pro_title</h4>
                <img src='admin_area/product_images/$pro_image' width='190px' height='168px'>
                <p><b> USD $pro_price,00 </b></p>

                <a href='details.php?pro_id=$pro_id' style='float:left;text-decoration:none;'>details</a>
                <a href='index.php?add_cart=$pro_id'><button style='float:right;'>add to cart!</button></a>
            </div>
    
        ";
        }
      }   

}



//FUNCTION TO FILTER THE PRODUCTS PER BRAND
function getBrandPro(){

    //if set for category
    if(isset($_GET['brand'])){

        $brand_id = $_GET['brand'];

    global $con;

    $get_brand_pro = "select * from products WHERE product_brand='$brand_id'";

    $run_brand_pro = mysqli_query($con, $get_brand_pro);

    $count_brand = mysqli_num_rows($run_brand_pro);

    if($count_brand==0){

        echo "<br><br><br><h3>Sorry. There is no product for this brand in stock.</h3>";
    }
        //test counting entries
        //echo "<h2>$count_brand</h2>";

    while($row_brand_pro=mysqli_fetch_array($run_brand_pro)){

        $pro_id = $row_brand_pro['product_id'];
        $pro_cat = $row_brand_pro['product_cat'];
        $pro_brand = $row_brand_pro['product_brand'];
        $pro_title = $row_brand_pro['product_title'];
        $pro_price = $row_brand_pro['product_price'];
        $pro_image = $row_brand_pro['product_image'];

        //'details.php?pro_id=$pro_id' will take the selected product id information
        //The same for when we need to add certain product to the cart:
        //index.php?pro_id=$pro_id
        echo "
        
            <div id='single_product'>
            
                <h4>$pro_title</h4>
                <img src='admin_area/product_images/$pro_image' width='190px' height='168px'>
                <p><b> USD $pro_price,00 </b></p>

                <a href='details.php?pro_id=$pro_id' style='float:left;text-decoration:none;'>details</a>
                <a href='index.php?add_cart=$pro_id'><button style='float:right;'>add to cart!</button></a>
            </div>
    
        ";
        }
      }   

}


?>