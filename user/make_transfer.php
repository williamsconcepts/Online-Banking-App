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
$stat = $row['status'];
if($stat == 'Dormant/Inactive'){
	header('Location: index.php?dormant');
	exit();
}
if(isset($_POST['transfer'])){
	$email = $row['email'];
	
	$amount = trim($_POST['amount']);
	$amount = strip_tags($amount);
	$amount = htmlspecialchars($amount);
	
	
	$acc_no = trim($_POST['acc_no']);
	$acc_no = strip_tags($acc_no);
	$acc_no = htmlspecialchars($acc_no);
	
	$acc_name = trim($_POST['acc_name']);
	$acc_name = strip_tags($acc_name);
	$acc_name = htmlspecialchars($acc_name);
	
	$bank_name = trim($_POST['bank_name']);
	$bank_name = strip_tags($bank_name);
	$bank_name = htmlspecialchars($bank_name);
	
	$swift = trim($_POST['swift']);
	$swift = strip_tags($swift);
	$swift = htmlspecialchars($swift);
	
	$routing = trim($_POST['routing']);
	$routing = strip_tags($routing);
	$routing = htmlspecialchars($routing);
		
	$type = trim($_POST['type']);
	$type = strip_tags($type);
	$type = htmlspecialchars($type);
	
	$remarks = trim($_POST['remarks']);
	$remarks = strip_tags($remarks);
	$remarks = htmlspecialchars($remarks);
	

	
	
	if($reg_user->temp($email,$amount,$acc_no,$acc_name,$bank_name,$swift,$routing,$type,$remarks)){
	
	header("Location: imf_auth.php");
	
		$messag = "	
			
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <title>[SUBJECT]</title>
  <style type='text/css'>
  body {
   padding-top: 0 !important;
   padding-bottom: 0 !important;
   padding-top: 0 !important;
   padding-bottom: 0 !important;
   margin:0 !important;
   width: 100% !important;
   -webkit-text-size-adjust: 100% !important;
   -ms-text-size-adjust: 100% !important;
   -webkit-font-smoothing: antialiased !important;
 }
 .tableContent img {
   border: 0 !important;
   display: block !important;
   outline: none !important;
 }
 a{
  color:#382F2E;
}

p, h1{
  color:#382F2E;
  margin:0;
}

div,p,ul,h1{
  margin:0;
}
p{
font-size:13px;
color:#99A1A6;
line-height:19px;
}
h2,h1{
color:#444444;
font-weight:normal;
font-size: 22px;
margin:0;
}
a.link2{
padding:15px;
font-size:13px;
text-decoration:none;
background:#2D94DF;
color:#ffffff;
border-radius:6px;
-moz-border-radius:6px;
-webkit-border-radius:6px;
}
.bgBody{
background: #f6f6f6;
}
.bgItem{
background: #2C94E0;
}

@media only screen and (max-width:480px)
		
{
		
table[class='MainContainer'], td[class='cell'] 
	{
		width: 100% !important;
		height:auto !important; 
	}
td[class='specbundle'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		
	}
	td[class='specbundle1'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		
	}	
td[class='specbundle2'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
	}
	td[class='specbundle3'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
		padding-bottom:20px !important;
	}
	td[class='specbundle4'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		text-align:center !important;
		
	}
		
td[class='spechide'] 
	{
		display:none !important;
	}
	    img[class='banner'] 
	{
	          width: 100% !important;
	          height: auto !important;
	}
		td[class='left_pad'] 
	{
			padding-left:15px !important;
			padding-right:15px !important;
	}
		 
}
	
@media only screen and (max-width:540px) 

{
		
table[class='MainContainer'], td[class='cell'] 
	{
		width: 100% !important;
		height:auto !important; 
	}
td[class='specbundle'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		
	}
	td[class='specbundle1'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		
	}		
td[class='specbundle2'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
	}
	td[class='specbundle3'] 
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-left:5% !important;
		padding-right:5% !important;
		padding-bottom:20px !important;
	}
	td[class='specbundle4'] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:20px !important;
		text-align:center !important;
		
	}
		
td[class='spechide'] 
	{
		display:none !important;
	}
	    img[class='banner'] 
	{
	          width: 100% !important;
	          height: auto !important;
	}
		td[class='left_pad'] 
	{
			padding-left:15px !important;
			padding-right:15px !important;
	}
		
	.font{
		font-size:15px !important;
		line-height:19px !important;
		
		}
}

</style>

<script type='colorScheme' class='swatch active'>
  {
    'name':'Default',
    'bgBody':'f6f6f6',
    'link':'ffffff',
    'color':'99A1A6',
    'bgItem':'2C94E0',
    'title':'444444'
  }
</script>

</head>
<body paddingwidth='0' paddingheight='0' bgcolor='#d1d3d4'  style=' margin-left:5px; margin-right:5px; margin-bottom:0px; margin-top:0px;padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;' offset='0' toppadding='0' leftpadding='0'>
  <table width='100%' border='0' cellspacing='0' cellpadding='0' class='tableContent bgBody' align='center'  style='font-family:Helvetica, Arial,serif;'>
  
    <!-- =============================== Header ====================================== -->

  <tr>
                      <td valign='top'  colspan='3'>
                        <table width='600' border='0' bgcolor='#00008B' cellspacing='0' cellpadding='0' align='center' valign='top' class='MainContainer'>
                          <tr>
                            <td align='left' valign='middle' width='200'>
                              <div class='contentEditableContainer contentImageEditable'>
                                <div class='contentEditable' >
                                  <img src='https://demo.com/admin/img/logo.png' alt='' data-default='placeholder' data-max-width='100' width='118' height='80' >
								  <b style='font-size:1.5em; color:#fff;'></b>
                                </div>
                              </div>
                            </td>

                            
                          </tr>
                        </table>
                      </td>
                    </tr>
                </table>
        </div>
        <div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                        <tr><td height='25'  ></td></tr>

                        <tr>
                          <td height='290'  bgcolor='#00008B'>
                            <table align='center' width='600' border='0' cellspacing='0' cellpadding='0' class='MainContainer'>
  <tr>
    <td height='50'></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
								<td width='400' valign='top' class='specbundle2'>
                                  <div class='contentEditableContainer contentImageEditable'>
                                    <div class='contentEditable' >
                                      <img  src='https://demo.com/admin/img/logo.png' alt='featured image' data-default='placeholder' data-max-width='200' width='200' height='269' >
                                    </div>
                                  </div>
                                </td>
    <td class='specbundle3'>&nbsp;</td>
    <td width='250' valign='top' class='specbundle4'>
                                  <table width='250' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                                    <tr><td colspan='3' height='10'></td></tr>

                                    <tr>
                                      <td width='10'></td>
                                      <td width='230' valign='top'>
                                        <table width='230' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                                          <tr>
                                            <td valign='top'>
                                              <div class='contentEditableContainer contentTextEditable'>
                                                <div class='contentEditable' >
                                                  <h1 style='font-size:20px;font-weight:normal;color:#ffffff;line-height:19px;'>Dear $fname $lname,</h1>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr><td height='18'></td></tr>
                                          <tr>
                                            <td valign='top'>
                                              <div class='contentEditableContainer contentTextEditable'>
                                                <div class='contentEditable' >
                                                  <p style='font-size:13px;color:#cfeafa;line-height:19px;'>You are transfering the sum of <h6>$ $amount</h6>
                                        </p> to Acct NO: $acc_no , Name: $acc_name
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr><td height='33'></td></tr>
                                          <tr>
                                            <td>
                                              <div class='contentEditableContainer contentTextEditable'>
                                                <div class='contentEditable' >
                                                  
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr><td height='15'></td></tr>
                                        </table>
                                      </td>
                                      <td width='10'></td>
                                    </tr>
                                  </table>
                                </td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

                          </td>
                        </tr>

                        <tr><td height='25' ></td></tr>
                </table>
        </div>
        
        
        
        <div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                  <tr>
                    <td>
                      <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' valign='top' class='MainContainer'>
                        <tr>
                          <td>
                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>

                              <tr>
                                <td>
                                  <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' class='MainContainer'>
                                    <tr><td height='10'>&nbsp;</td></tr>
                                    <tr><td style='border-bottom:1px solid #DDDDDD'></td></tr>
                                    <tr><td height='10'>&nbsp;</td></tr>
                                  </table>
                                </td>
                              </tr>

                    
                           

                              <tr><td height='28'>&nbsp;</td></tr>
                              
                              <tr>
                                <td valign='top' align='center'>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      <p style=' font-weight:bold;font-size:13px;line-height: 30px;'>demoBank</p>
                                    </div>
                                  </div>
                                  
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' >
                                      <a target='_blank' href='' style='line-height: 20px;color:#A8B0B6; font-size:13px;'>info@demo.com</a>
                                    </div>
                                    </div>
									<div class='contentEditableContainer contentTextEditable'>
									<div class='contentEditable' >
                                      <a target='_blank' href='www.demo.com' style='line-height: 20px;color:#A8B0B6; font-size:13px;'>www.demo.com</a>
                                    </div>
                                  </div>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    
                                  </div>
                                </td>
                              </tr>

                              <tr><td height='28'>&nbsp;</td></tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
        </div>
    </td>
  </tr>
</table>

  </body>
  </html>

";
	
						
			$subject = "[Transfer Alert] - International bank";
						
			$reg_user->send_mail($email,$messag,$subject);
	
	
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
	<title> demoBank | Transfer</title>
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
			
			
			<!-- BEGIN row -->
			<div class="row">
				<div class="col-md-12">
			    	<!-- BEGIN panel -->
			    	<div class="panel panel-default">
			    		<!-- BEGIN panel-heading -->
			    		<div class="panel-heading">
			    			<h3 class="panel-title">Transfer Funds</h3><br />
			    		</div>
						<?php 
							if(isset($_GET['error']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Unable to Authenticate. Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['errorcot']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid COT Code! Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['errortax']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid Tax Code! Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['errorimf']))
								{
									?>
									<div class='alert alert-danger'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid IMF Code! Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['insufficient']))
								{
									?>
									<div class='alert alert-warning'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Sorry, your balance is insufficient to make the transfer, please transfer a lower amount.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['amounterror']))
								{
									?>
									<div class='alert alert-warning'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Sorry, the amount is too little, please transfer a higher amount.</strong> 
									</div>
									<?php
								}
						?>
						
							<!-- END panel-heading -->
							<!-- BEGIN panel-body -->
							<div class="panel-body">
			    			<p class="desc">Please, carefully fill required details below to transfer funds.</p>
			    			<form  method="POST" action="" autofocus data-toggle="validator">
			    				<?php if(isset($error)){ echo $error;}?>
			    				<?php if(isset($errorcot)){ echo $errorcot;}?>
								<?php if(isset($errortax)){ echo $errortax;}?>
								<?php if(isset($errorimf)){ echo $errorimf;}?>
								<?php if(isset($insufficient)){ echo $insufficient;}?>
								<?php if(isset($amounterror)){ echo $amounterror;}?>
								<fieldset>
									<div class="form-group">
										<label class="control-label">From<span class="text-danger">*</span></label>
										
										<div class="row row-space-6">
										<div class="col-md-6">
											<input type="text" class="form-control" value="<?php echo $row['fname']; ?> - <?php echo $row['acc_no']; ?> - [<?php echo $row['currency']; ?><?php echo number_format($row['a_bal']); ?>]" disabled/>
										</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label" style="float=:right;">Amount<span class="text-danger">*</span></label>
										<div class="row row-space-6">
										
										<div class="col-md-6">
											<input type="number" class="form-control"  name="amount" placeholder="eg. 30000" id="inputName" required/>
										</div>
										</div>
									</div>
									<div class="form-group">
										
										
									</div>
										
										<div class="form-group">
										<label class="control-label">Account Number<span class="text-danger">*</span> </label>
											<div class="row row-space-6">
											<div class="col-md-6">
												<input type="number"  class="form-control m-b-5" name="acc_no" placeholder="eg. 245354254" id="inputNumber" required />
											</div>
											</div>
										</div>
										<div class="form-group">
										<div class="row row-space-6">
										<div class="col-md-6">
										<label class="control-label">Account Name<span class="text-danger">*</span></label>
											<input type="text" class="form-control" min-length="8" name="acc_name" placeholder="eg. Johnson Peters" required />
										</div>
										</div>
										</div>
										<div class="form-group">
										<div class="row row-space-6">
										<div class="col-md-6">
										<label class="control-label">Bank Name<span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="bank_name" min-length="6" placeholder="eg. SunTrust Bank" required />
											<input type="hidden" class="form-control" name="uname" value="<?php echo $row['email']; ?> "/>
										</div>
										</div>
										</div>
                                    
                                    <div class="form-group">
										<div class="row row-space-6">
										<div class="col-md-6">
										<label class="control-label">Bank Address<span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="" min-length="6" placeholder="eg. westhood Av. 454" required />
											<input type="hidden" class="form-control" name="uname" value="<?php echo $row['email']; ?> "/>
										</div>
										</div>
										</div>
                                    
                                    <div class="form-group">
										<div class="row row-space-6">
										<div class="col-md-6">
										<label class="control-label">Beneficiary Name<span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="" min-length="6" placeholder="eg. john" required />
											<input type="hidden" class="form-control" name="uname" value="<?php echo $row['email']; ?> "/>
										</div>
										</div>
										</div>
                                    
                                    <div class="form-group">
										<div class="row row-space-6">
										<div class="col-md-6">
										<label class="control-label">Beneficiary Address<span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="" min-length="6" placeholder="eg. westhood Av. 454" required />
											<input type="hidden" class="form-control" name="uname" value="<?php echo $row['email']; ?> "/>
										</div>
										</div>
										</div>
                                    
                                    
										<div class="form-group">
										<label class="control-label">IFSC/Swift Code<span class="text-danger">*</span> </label>
											<div class="row row-space-6">
											<div class="col-md-6">
												<input type="text" class="form-control m-b-5" name="swift" placeholder="eg. SNTRUS3A" id="inputName" required />
											</div>
											</div>
										</div>
										<div class="form-group">
										<label class="control-label">Routing Transit Number (RTN)<span class="text-danger">*</span> </label>
											<div class="row row-space-6">
											<div class="col-md-6">
												<input type="number" class="form-control m-b-5" name="routing" placeholder="eg. 061000104" id="inputName" required />
												<span class="help-block" id="result"></span>
											</div>
											</div>
										</div>
										
									<div class="form-group">
										<label class="control-label">Remarks<span class="text-danger">*</span></label>
										<div class="row row-space-6">
										<div class="col-md-6">
										<textarea type="text" class="form-control" name="remarks" placeholder="eg. Purchase upfront" required ></textarea>
										</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label">Account Type <span class="text-danger">*</span></label>
										<div class="radio">
											<div class="radio-inline">
												<input type="radio" name="inline_radio" id="inline_radio_1" value="Savings" checked required>
												
												<label for="inline_radio_1">
													Personal (Savings)
												</label><input type="hidden" name="type" value="Savings">
											</div>
											<div class="radio-inline">
												<input type="radio" id="inline_radio_2" name="inline_radio" value="Current" required>
												<label for="inline_radio_2">
													Current
												</label>
											</div>
											<div class="radio-inline">
												<input type="radio"  id="inline_radio_3" name="inline_radio" value="Checking" required>
												<label for="inline_radio_3">
													Checking
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										
										<div class="row row-space-6">
										<div class="col-md-6 col-md-offset-2">
											<button type="submit" name="transfer" class="btn btn-primary btn-rounded btn-bg">Verify & Transfer</button>
										</div>
										</div>
									</div>
									</fieldset>
								
							</form>
						</div>
						
			    		<!-- END panel-body -->
					</div>
			    	<!-- END panel -->
			    	
			    	
				</div>
				<!-- BEGIN col-3 -->
				
		</div>
		<!-- END #content -->
		
		<!-- BEGIN btn-scroll-top -->
		<a href="index.php#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
		<!-- END btn-scroll-top -->
	</div>
	<!-- END #page-container -->
	
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/js/validator.min.js"></script>
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
