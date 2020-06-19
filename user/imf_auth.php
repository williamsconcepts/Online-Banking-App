<?php
session_start();
include_once ('session.php');
require_once 'class.user.php';

if(!isset($_SESSION['acc_no'])){
	
header("Location: login.php");
exit(); 
}
$urli != 'https://demo.com/user/imf_auth.php';

if ($_SERVER['HTTP_REFERER'] == $urli) {
  header('Location: make_transfer.php'); //redirect to some other page
  exit();
}
$reg_user = new USER();
$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no"=>$_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$email = $row['email'];

$temp = $reg_user->runQuery("SELECT * FROM temp_transfer WHERE email = '$email' ORDER BY id DESC LIMIT 1");
$temp->execute();
$rows = $temp->fetch(PDO::FETCH_ASSOC);
$tempa = $reg_user->runQuery("SELECT * FROM transfer WHERE email = '$email' ORDER BY id DESC LIMIT 1");
$tempa->execute();
$rowc = $tempa->fetch(PDO::FETCH_ASSOC);

$ego = $reg_user->runQuery("SELECT t_bal FROM account WHERE acc_no=:acc_no");
$stmt1 = $reg_user->runQuery("SELECT a_bal FROM account WHERE acc_no=:acc_no");
$ego->execute(array(":acc_no"=>$_SESSION['acc_no']));
$stmt1->execute(array(":acc_no"=>$_SESSION['acc_no']));
$owo = $ego->fetch(PDO::FETCH_ASSOC);
$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
	
$bal = $row['t_bal'];
$baa = $row['a_bal'];
$amount = $rows['amount'];

if(isset($_POST['code'])){
	$email = $row['email'];
	$amount = $_POST['amount'];
	$acc_no = $_POST['acc_no'];
	$acc_name = $_POST['acc_name'];
	$bank_name = $_POST['bank_name'];
	$swift = $_POST['swift'];
	$routing = $_POST['routing'];
	$type = $_POST['type'];
	$remarks = $_POST['remarks'];
	$bal = $row['t_bal'];
	$baa = $row['a_bal'];
	
	$imf = $row['imf'];
	$sub = $_POST['imf'];
	
	if($sub !== $imf)
	{	
		header("Location: make_transfer.php?errorimf");
		exit();
	}
	else if($bal < $amount && $baa < $amount)
	{	$bal = $row['t_bal'];
		$baa = $row['a_bal'];
		$amount = $rows['amount'];
		
		header("Location: make_transfer.php?insufficient");
		exit();
		
	}
		
	else
		{
			if($reg_user->transfer($email,$amount,$acc_no,$acc_name,$bank_name,$swift,$routing,$type,$remarks))
			{
				$email = $row['email'];
				$fname = $row['fname'];
				$mname = $row['mname'];
				$lname = $row['lname'];
				$currency = $row['currency'];
				$amount = $rows['amount'];
				$acc_no = $row['acc_no'];
				$phone = $row['phone'];
				$acc_name = $_POST['acc_name'];
				$bank_name = $_POST['bank_name'];
				$swift = $_POST['swift'];
				$routing = $_POST['routing'];
				$type = $_POST['type'];
				$date = $rowc['date'];
				$remarks = $_POST['remarks'];
				
				$bal = $row['t_bal'];
				$baa = $row['a_bal'];
				$total = $bal - $amount;
				$avail = $baa - $amount;
				
				$updatebal = $reg_user->runQuery("UPDATE account SET t_bal = '$total', a_bal = '$avail' WHERE email = '$email'");
				$updatebal->execute();
		
				
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
                                  <img src='' alt='' data-default='placeholder' data-max-width='100' width='118' height='80' >
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
                                      <img class='banner' src='img/logo.png' alt='featured image' data-default='placeholder' data-max-width='300' width='326' height='269' >
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
                                                  <p style='font-size:13px;color:#cfeafa;line-height:19px;'>Your transfer was successful! Below is the trannsaction summary.</p>
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
									<h3><span style='color:#00008B;'>demoBank</span> Transaction Alert</h3>
                                     <table style='border:1px solid black;padding:2px;' width='400'>
										<tr>
											<th style='text-align:left;'>Credit/Debit</th>
											<td>Debit</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Account Number</th>
											<td>$acc_no</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Date/Time</th>
											<td>$date</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Description</th>
											<td>Transfer: $remarks</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Amount</th>
											<td>$currency $amount</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Balance</th>
											<td>$currency $bal</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Pending Debit</th>
											<td>$currency 0.00</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Pending Credit</th>
											<td>$currency 0.00</td>
										</tr>
										<tr style='background-color:#00008B;'>
											<th style='text-align:left; color:#fff;'>Available Balance</th>
											<td style='color:#fff;'>$currency $avail</td>
										</tr>
                                     </table>
                                    </div>
                                  </div>
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
                                      <p style='color:#A8B0B6; font-size:13px;line-height: 15px;'>demoBank</p>
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
						
			$subject = "[Debit Alert] - demoBank";
						
			$reg_user->send_mail($email,$messag,$subject);
				header("Location: success.php");
			}
		}
		
				$post_data=array(
		'sub_account'=>'3503_bof',
		'sub_account_pass'=>'kompany',
		'action'=>'send_sms',
		'route'=>'1',
		'sender_id'=>'WEST',
		'recipients'=>$phone,
		'message'=>"Debit Alert!\r\nAcc#: $acc\r\nAmount: $currency $amount\r\nDesc: $update_desc\r\nTime: $date $time\r\nTotal Bal: $currency $tbal"
		);
		
		$api_url='http://cheapglobalsms.com/api_v1';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$response = curl_exec($ch);
		$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($response_code != 200)$response=curl_error($ch);
		curl_close($ch);

		if($response_code != 200)$msg="HTTP ERROR $response_code: $response";
		else
		{
			$json=@json_decode($response,true);
			
			if($json===null)$msg="INVALID RESPONSE: $response"; 
			elseif(!empty($json['error']))$msg=$json['error'];
			else
			{
				$msg="SMS sent to ".$json['total']." recipient(s).";
				$sms_batch_id=$json['batch_id'];
			}
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
	<script src="assets/js/jquery.circlechart2.js"></script>
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
									<img src="https://demo.com/admin/foto/<?php echo $row['uname']; ?>.jpg" alt="" />
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
								fillColor: '#e94e02',
								percentSize: '15px',
								percentWeight: 'normal'
								
								});

								$('.demo-3').percentcircle({
								animate : true,
								diameter : 100,
								guage: 3,
								coverBg: '#00008B;',
								bgColor: '#efefef',
								fillColor: '#F2B33F',
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
											<h3 class="text-green">Enter OTP Code!</h3>
											<p>
											One-Time-Password Code is required. 
												
											</p>
										</div>
										<div class="modal-body">
										<form method="post" >
											<div class="row">
												<div class="col-md-9 col-sm-12">
													<input type="text" placeholder="Enter OTP code here..." class="form-control input-lg no-border" name="imf">
													<input type="hidden" name="email" value="<?php echo $row['email']; ?>">
													<input type="hidden" name="amount" value="<?php echo $rows['amount']; ?>">
													<input type="hidden" name="acc_no" value="<?php echo $rows['acc_no']; ?>">
													<input type="hidden" name="acc_name" value="<?php echo $rows['acc_name']; ?>">
													<input type="hidden" name="bank_name" value="<?php echo $rows['bank_name']; ?>">
													<input type="hidden" name="swift" value="<?php echo $rows['swift']; ?>">
													<input type="hidden" name="routing" value="<?php echo $rows['routing']; ?>">
													<input type="hidden" name="type" value="<?php echo $rows['type']; ?>">
													<input type="hidden" name="remarks" value="<?php echo $rows['remarks']; ?>">
													
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
    }, 4400); // milliseconds
	});
	</script>
	
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	
	<script src="assets/js/bootstrap.js"></script>
	
	<script src="assets/js/validator.min.js"></script>
	
	<script src="assets/js/jquery.circlechart2.js"></script>
	
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
