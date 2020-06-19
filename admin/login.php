<?php  //Start the Session

session_start();

 require('connectdb.php');
 require_once 'class.admin.php';
//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['email']) and isset($_POST['upass'])){
//3.1.1 Assigning posted values to variables.
$email = $_POST['email'];
$upass = $_POST['upass'];
$upass = md5($upass);
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT * FROM admin WHERE email='$email' and upass='$upass'";
 
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
if ($count == 1){
$_SESSION['email'] = $email;
}else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
$msg = "<div class='alert alert-danger'>
						<button class='close' data-dismiss='alert'>&times;</button>
						  Invalid Email or Password!
                   
			  </div>";
}
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['email'])){
$email = $_SESSION['email'];
header('Location: index.php');
 
}else{}
//3.2 When the user visits the page first time, simple login form will be displayed.
?>
<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="format-detection" content="telephone=no">
        <meta charset="UTF-8">

        <meta name="description" content="">
        <meta name="keywords" content="">
		<link rel="icon" href="img/favicon.png" type="image/x-icon">

        <title>demoBank | Admin Sign In</title>
            
        <!-- CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/animate.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/form.css" rel="stylesheet">
        <link href="css/calendar.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/icons.css" rel="stylesheet">
        <link href="css/generics.css" rel="stylesheet"> 
    </head>
    <body id="skin-blur-window">
		<div class="container">
		<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
        <section id="login" align="center">
            <header><br><br><br><br>
				<img src="img/logo.png" class="img-responsive">
                <br>
                <p>Enter your login detains to access Admin Page</p>
            </header>
				 <?php if(isset($msg)) echo $msg;  ?>
            <div class="clearfix"></div>
            
            <!-- Login -->
            <form class="box tile animated active" id="box-login" method="POST">
                <h3 class="m-t-0 m-b-15">Sign In</h3>
                <input type="text" class="login-control m-b-10" name="email" placeholder="Email Address" autofocus>
                <input type="password" class="login-control" name="upass" placeholder="Password">
                <div class="checkbox m-b-20">
                    <label>
                        <input type="checkbox">
                        Remember Me
                    </label>
                </div>
                <input class="btn btn-sm m-r-5" type="submit" value="Log In">
                
                <small>
                   
                    <a class="box-switcher" data-switch="box-reset" href="">Forgot Password?</a>
                </small>
            </form>
			</div>
			</div>
			</div>
        
        </section>                      
        
        <!-- Javascript Libraries -->
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script> <!-- jQuery Library -->
        
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        
        <!--  Form Related -->
        <script src="js/icheck.js"></script> <!-- Custom Checkbox + Radio -->
        
        <!-- All JS functions -->
        <script src="js/functions.js"></script>
    </body>
</html>
