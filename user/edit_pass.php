<?php
session_start();
include_once ('session.php');
require_once 'class.user.php';
if(!isset($_SESSION['acc_no'])){
	
header("Location: login.php");
exit(); 
}


$reg_user = new USER();

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no"=>$_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if($stat == 'Dormant/Inactive'){
	header('Location: index.php?dormant');
	exit();
}
if(isset($_POST['reset-pass']))
		{
			$pass = $_POST['upass1'];
			$cpass = $_POST['upass'];
			
			if($cpass!==$pass)
			{
				$msg = "<div class='alert alert-danger'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Sorry!</strong>  Passwords Doesn't match. 
						</div>";
			}
			else
			{
				$password = md5($cpass);
				$stmt = $reg_user->runQuery("UPDATE account SET upass=:upass WHERE acc_no=:acc_no");
				$stmt->execute(array(":upass"=>$password,":acc_no"=>$_SESSION['acc_no']));
				
				$msg = "<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						Password Changed!
						</div>";
				
			}
		}	
	
	
include_once ('counter.php');
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title> demoBank | Edit Password</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link rel="icon" href="img/favicon.png" type="image/x-icon">
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="assets/plugins/icon/themify-icons/themify-icons.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	<link href="assets/plugins/form/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" />
	<link href="assets/plugins/form/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="assets/plugins/form/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="assets/plugins/form/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="assets/plugins/form/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="assets/plugins/form/bootstrap-slider/css/bootstrap-slider.css" rel="stylesheet" />
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/loader/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- BEGIN #page-container -->
	<div id="page-container" class="page-header-fixed page-sidebar-fixed">
		<!-- BEGIN #header -->
		<div id="header" class="header navbar navbar-inverse navbar-fixed-top">
			<!-- BEGIN container-fluid -->
			<div class="container-fluid">
				<!-- BEGIN mobile sidebar expand / collapse button -->
				<div class="navbar-header">
				<a href="index.php" class="navbar-brand"><img src="img/logo.png"></a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled" >
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- END mobile sidebar expand / collapse button -->
				<!-- BEGIN header navigation right -->
				<div class="navbar-xs-justified"  style="background-color:#00008B;">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="javascript:;" data-toggle="dropdown">
								<span class="navbar-user-img online pull-right">
									<img src="https://demo.com/admin/foto/<?php echo $row['uname']; ?>.jpg"  />
												</span>
								<span class="hidden-xs "><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="profile.php">My Profile</a></li>
								<li class="divider"></li>
								<li><a href="edit_pass.php">Change Password</a></li>
								<li class="divider"></li>
								<li><a href="logout.php">Log Out</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- END header navigation right -->
			</div>
			<!-- END container-fluid -->
			<!-- BEGIN header-search-bar -->
			
			<!-- END header-search-bar -->
		</div>
		<!-- END #header -->
		
		<!-- BEGIN #sidebar -->
		<div id="sidebar" class="sidebar sidebar-inverse">
			<!-- BEGIN scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- BEGIN nav -->
				<ul class="nav">
					
					<li class="active"><a href="index.php"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
				
					<li class="nav-divider"></li>
					<li class="nav-header">Messaging</li>
					<li class="has-sub">
						<a href="inbox.php">
						    <i class="fa fa-envelope-o"></i> 
							<span>Messages <span class="notification"><?php printf("%d\n",$rowcount) ?></span></span>
						</a>
						
					</li>
					<li><a href="ticket.php"><i class="fa fa-comments-o"></i><span>Tickets</span></a></li>
					<li class="nav-header">Transactions</li>
					<li><a href="make_transfer.php"><i class="fa fa-money"></i><span>Make Transfer</span></a></li>
					<li>
						<a href="history.php">
						    <i class="fa fa-credit-card"></i>
						    <span>Transfer History</span> 
						</a>
					</li>
					<li>

						<a href="transact_summary.php">

						    <i class="fa fa-list"></i>

						    <span>Transaction Summary</span> 

						</a>

					</li>
					<li class="nav-divider"></li>
					<li class="nav-header">My Account</li>
					<li><a href="profile.php"><i class="fa fa-vcard"></i><span>My Profile</span></a></li>
					<li><a href="edit_profile.php"><i class="fa fa-edit"></i> <span>Edit Profile</span></a></li>
					<li><a href="edit_pass.php"><i class="fa fa-key"></i> <span>Change Password</span></a></li>
					
					
					
					<li class="nav-divider"></li>
					<li class="nav-copyright"><img src="img/logo.png" height="90px" width="100px" class="img-responsive"/></li>
					<li class="nav-copyright">&copy; 2019 demoBank Inc.  </li>
					
					
				</ul>
				<!-- END nav -->
			</div>
			<!-- END scrollbar -->
		</div>
		<!-- END #sidebar -->
		
		<!-- BEGIN #content -->
		<div id="content" class="content">
			
			
			<!-- BEGIN row -->
			<div class="row">
				<div class="col-md-6">
			    	
			    	<!-- BEGIN panel -->
			    	<div class="panel panel-default">
			    		<!-- BEGIN panel-heading -->
			    		<div class="panel-heading">
			    			<h3 class="panel-title">Change Password</h3><br>
			    		</div>
			    		<!-- END panel-heading -->
			    		<!-- BEGIN panel-body -->
						<form method="POST">
						<div class="panel-body">
							<?php if(isset($msg)){ echo $msg;}?>
						<p class="desc">Update your password below</p>
								<div class="form-group">
									<label class="control-label">Old Password</label>
									<div class="input-group date" >
										<input type="password" class="form-control" name="" placeholder="********" />
										<span class="input-group-addon"><i class="fa fa-key"></i></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">New Password </label>
									<div class="input-group date" >
										<input type="password" class="form-control" name="upass1" placeholder="********" />
										<span class="input-group-addon"><i class="fa fa-key"></i></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Retype New Password </label>
									<div class="input-group date" >
										<input type="password" class="form-control" name="upass" placeholder="********" />
										<span class="input-group-addon"><i class="fa fa-key"></i></span>
									</div>
								</div>
								<div class="form-group">
									<input type="submit" class="btn btn-primary" name="reset-pass" value="Update Password">
								</div>
						</div>
						</form>
			    		<!-- END panel-body -->
					</div>
			    	<!-- END panel -->
			    	
				</div>
				<!-- BEGIN col-3 -->
				
		</div>
		<!-- END #content -->
		
		<!-- BEGIN btn-scroll-top -->
		<a href="index.php#" data-click="scroll-top" class="btn-scroll-top fade"><i class="ti-arrow-up"></i></a>
		<!-- END btn-scroll-top -->
	</div>
	<!-- END #page-container -->
	
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/plugins/cookie/js/js.cookie.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/plugins/scrollbar/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/form/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="assets/plugins/form/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="assets/plugins/form/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="assets/plugins/form/bootstrap-typeahead/js/bootstrap-typeahead.min.js"></script>
	<script src="assets/plugins/form/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
	<script src="assets/plugins/form/bootstrap-slider/js/bootstrap-slider.min.js"></script>
	<script src="assets/plugins/form/bootstrap-select/js/bootstrap-select.min.js"></script>
	<script src="assets/plugins/form/masked-input/js/masked-input.min.js"></script>
	<script src="assets/plugins/form/pwstrength/js/pwstrength.js"></script>
	<script src="assets/js/page/form-plugins.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			FormPlugins.init();
		});
	</script>
	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/5a5a87004b401e45400c119c/default';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
	</script>
	<!--End of Tawk.to Script-->
</body>
</html>
