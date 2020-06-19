<?php
session_start();
require_once ('class.admin.php');
include_once ('session.php');

$reg_user = new USER();

if(!isset($_SESSION['email'])){
	
header("Location: login.php");

exit(); 
}

$stmt = $reg_user->runQuery("SELECT * FROM account");
$stmt->execute();

if(isset($_POST['set']))
{
	
	$uname = trim($_POST['uname']);
	$uname = strip_tags($uname);
	$uname = htmlspecialchars($uname);
	
	$status = trim($_POST['status']);
	$status = strip_tags($status);
	$status = htmlspecialchars($status);
	
			$set= $reg_user->runQuery("UPDATE account SET uname = '$uname', status = '$status' WHERE uname = '$uname'");
			$set->execute();
			
			$id = $reg_user->lasdID();		
			
			
			$msg= "<div class='alert alert-info'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Account Successfully Set to <b>$status</b>!</strong> 
			  </div>";	

}

?>
<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="format-detection" content="telephone=no">
        <meta charset="UTF-8">

        <meta name="description" content="">
        <meta name="keywords" content="">
		<link rel="icon" href="img/favicon.png" type="image/x-icon">

        <title>demoBank | Admin Panel - Settings</title>
            
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
    <body id="skin-blur-reddy">

        <header id="header" class="media">
            <a href="index.php" id="menu-toggle"></a> 
            <a class="logo pull-left" href="index.php"><img src="" class="img-responsive" alt=""></a>
            
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
                            <img class="profile-pic animated" src="img/logo.png" alt="Profile Pic">
                        </a>
                        <ul class="dropdown-menu profile-menu">
                            
                             <li><a href="logout.php">Sign Out</a><i class="right fa fa-sign-out fa-2x"></i></li>
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
                    <li class="dropdown">
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
					<li class="active">
                        <a class="sa-list-cog" href="settings.php">
                            <span class="menu-item">Settings</span>
                        </a>
                    </li>
                   
                </ul>

            </aside>
        
            <!-- Content -->
            <section id="content" class="container">
            <h4 class="page-title block-title">SETTINGS</h4>
			<?php if(isset($msg)) echo $msg;  ?> 
                <div class="block-area" id="tableHover">
                    <h3 class="block-title">Control Account Status</h3><br />
                
                
                <!-- Notification Drawer -->
                
               
               
                                
                <!-- Shortcuts -->
			
				<form method="POST">
                <div class="row">
					<div class="col-md-3 form-group">
						<label>Select Account</label>
						<select name="uname" class="form-control input-sm validate[required]">
						<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){?>
							<option value="<?php echo $row['uname']; ?>"><?php echo $row['fname']; ?> <?php echo $row['mname']; ?> <?php echo $row['lname']; ?></option>
						<?php } ?>
					   </select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 form-group">
						<label>Set Status</label>
						<select  name="status" class="form-control input-sm validate[required]">
							<option value="Active">Active</option>
							<option value="Dormant/Inactive">Dormant/Inactive</option>
							<option value="Closed">Closed</option>
							<option value="Disabled">Disabled</option>
						</select>
					</div>
                </div>
					<button type="submit" name="set" class="btn btn-md">Set</button>
				</form>
                <hr class="whiter" />
				<br />
				<article>
				<ul>
					<li><b>Active</b> <p> This means that the client can access all functions within his/her account</p></li>
					<li><b>Dormant/Inactive</b><p>A notice that the account is Dormant/Inactive will be shown on the client's dashboard. Also, he/she will not be able to make any transfers.</p></li>
					<li><b>Closed</b> <p> When the account is set to Closed, it brings up a message when the client tries to log in, saying that the account no longer exist.</p></li>
					<li><b>Disabled</b> <p> A client will be notified when they try logging in that their account has been disabled due to violation of terms. He will be advised to contact the customer care to rectify the issue.</p></li>
                </ul>
				</article>
                <!-- Quick Stats -->
                
		
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
		<script src="js/jquery-ui.min.js"></script> <!-- jQuery UI -->

        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Charts -->
        

        <script src="js/sparkline.min.js"></script> <!-- Sparkline - Tiny charts -->
        <script src="js/easypiechart.js"></script> <!-- EasyPieChart - Animated Pie Charts -->
        <script src="js/charts.js"></script> <!-- All the above chart related functions -->
		<script src="js/datetimepicker.min.js"></script> <!-- Date & Time Picker -->
		<script src="js/input-mask.min.js"></script> <!-- Input Mask -->
        <script src="js/icheck.js"></script> <!-- Custom Checkbox + Radio -->
        <script src="js/autosize.min.js"></script> <!-- Textare autosize -->
        <script src="js/toggler.min.js"></script> <!-- Toggler -->

        <!-- UX -->
        <script src="js/scroll.min.js"></script> <!-- Custom Scrollbar -->

        <!-- Other -->
        <script src="js/calendar.min.js"></script> <!-- Calendar -->
        <script src="js/feeds.min.js"></script> <!-- News Feeds -->
        

        <!-- All JS functions -->
        <script src="js/functions.js"></script>
		<script src="js/markdown.min.js"></script> <!-- Markdown Editor -->
		<script type="text/javascript">
            $(document).ready(function(){
                /* Tag Select */
                (function(){
                    /* Limited */
                    $(".tag-select-limited").chosen({
                        max_selected_options: 5
                    });
                    
                    /* Overflow */
                    $('.overflow').niceScroll();
                })();
                
                /* Input Masking - you can include your own way */
                (function(){
                    $('.mask-date').mask('00/00/0000');
                    $('.mask-time').mask('00:00:00');
                    $('.mask-date_time').mask('00/00/0000 00:00:00');
                    $('.mask-cep').mask('00000-000');
                    $('.mask-phone').mask('0000-0000');
                    $('.mask-phone_with_ddd').mask('(00) 0000-0000');
                    $('.mask-phone_us').mask('(000) 000-0000');
                    $('.mask-mixed').mask('AAA 000-S0S');
                    $('.mask-cpf').mask('000.000.000-00', {reverse: true});
                    $('.mask-money').mask('000,000,000,000,000.00', {reverse: true});
                    $('.mask-money2').mask("#.##0,00", {reverse: true, maxlength: false});
                    $('.mask-ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {translation: {'Z': {pattern: /[0-9]/, optional: true}}});
                    $('.mask-ip_address').mask('099.099.099.099');
                    $('.mask-percent').mask('##0,00%', {reverse: true});
                    $('.mask-credit_card').mask('0000 0000 0000 0000');
                })();
                
                /* Spinners */
                (function(){
                    //Basic
                    $('.spinner-1').spinedit();
                    
                    //Set Value
                    $('.spinner-2').spinedit('setValue', 100);
                    
                    //Set Minimum                    
                    $('.spinner-3').spinedit('setMinimum', -10);
                    
                    //Set Maximum                    
                    $('.spinner-4').spinedit('setMaxmum', 100);
                    
                    //Set Step
                    $('.spinner-5').spinedit('setStep', 10);
                    
                    //Set Number Of Decimals
                    $('.spinner-6').spinedit('setNumberOfDecimals', 2);
                })();
            });
        </script>
    </body>
</html>
