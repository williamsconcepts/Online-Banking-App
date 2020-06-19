<?php session_start();
include_once ('session.php');
require_once ('class.user.php');
if(!isset($_SESSION['acc_no'])){
header("Location: login.php");
exit();
}
$reg_user = new USER();

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no"=>$_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

include_once ('counter.php');?>
    <!DOCTYPE html>
    <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
    <!--[if !IE]><!-->
    <html lang="en">
    <!--<![endif]-->

    <head>
        <meta charset="utf-8" />
        <title>demoBank | My Profile</title>
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
                       <a href="index.php"><img width="80px" height="50px" src="img/logo.png"></a>
                        <button type="button" class="navbar-toggle" data-click="sidebar-toggled"> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    </div>
                    <!-- END mobile sidebar expand / collapse button -->
                    <!-- BEGIN header navigation right -->
                    <div class="navbar-xs-justified" style="background-color:#00008B;">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="javascript:;" data-toggle="dropdown"> <span class="navbar-user-img online pull-right">	
								<img src="../foto/<?php echo $row['uname']; ?>.jpg"  />												</span> <span class="hidden-xs "><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></span> </a>
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
                            <a href="inbox.php"> <i class="fa fa-envelope-o"></i> <span>Messages <span class="notification"><?php printf("%d\n",$rowcount) ?></span></span>
                            </a>
                        </li>
                        <li><a href="ticket.php"><i class="fa fa-comments-o"></i><span>Tickets</span></a></li>
                        <li class="nav-header">Transactions</li>
                        <li><a href="make_transfer.php"><i class="fa fa-money"></i><span>Make Transfer</span></a></li>
                        <li>
                            <a href="history.php"> <i class="fa fa-credit-card"></i> <span>Transfer History</span> </a>
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
            <div id="content" class="content p-0">
                <!-- BEGIN profile-header -->
                <div class="profile-header">
                    <!-- BEGIN profile-header-cover -->
                    <div class="profile-header-cover"></div>
                    <!-- END profile-header-cover -->
                    <!-- BEGIN profile-header-content -->
                    <div class="profile-header-content">
                        <!-- BEGIN profile-header-img -->
                        <div class="profile-header-img"> <img src="https://demo.com/admin/foto/<?php echo $row['uname']; ?>.jpg" class="img-responsive" alt="profile picture" /> </div>
                        <!-- END profile-header-img -->
                        <!-- BEGIN profile-header-info -->
                        <div class="profile-header-info">
                            <h4><?php echo $row['fname']; ?> <?php echo $row['mname']; ?> <?php echo $row['lname']; ?></h4>
                            <p>
                                <?php echo $row['status']; ?>
                            </p> <a href="edit_profile.php" class="btn btn-xs btn-primary">Edit Profile</a> </div>
                        <!-- END profile-header-info -->
                    </div>
                    <!-- END profile-header-content -->
                    <!-- BEGIN profile-header-tab -->
                    <ul class="profile-header-tab">
                        <li></li>
                    </ul>
                    <!-- END profile-header-tab -->
                </div>
                <!-- END profile-header -->
                <!-- BEGIN profile-container -->
                <div class="profile-container">
                    <!-- BEGIN row -->
                    <div class="row row-space-20">
                        <!-- BEGIN col-8 -->
                        <!-- BEGIN col-4 -->
                        <!-- BEGIN profile-info-list -->
                        <ul class="profile-info-list">
                            <li class="title">
                                <h3>ACCOUNT INFORMATION</h3></li>
                            <div class="col-md-4 col-xs-6 col-ms-6">
                                <li>
                                    <div class="field"><b>Email</b></div>
                                    <div class="value">
                                        <?php echo $row['email']; ?>
                                    </div>
                                </li>
                                <br>
                                <li>
                                    <div class="field"><b>Phone</b></div>
                                    <div class="value">
                                        <?php echo $row['phone']; ?>
                                    </div>
                                </li>
                                <br> 
							</div>
                            <div class="col-md-4 col-xs-6 col-ms-6">
                                <li>
                                    <div class="field"><b>Sex</b></div>
                                    <div class="value">
                                        <?php echo $row['sex']; ?>
                                    </div>
                                </li>
                                <br>
                                <li>
                                    <div class="field"><b>Marital Status</b></div>
                                    <div class="value">
                                        <?php echo $row['marry']; ?>
                                    </div>
                                </li>
                                <br> 
							</div>
                            <div class="col-md-4 col-xs-6 col-ms-6">
                                <li>
                                    <div class="field"><b>Date of Birth</b></div>
                                    <div class="value">
                                        <?php echo $row['dob']; ?>
                                    </div>
                                </li>
                                <br>
                                <li>
                                    <div class="field"><b>Account No</b></div>
                                    <div class="value">
                                        <?php echo $row['acc_no']; ?>
                                    </div>
                                </li>
                                <br>
							</div>
                            <div class="col-md-4 col-xs-6 col-ms-6">
                                <li>
                                    <div class="field"><b>Account Type</b></div>
                                    <div class="value">
                                        <?php echo $row['type']; ?> 
                                            (<?php echo $row['currency']; ?>)</div>
                                </li>
                                <br> 
							</div>
                            <div class="col-md-4 col-xs-6 col-ms-6">
                                <li>
                                    <div class="field"><b>Address</b></div>
                                    <div class="value"> <address class="m-b-0">										<?php echo $row['addr']; ?>									</address> </div>
                                </li>
                                <br> 
							</div>
							<div class="col-md-4 col-xs-6 col-ms-6">
                                <li>
                                    <div class="field"><b>Active Since</b></div>
                                    <div class="value">
                                        
                                            (<?php echo $row['reg_date']; ?>)</div>
                                </li>
                                <br> 
							</div>
							
							</ul>
							
                        <!-- END profile-info-list -->
                        </div>
                        <!-- END col-4 -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END profile-container -->
            </div>
            <!-- END #content -->
            <!-- BEGIN btn-scroll-top --><a href="index.php#" data-click="scroll-top" class="btn-scroll-top fade"><i class="ti-arrow-up"></i></a>
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
        <script src="assets/plugins/chart/chart-js/Chart.min.js"></script>
        <script src="assets/js/page/dashboard.demo.min.js"></script>
        <script src="assets/js/apps.min.js"></script>
        <!-- ================== END PAGE LEVEL JS ================== -->
        <script>
            $(document).ready(function() {
                App.init();
                Dashboard.init();
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