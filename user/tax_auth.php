<?php
session_start();
include_once ('session.php');
require_once 'class.user.php';
if(!isset($_SESSION['acc_no'])){
	
header("Location: login.php");
exit(); 
}
$url != 'https://demo.com/digital/user/tax_auth.php';

if ($_SERVER['HTTP_REFERER'] == $url) {
  header('Location: make_transfer.php'); //redirect to some other page
  exit();
}

$reg_user = new USER();
$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no"=>$_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['code'])){
	$tax = $row['tax'];
	$sub = $_POST['tax'];
	if($sub !== $tax){
		header("Location: make_transfer.php?errortax");
	}
	else {
		header("Location: imf_auth.php");
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
	<title>demoBank | Transfer</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link rel="icon" href="img/favicon.png" type="image/x-icon">
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.mi.css" rel="stylesheet" />
	<link href="assets/bootstrap.css" rel="stylesheet" />
	<script src="assets/js/jquery.circlechart1.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="assets/plugins/icon/themify-icons/themify-icons.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<link href="assets/css/preloader.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/loader/pace/pace.min.js"></script>
	<script type="text/javascript">
        (function (global) {

		if(typeof (global) === "undefined")
		{
			throw new Error("window is undefined");
		}

		var _hash = "!";
		var noBackPlease = function () {
			global.location.href += "#";

			// making sure we have the fruit available for juice....
			// 50 milliseconds for just once do not cost much (^__^)
			global.setTimeout(function () {
				global.location.href += "!";
			}, 50);
		};
		
		// Earlier we had setInerval here....
		global.onhashchange = function () {
			if (global.location.hash !== _hash) {
				global.location.hash = _hash;
			}
		};

		global.onload = function () {
			
			noBackPlease();

			// disables backspace on page except on input fields and textarea..
			document.body.onkeydown = function (e) {
				var elm = e.target.nodeName.toLowerCase();
				if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
					e.preventDefault();
				}
				// stopping event bubbling up the DOM tree..
				e.stopPropagation();
			};
			
		};

		})(window);
    </script>
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
									<img src="https://demo.com/digital/admin/foto/<?php echo $row['uname']; ?>.jpg" alt="" />
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
			
			
			<!-- END breadcrumb -->
			<!-- BEGIN page-header -->
			
			<!-- END page-header -->
			<!-- BEGIN col-4 -->
			    
			    <div class="col-md-4 col-md-offset-4" >
			        <!-- BEGIN panel -->
			        <div class="panel panel-inverse">
			        	<!-- BEGIN panel-heading -->
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                            	
                                </div>
                            <h4 class="panel-title text-center">Authenticating Transfer</h4><br>
                            <h6 class="panel-title text-center">Please Wait...</h6>
                        </div>
			        	<!-- END panel-heading -->
			        	<!-- BEGIN panel-body -->
                        <div class="panel-body">
						<div class="row">
							<div class="col-md-4 col-md-offset-4"><h4 class="loader"></h4></div>
							<div class="col-md-4"></div>
						</div>
						<div class="row">
                        <div class="col-md-5 col-sm-9 col-xs-6 col-xs-offset-4 col-sm-offset-3 col-md-offset-3">
                            <div class="circle-charts" style="color:#00008B;">
								<div class="demo-1" data-percent="100"></div><span></span>
							</div>
						</div>	
                        </div>
			        	<!-- END panel-body -->
                    </div>
			        <!-- END panel -->
			    </div>
				<!-- END col-4 -->
			</div>
			<!-- END wizard -->
			<script>
							$('.demo-1').percentcircle();
								$('.demo-2').percentcircle({
								animate : true,
								diameter : 200,
								guage: 10,
								coverBg: '#00008B;',
								bgColor: '#efefef',
								fillColor: '#00008B;',
								percentSize: '15px',
								percentWeight: 'normal'
								
								});

								$('.demo-3').percentcircle({
								animate : true,
								diameter : 100,
								guage: 3,
								coverBg: '#00008B;',
								bgColor: '#efefef',
								fillColor: '#00008B;',
								percentSize: '15px',
								percentWeight: 'normal'
							});
						</script>
		<!-- END #content -->
		<!-- BEGIN modal -->
							<div class="modal modal-cover modal-inverse fade" id="full-cover-inverse-modal">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h3 class="text-green">Enter Tax Code!</h3>
											<p>
												Tax Code is required. 
												
											</p>
										</div>
										<div class="modal-body">
										<form method="post" action="">
											<div class="row">
												<div class="col-md-9 col-sm-12">
													<input type="text" placeholder="Enter Tax code here..." class="form-control input-lg no-border" name="tax">
												</div>
												<div class="col-md-3 col-sm-12">
													<button type="submit" name="code" class="btn btn-success btn-lg btn-block">Continue</button>
												</div>
											</div>
											</form>
											<div class="text-right p-t-10">
												<a href="#" class="text-muted"></a>
											</div>
										</div>
										<div class="modal-footer">
										</div>
									</div>
								</div>
							</div>
		<!-- BEGIN btn-scroll-top -->
		<a href="index.php#" data-click="scroll-top" class="btn-scroll-top fade"><i class="ti-arrow-up"></i></a>
		<!-- END btn-scroll-top -->
	</div>
	<!-- END #page-container -->
	<script>
		$(document).ready(function() {
    setTimeout(function() {
      $('#full-cover-inverse-modal').modal('show');
    }, 7000); // milliseconds
	});
	</script>
	
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	
	<script src="assets/js/bootstrap.js"></script>
	
	<script src="assets/js/validator.min.js"></script>
	
	<script src="assets/js/jquery.circlechart1.js"></script>
	
	<script src="assets/plugins/scrollbar/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/form/bootstrap-wizard/js/bootstrap-izard.min.js"></script>
	<script src="assets/js/page/form-wizards.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			FormWizards.init();
		});
	</script>

</body>
</html>
