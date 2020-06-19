<?php
session_start();
require_once 'class.admin.php';
include_once ('session.php');
if(!isset($_SESSION['email'])){
	
header("Location: login.php");

exit(); 
}
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg");
      
      if(in_array($file_ext,$expensions)=== false){
        $errors = "
					<div class='alert alert-warning'>
						<button class='close' data-dismiss='alert'>&times;</button>
						  You have not selected any image, please select a JPG image
                   
			  		</div>
					";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"foto/".$file_name);
         $msg = "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						  Image Successfully Uploaded!
                   
			  		</div>
					";
      }else{
         print_r($errors);
      }
   }
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

        <title>demoBank | Admin - Create Account</title>
            
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
    <body id="skin-blur-nexus">

        <header id="header" class="media">
            <a href="index.php" id="menu-toggle"></a> 
            <a class="logo pull-left" href="#"><img src="" class="img-responsive" alt=""></a>
            
            <div class="media-body">
                <div class="media" id="top-menu">
                    
                    <div id="time" class="pull-right">
                        <span id="hours"></span>
                        :
                        <span id="min"></span>
                        :
                        <span id="sec"></span>
                    </div>
                    
                    
                </div>
            </div>
        </header>
        
        <div class="clearfix"></div>
        
        <section id="main" class="p-relative" role="main">
            
             <!-- Sidebar -->
            <aside id="sidebar">
                
                <!-- Sidbar Widgets -->
                <div class="side-widgets overflow">
                    <!-- Profile Menu -->
                    <div class="text-center s-widget m-b-25 dropdown" id="profile-menu">
                        <a href="index.php" data-toggle="dropdown">
                            <img class="profile-pic animated" src="img/logo.png" alt="">
                        </a>
                        <ul class="dropdown-menu profile-menu">
                            
                            <li><a href="logout.php">Sign Out</a> <i class="fa fa-sign-out icon left">&#61903;</i><i class="icon right fa fa-sign-out">&#61815;</i></li>
							<li><a href="#edit" data-toggle="modal">Edit Profile</a><i class="right fa fa-edit fa-2x"></i></li>
						</ul>
                        <h4 class="m-0">demoBank</h4>
                      
                    </div>
                    
                    <!-- Calendar -->
                    <div class="s-widget m-b-25">
                        <div id="sidebar-calendar"></div>
                    </div>
                    
                    <!-- Feeds -->
                    <div class="s-widget m-b-25">
                        <h2 class="tile-title">
                           Developer Info
                        </h2>
						<div class="">
                        
                        <p><i class="fa fa-skype fa-2x"></i> williams</p>
						</div>
                        <div class="s-widget-body">
                            <div id="news-feed"></div>
                        </div>
                    </div>
                    
                    <!-- Projects -->
                     
                </div>
                
                <!-- Side Menu -->
                <ul class="list-unstyled side-menu">
                    <li>
                        <a class="sa-side-home" href="index.php">
                            <span class="menu-item">Dashboard</span>
                        </a>
                    </li>
                    <li class="dropdown active"">
                        <a class="sa-list-vcard" href="">
                            <span class="menu-item">Accounts</span>
                        </a>
						<ul class="list-unstyled menu-item">
                            <li><a href="create_account.php">Create Account</a></li>
                            <li><a href="view_account.php">View Accounts</a></li>
                            <li><a href="update.php">Update Accounts</a></li>
							<li><a href="upload.php">Upload Image</a></li>
							
                        </ul>
                    </li>
                    <li>
                        <a class="sa-list-secret" href="pending_accounts.php">
                            <span class="menu-item">Pending Accounts</span>
                        </a>
                    </li>
                    <li>
                        <a class="sa-top-message" href="messages.php">
                            <span class="menu-item">Messages</span>
                        </a>
                    </li>
					<li>
                        <a class="sa-list-comment" href="tickets.php">
                            <span class="menu-item">Tickets</span>
                        </a>
                    </li>
					<li>
                        <a class="sa-list-database" href="credit_debit_list.php">
                            <span class="menu-item">Credit/Debit History</span>
                        </a>
                    </li>
					<li>
                        <a class="sa-list-cc" href="transfer_rec.php">
                            <span class="menu-item">Transaction Records</span>
                        </a>
                    </li>
					<li>
                        <a class="sa-list-cog" href="settings.php">
                            <span class="menu-item">Settings</span>
                        </a>
                    </li>
                   
                   
                </ul>

            </aside>
			<section id="content" class="container">
			<h4 class="page-title block-title">Upload Image</h4>
                             
                <!-- Required Feilds -->
                <div class="block-area" id="required">  <?php if(isset($msg)) echo $msg;  ?> <?php if(isset($msger)) echo $msger;  ?> 
                    <h4 class="">Please, make sure the image is a '.jpg' file and saved with account username</h4>
                    
				  <fieldset>
					
					<form action="" method="POST" enctype="multipart/form-data">
                        
						<div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-preview thumbnail form-control"></div>
                        
							<div>
								<span class="btn btn-file btn-alt btn-sm">
									<span class="fileupload-new">Select image</span>
									<span class="fileupload-exists">Change</span>
									<input type="file" accept="image/jpeg" name="image"/>
								</span>
								<a href="#" class="btn fileupload-exists btn-sm" data-dismiss="fileupload">Remove</a>
							</div>
						</div>
                       
							<input class="btn btn-md fileupload-new" type="submit" value="Upload Image">
                        
                    </form>
					</fieldset>
                        
                </div>
                
                <hr class="whiter m-t-20" />
			</section>
          

            <!-- Older IE Message -->
            <!--[if lt IE 9]>
                <div class="ie-block">
                    <h1 class="Ops">Ooops!</h1>
                    <p>You are using an outdated version of Internet Explorer, upgrade to any of the following web browser in order to access the maximum functionality of this website. </p>
                    <ul class="browsers">
                        <li>
                            <a href="https://www.google.com/intl/en/chrome/browser/">
                                <img src="img/browsers/chrome.png" alt="">
                                <div>Google Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.mozilla.org/en-US/firefox/new/">
                                <img src="img/browsers/firefox.png" alt="">
                                <div>Mozilla firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com/computer/windows">
                                <img src="img/browsers/opera.png" alt="">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://safari.en.softonic.com/">
                                <img src="img/browsers/safari.png" alt="">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/downloads/ie-10/worldwide-languages">
                                <img src="img/browsers/ie.png" alt="">
                                <div>Internet Explorer(New)</div>
                            </a>
                        </li>
                    </ul>
                    <p>Upgrade your browser for a Safer and Faster web experience. <br/>Thank you for your patience...</p>
                </div>   
            <![endif]-->
        </section>
        
        <!-- Javascript Libraries -->
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script> <!-- jQuery Library -->
       

        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Charts -->
        <script src="js/validation/validate.min.js"></script> <!-- jQuery Form Validation Library -->
        <script src="js/validation/validationEngine.min.js"></script> <!-- jQuery Form Validation Library - requirred with above js -->
		<script src="js/sparkline.min.js"></script> <!-- Sparkline - Tiny charts -->
        <script src="js/easypiechart.js"></script> <!-- EasyPieChart - Animated Pie Charts -->
        <script src="js/charts.js"></script> <!-- All the above chart related functions -->
		<script src="js/datetimepicker.min.js"></script> <!-- Date & Time Picker -->
		<script src="js/fileupload.min.js"></script> <!-- File Upload -->
        

        <!-- UX -->
        <script src="js/scroll.min.js"></script> <!-- Custom Scrollbar -->

        <!-- Other -->
        <script src="js/calendar.min.js"></script> <!-- Calendar -->
        <script src="js/feeds.min.js"></script> <!-- News Feeds -->
        

        <!-- All JS functions -->
        <script src="js/functions.js"></script>
    </body>
</html>

