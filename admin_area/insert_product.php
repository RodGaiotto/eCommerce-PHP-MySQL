<!DOCTYPE>
<?php
//Including the db connection php file
include("./includes/db.php");
?>

<html>
    <head>
    
    <title>Inserting Products</title>
   
    </head>

<body>

    <form action="insert_product.php" method="POST" enctype="multipart/form-data">

        <table align="center" width="500px" border="0px">

            <tr>
                <td colspan="7"><h3>Insert new product here:</h3></td> 
            </tr>
            <tr>
                <td align="right">Product Title:</td>
                <td><input type="text" name="product_title" size="40" required></td>
            </tr>
            <tr>
                <td align="right">Product Category:</td>
                    <td>
                        <select name="product_cat">
                        <option>Select a Category</option>
                        <?php
                        //The entry in PHP here could as in the index.php
                        //be a function in the function.php files
                        $get_cats = "select * from categories";

                        //Making the query
                        //1st connect using $con
                        //2nd applying the query
                        $run_cats = mysqli_query($con, $get_cats);
                    
                        //Loop to extract what is comming from the DB
                        while ($row_cats=mysqli_fetch_array($run_cats)){
                    
                        $cat_id = $row_cats['cat_id'];
                        $cat_title = $row_cats['cat_title'];
                    
                        echo "<option value='$cat_id'>$cat_title</option>";
                        }
                        ?>
                        </select>
                    </td>
            </tr>
            <tr>
                <td align="right">Product Brand:</td>
                    <td>
                        <select name="product_brand">
                        <option>Select a Brand</option>
                        <?php
                        //The entry in PHP here could as in the index.php
                        //be a function in the function.php files
                        $get_brands = "select * from brands";

                        //Making the query
                        //1st connect using $con
                        //2nd applying the query
                        $run_brands = mysqli_query($con, $get_brands);
                    
                        //Loop to extract what is comming from the DB
                        while ($row_brands=mysqli_fetch_array($run_brands)){
                    
                        $brand_id = $row_brands['brand_id'];
                        $brand_title = $row_brands['brand_title'];
                    
                        echo "<option value='$brand_id'>$brand_title</option>";
                        }
                        ?>
                        </select>
                     </td>
            </tr>
            <tr>
                <td align="right">Product Image:</td>
                <td><input type="file" name="product_image"></td>
            </tr>
            <tr>
                <td align="right">Product Price:</td>
                <td><input type="text" name="product_price" required></td>
            </tr>
            <tr>
                <td align="right">Product Description:</td>
                <td><textarea name="product_desc" cols="30" rows="5" required></textarea></td>
            </tr>

            <tr>
                <td align="right">Product Keywords</td>
                <td><input type="text" name="product_wk" size="40"></td>
            </tr>

            <tr align="center">
                <td colspan="7"><input type="submit" name="insert_post" value="Submit"></td>
            </tr>

        </table>
    </form>

</body>

</html>

<?php
    if(isset($_POST['insert_post'])){

        //receiving data from the HTML name tags in the form, to the
        //PHP variables from the $_POST
        $produt_title = $_POST['product_title'];
        $product_cat = $_POST['product_cat'];
        $product_brand = $_POST['product_brand'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_desc'];
        $product_wk = $_POST['product_wk'];
        

        //getting the image
        $product_image = $_FILES['product_image']['name'];
        $product_image_tmp = $_FILES['product_image']['tmp_name'];

        //uploading the image to the folder product_images
        move_uploaded_file ($product_image_tmp, "product_images/$product_image");


        $insert_product = "insert into products 
        (product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords) values 
        ('$product_cat','$product_brand','$produt_title','$product_price','$product_desc','$product_image','$product_wk')";
        
        $pushing_products = mysqli_query($con, $insert_product);

        if($pushing_products){

            //In case of future errors change index.php?insert_product for insert_product.php
            echo "<script>alert('Product successfully added')</script>";
            echo "<script>window.open('index.php?insert_product','_self')</script>";

        }
        
    }



?>