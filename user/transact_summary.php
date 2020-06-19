<?php
session_start();
include_once ('session.php');
require_once 'class.user.php';
if(!isset($_SESSION["acc_no"])){
	
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
include_once ('counter.php');
?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>demoBank | Transaction History</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link rel="icon" href="img/favicon.png" type="image/x-icon">
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link href="assets/plugins/icon/themify-icons/css/themify-icons.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	<!-- ================== BEGIN PAGE CSS STYLE ================== -->
	<link href="assets/plugins/table/DataTables/DataTables-1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/AutoFill-2.2.0/css/autoFill.bootstrap.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/Buttons-1.3.1/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/ColReorder-1.3.3/css/colReorder.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/FixedColumns-3.2.2/css/fixedColumns.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/FixedHeader-3.1.2/css/fixedHeader.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/KeyTable-2.2.1/css/keyTable.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/Responsive-2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/RowGroup-1.0.0/css/rowGroup.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/RowReorder-1.2.0/css/rowReorder.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/Scroller-1.4.2/css/scroller.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/Select-1.2.2/css/select.bootstrap.min.css" rel="stylesheet" />
	<!-- ================== END PAGE CSS STYLE ================== -->
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/loader/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<div id="page-container" class="page-header-fixed page-sidebar-fixed">

		<!-- BEGIN #header -->

		<div id="header" class="header navbar navbar-inverse navbar-fixed-top">

			<!-- BEGIN container-fluid -->

			<div class="container-fluid">

				<!-- BEGIN mobile sidebar expand / collapse button -->

				<div class="navbar-header">

				<a href="index.php"><img width="80px" height="50px" src="img/logo.png"></a>

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
			
			<!-- BEGIN page-header -->
			<h1 class="page-header">
				Transaction Summary <br><small>You can print or export this form on PDF and Excel format</small>
			</h1>
			<!-- END page-header -->
			
			<!-- BEGIN table -->
			<table id="datatables-default" class="table table-striped table-condensed table-bordered bg-white">
				<thead>
					<tr>
						<th class="no-sort" style="width:1%">#</th>
						
						<th style="white-space: nowrap">TYPE</th>
						<th style="white-space: nowrap">AMOUNT</th>
						<th style="white-space: nowrap">TO/FROM</th>
						<th style="white-space: nowrap">DESCRIPTION</th>
						<th style="white-space: nowrap">DATE/TIME</th>
						
						
					</tr>
				</thead>
				<tbody>
				<?php 
				$acc_no = $_SESSION['acc_no'];
				$debcre = $reg_user->runQuery("SELECT * FROM alerts WHERE uname = '$acc_no'");
				$debcre->execute();
				while($rows = $debcre->fetch(PDO::FETCH_ASSOC)){?>
					<tr>
						<td></td>
						<td><?php echo $rows['type']; ?></td>
						<td><?php echo $rows['amount']; ?></td>
						<td><?php echo $rows['sender_name']; ?></td>
						<td><?php echo $rows['remarks']; ?></td>
						<td><?php echo $rows['date']; ?> &nbsp;<?php echo $rows['time']; ?></td>
						
						
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<!-- END table -->
		</div>
		<!-- END #content -->
		
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
	<script src="assets/plugins/table/DataTables/JSZip-3.1.3/jszip.min.js"></script>
	<script src="assets/plugins/table/DataTables/pdfmake-0.1.27/build/pdfmake.min.js"></script>
	<script src="assets/plugins/table/DataTables/pdfmake-0.1.27/build/vfs_fonts.js"></script>
	<script src="assets/plugins/table/DataTables/DataTables-1.10.15/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/table/DataTables/DataTables-1.10.15/js/dataTables.bootstrap.min.js"></script>
	<script src="assets/plugins/table/DataTables/AutoFill-2.2.0/js/dataTables.autoFill.min.js"></script>
	<script src="assets/plugins/table/DataTables/AutoFill-2.2.0/js/autoFill.bootstrap.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/dataTables.buttons.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/buttons.bootstrap.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/buttons.colVis.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/buttons.flash.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/buttons.html5.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/buttons.print.min.js"></script>
	<script src="assets/plugins/table/DataTables/ColReorder-1.3.3/js/dataTables.colReorder.min.js"></script>
	<script src="assets/plugins/table/DataTables/FixedColumns-3.2.2/js/dataTables.fixedColumns.min.js"></script>
	<script src="assets/plugins/table/DataTables/FixedHeader-3.1.2/js/dataTables.fixedHeader.min.js"></script>
	<script src="assets/plugins/table/DataTables/KeyTable-2.2.1/js/dataTables.keyTable.min.js"></script>
	<script src="assets/plugins/table/DataTables/Responsive-2.1.1/js/dataTables.responsive.min.js"></script>
	<script src="assets/plugins/table/DataTables/Responsive-2.1.1/js/responsive.bootstrap.min.js"></script>
	<script src="assets/plugins/table/DataTables/RowGroup-1.0.0/js/dataTables.rowGroup.min.js"></script>
	<script src="assets/plugins/table/DataTables/RowReorder-1.2.0/js/dataTables.rowReorder.min.js"></script>
	<script src="assets/plugins/table/DataTables/Scroller-1.4.2/js/dataTables.scroller.min.js"></script>
	<script src="assets/plugins/table/DataTables/Select-1.2.2/js/dataTables.select.min.js"></script>
	<script src="assets/js/page/table-data.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			TableData.init();
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
