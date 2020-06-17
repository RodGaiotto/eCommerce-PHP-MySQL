<?php
//session_start();
include("includes/db.php");
//include("functions/functions.php");

?>

<div>
    <form method="post" action="">
    
        <table width="500" align="center">
        
        <tr align="center">
            <td colspan="4"><h3>Login or Register to Buy</h3></td>
        </tr>
        
        <tr>
            <td>Email:</td>
            <td><input type="text" name="email" placeholder="enter email" required></td> 
        </tr>

        <tr>
            <td>Password:</td>
            <td><input type="password" name="pass" placeholder="enter password" required></td> 
        </tr>

        <tr>
            <td align="right" ><input type="submit" name="login" value="Login"></td>
            <td><button><a style="text-decoration:none" href="checkout.php?forgot_pass">Forgot Password?</a></button></td>
        </tr>
        </table>

        <h4><a href="customer_register.php">Click here to Register</a></h4>

    
    </form>

    <?php 
	if(isset($_POST['login'])){
	
		$c_email = $_POST['email'];
		$c_pass = $_POST['pass'];
		
		$sel_c = "select * from customers where customer_pass='$c_pass' AND customer_email='$c_email'";
		
		$run_c = mysqli_query($con, $sel_c);
		
		$check_customer = mysqli_num_rows($run_c); 
        
        //If the select query do no bring anything, then the login is invalid
		if($check_customer==0){
        
        //Message if the login is invalid
		echo "<script>alert('Password or email is incorrect, plz try again!')</script>";
		exit();
        }
        
        //Check the customer id IP
		$ip = getIp(); 
        
        //Check if there is any product in the cart associated with this customer
		$sel_cart = "select * from cart where ip_add='$ip'";
		
		$run_cart = mysqli_query($con, $sel_cart); 
		
		$check_cart = mysqli_num_rows($run_cart); 
		
		if($check_customer>0 AND $check_cart==0){
		
		$_SESSION['customer_email']=$c_email; 
		
		echo "<script>alert('You logged in successfully, Thanks!')</script>";
		echo "<script>window.open('customer/my_account.php','_self')</script>";
		
		}
		else {
		$_SESSION['customer_email']=$c_email; 
		
		echo "<script>alert('You logged in successfully, Thanks!')</script>";
		echo "<script>window.open('checkout.php','_self')</script>";
		
		
		}
	}
		
	?>


</div>