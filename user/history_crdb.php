<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Bank BNP Paribas | Transaction History</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
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
									<img src="assets/img/user.jpg" alt="" />
								</span>
								<span class="hidden-xs ">Asahd Khaled</span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="javascript:;">My Profile</a></li>
								<li class="divider"></li>
								<li><a href="javascript:;">Change Password</a></li>
								<li class="divider"></li>
								<li><a href="javascript:;">Log Out</a></li>
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
					
					<li class="active"><a href="index.html"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
				
					<li class="nav-divider"></li>
					<li class="nav-header">Messaging</li>
					<li class="has-sub">
						<a href="inbox.php">
						    <i class="fa fa-envelope-o"></i> 
							<span>Messages <span class="notification">3</span></span>
						</a>
						
					</li>
					<li><a href="chart.html"><i class="fa fa-comments-o"></i><span>Tickets</span></a></li>
					<li class="nav-header">Transactions</li>
					<li><a href="chart.html"><i class="fa fa-money"></i><span>Make Transfer</span></a></li>
					<li class="has-sub">
						<a href="javascript:;">
						    <b class="fa fa-caret-square-o-down pull-right"></b>
						    <i class="fa fa-list"></i>
						    <span>Transaction History</span> 
						</a>
						<ul class="sub-menu">
							<li><a href="history_crdb.php">Credit/Debit History</a></li>
							<li><a href="ui_typography.html">Transfer History</a></li>
							<li><a href="ui_bootstrap.html">View All History</a></li>
						</ul>
					</li>
					<li class="nav-divider"></li>
					<li class="nav-header">My Account</li>
					<li><a href="profile.html"><i class="fa fa-vcard"></i><span>My Profile</span></a></li>
					<li><a href="calendar.html"><i class="fa fa-edit"></i> <span>Edit Profile</span></a></li>
					<li><a href="calendar.html"><i class="fa fa-key"></i> <span>Change Password</span></a></li>
					<li><a href="helper.html"><i class="fa fa-handshake-o"></i><span>Help</span></a></li>
					
					
					<li class="nav-divider"></li>
					<li class="nav-copyright">&copy; 2019 BNP Paribas </li>
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
				Transaction History - Credit/Debit <br><small>You can export this form on PDF and Excel format</small>
			</h1>
			<!-- END page-header -->
			
			<!-- BEGIN table -->
			<table id="datatables-default" class="table table-striped table-condensed table-bordered bg-white">
				<thead>
					<tr>
						<th class="no-sort" style="width:1%">#</th>
						<th style="white-space: nowrap">SENDER'S NAME</th>
						<th style="white-space: nowrap">AMOUNT</th>
						<th style="white-space: nowrap">ACCOUNT CREDITED</th>
						<th style="white-space: nowrap">REMARKS</th>
						<th style="white-space: nowrap">DATE</th>
						<th style="white-space: nowrap">STATUS</th>
						<th class="no-sort" style="width:1%"></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1.</td>
						<td>Tiger Nixon</td>
						<td>$23,313</td>
						<td>65464535455</td>
						<td>Upfron on Web Project</td>
						<td>2019/04/25</td>
						<td>Successful</td>
						<td class="btn-col" style="white-space: nowrap">
							
							<a class="btn btn-default btn-xs"><i class="ti-close"></i></a>
						</td>
					</tr>
					<tr>
						<td>2.</td>
						<td>Garrett Winters</td>
						<td>$23,313</td>
						<td>65464535455</td>
						<td>Upfron on Web Project</td>
						<td>2019/04/25</td>
						<td>Successful</td>
						<td class="btn-col" style="white-space: nowrap">
							
							<a class="btn btn-default btn-xs"><i class="ti-close"></i></a>
						</td>
					</tr>
					
				</tbody>
			</table>
			<!-- END table -->
		</div>
		<!-- END #content -->
		
		<!-- BEGIN btn-scroll-top -->
		<a href="table_data.html#" data-click="scroll-top" class="btn-scroll-top fade"><i class="ti-arrow-up"></i></a>
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
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', '', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
