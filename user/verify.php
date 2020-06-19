<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>demoBank | Verify</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link rel="icon" href="img/favicon.png" type="image/x-icon">
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/icon/themify-icons/themify-icons.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/loader/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="inverse-mode" style="background-image: url(img/sunset.jpg); background-size:cover; background-attachment:fixed;">
	<!-- BEGIN #page-container -->
	<div id="page-container">
		<!-- BEGIN login -->
        <div class="login"><img src="img/logo.png" height="60" width="150" style="padding: 10px 10px; ">
		<b style="font-size:2.0em; color:#fff;"></b>
			<!-- BEGIN login-cover -->
			<div class="login-cover"></div>
			<!-- END login-cover -->
			<!-- BEGIN login-content -->
			<div class="login-content">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php 
				if(isset($_GET['inactive']))
				{
					?>
					<div class='alert alert-info col-4'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it. 
					</div>
			<?php
				}
			?>
			 <?php if(isset($msg)) echo $msg;  ?>
				<!-- BEGIN login-brand -->
				<div class="login-brand">
					<a href="#"><span class=" fa fa-lock logo"></i></span> Internet Banking</a>
				</div>
				<!-- END login-brand -->
				<!-- BEGIN login-desc -->
				<div class="login-desc">
					Please, insert the code that we sent to your phone
				</div>
				<!-- END login-desc -->
				<!-- BEGIN login-form -->
				<form method="POST">
					<div class="form-group">
						<label class="control-label">Verification Code</label>
						<input type="text" name="acc_no" class="form-control" placeholder="Enter your account no" autofocus />
						
					</div>
					
					</div>
					
					
					<button type="submit" name="login" href="index.php" class="btn btn-inverse">Verify &amp; Sign In</button>
				</form>
				<!-- END login-form --><br><br><br><br><br><br><br><br><br><br><br>
				<footer class="">
		&copy; 2019 demoBank Inc. All Rights Reserved.
			
		</footer>
			</div>
			<!-- END login-content -->
        </div>
        <!-- END login -->
		
		<!-- BEGIN btn-scroll-top -->
		<a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="ti-arrow-up"></i></a>
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
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>

</body>
</html>
