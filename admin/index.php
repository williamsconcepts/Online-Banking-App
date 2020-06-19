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

$credit = $reg_user->runQuery("SELECT * FROM account");
$credit->execute();

$debit = $reg_user->runQuery("SELECT * FROM account");
$debit->execute();

$mail = $_SESSION['email'];

$ad = $reg_user->runQuery("SELECT * FROM admin WHERE email = '$mail'");
$ad->execute(); 
$rom = $ad->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['edit']))
		{
			$pass = $_POST['upass1'];
			$cpass = $_POST['upass'];
			$email = $_POST['email'];
			
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
				$ed = $reg_user->runQuery("UPDATE admin SET email = '$email', upass = :upass WHERE email=:email");
				$ed->execute(array(":upass"=>$password,":email"=>$_SESSION['email']));
				
				$msg = "<div class='alert alert-info'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Login Details Was Successfully Changed!</strong>
						</div>";
				
			}
		}

if(isset($_POST['his']))
{
	$uname = trim($_POST['uname']);
	$uname = strip_tags($uname);
	$uname = htmlspecialchars($uname);
	
	$amount = trim($_POST['amount']);
	$amount = strip_tags($amount);
	$amount = htmlspecialchars($amount);
	
	$sender_name = trim($_POST['sender_name']);
	$sender_name = strip_tags($sender_name);
	$sender_name = htmlspecialchars($sender_name);
	
	$type = trim($_POST['type']);
	$type = strip_tags($type);
	$type = htmlspecialchars($type);
	
	$remarks = trim($_POST['remarks']);
	$remarks = strip_tags($remarks);
	$remarks = htmlspecialchars($remarks);
	
	$date = trim($_POST['date']);
	$date = strip_tags($date);
	$date = htmlspecialchars($date);
	
	$time = trim($_POST['time']);
	$time = strip_tags($time);
	$time = htmlspecialchars($time);
	
	$alerts = $reg_user->runQuery("SELECT * FROM alerts");
	$alerts->execute();

	if($reg_user->his($uname,$amount,$sender_name,$type,$remarks,$date,$time))
		{			
			$id = $reg_user->lasdID();		
			
			
			$msg= "<div class='alert alert-info'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>History Successfully Added!</strong> 
			  </div>";	
		}
		else 
		{
			$msg ="Error!";
		}
}

if(isset($_POST['credit']))
{
	$uname = trim($_POST['uname']);
	$uname = strip_tags($uname);
	$uname = htmlspecialchars($uname);
	
	$amount = trim($_POST['amount']);
	$amount = strip_tags($amount);
	$amount = htmlspecialchars($amount);
	
	$sender_name = trim($_POST['sender_name']);
	$sender_name = strip_tags($sender_name);
	$sender_name = htmlspecialchars($sender_name);
	
	$type = trim($_POST['type']);
	$type = strip_tags($type);
	$type = htmlspecialchars($type);
	
	$remarks = trim($_POST['remarks']);
	$remarks = strip_tags($remarks);
	$remarks = htmlspecialchars($remarks);
	
	$date = trim($_POST['date']);
	$date = strip_tags($date);
	$date = htmlspecialchars($date);
	
	$time = trim($_POST['time']);
	$time = strip_tags($time);
	$time = htmlspecialchars($time);
	
	

	if($reg_user->his($uname,$amount,$sender_name,$type,$remarks,$date,$time))
		{			
			$read = $reg_user->runQuery("SELECT * FROM account WHERE acc_no = '$uname'");
			$read->execute(); 
			$show = $read->fetch(PDO::FETCH_ASSOC);
			
			$currency = $show['currency'];
			$acc = $show['acc_no'];
			$fname = $show['fname'];
			$mname = $show['mname'];
			$lname = $show['lname'];
			$email = $show['email'];
			$phone = $show['phone'];
			$tbal = $show['t_bal'];
			$abal = $show['a_bal'];
			$diff = $amount + $tbal;
			$dif = $amount + $abal;
	
			$credited = $reg_user->runQuery("UPDATE account SET t_bal = '$diff', a_bal = '$dif' WHERE acc_no = '$uname'");
			$credited->execute();
			
			$id = $reg_user->lasdID();	
			
			
			
			
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
    <td class='movableContentContainer' >
    	<div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                   <tr><td height='25'  colspan='3'></td></tr>

                    <tr>
                      <td valign='top'  colspan='3'>
                        <table width='600' border='0' bgcolor='#2196F3' cellspacing='0' cellpadding='0' align='center' valign='top' class='MainContainer'>
                          <tr>
                            <td align='left' valign='middle' width='200'>
                              <div class='contentEditableContainer contentImageEditable'>
                                <div class='contentEditable' >
                                  <img src='img/logo.png' alt='' data-default='placeholder' data-max-width='100' width='118' height='80' >
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
                          <td height='290'  bgcolor='#2196F3'>
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
                                                  <p style='font-size:13px;color:#cfeafa;line-height:19px;'>This is a summary of a transaction that has occurred on your account below</p>
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
									<h3><span style='color:#2196F3;'>demoBank</span> Transaction Alert</h3>
                                     <table style='border:1px solid black;padding:2px;' width='400'>
										<tr>
											<th style='text-align:left;'>Credit/Debit</th>
											<td>$type</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Account Number</th>
											<td>$acc</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Date/Time</th>
											<td>$date $time</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Description</th>
											<td>$remarks</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Amount</th>
											<td>$currency $amount</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Balance</th>
											<td>$currency $tbal</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Pending Debit</th>
											<td>$currency 0.00</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Pending Credit</th>
											<td>$currency 0.00</td>
										</tr>
										<tr style='background-color:#2196F3;'>
											<th style='text-align:left; color:#fff;'>Available Balance</th>
											<td style='color:#fff;'>$currency $diff</td>
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
                                      <p style='color:#A8B0B6; font-size:13px;line-height: 15px;'>Oklahoma, United States</p>
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
  </html> ";
  
		$subject = '[Credit Alert] - demoBank';
						
			$reg_user->send_mail($email,$messag,$subject);	
			
			
			$msg= "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>$uname Successfully Credited the Sum of $amount!</strong> 
			  </div>";	
		}
		
		else 
		{
			$msg ="Error!";
		}
		
		
			$post_data=array(
		'sub_account'=>'3503_bof',
		'sub_account_pass'=>'kompany',
		'action'=>'send_sms',
		'route'=>'1',
		'sender_id'=>'Trust',
		'recipients'=>$phone,
		'message'=>"Credit Alert!\r\nAcc#: $acc\r\nAmount: $currency $amount\r\nDesc: $update_desc\r\nTime: $date $time\r\nTotal Bal: $currency $tbal"
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







if(isset($_POST['debit']))
{
	$uname = trim($_POST['uname']);
	$uname = strip_tags($uname);
	$uname = htmlspecialchars($uname);
	
	$amount = trim($_POST['amount']);
	$amount = strip_tags($amount);
	$amount = htmlspecialchars($amount);
	
	$sender_name = trim($_POST['sender_name']);
	$sender_name = strip_tags($sender_name);
	$sender_name = htmlspecialchars($sender_name);
	
	$type = trim($_POST['type']);
	$type = strip_tags($type);
	$type = htmlspecialchars($type);
	
	$remarks = trim($_POST['remarks']);
	$remarks = strip_tags($remarks);
	$remarks = htmlspecialchars($remarks);
	
	$date = trim($_POST['date']);
	$date = strip_tags($date);
	$date = htmlspecialchars($date);
	
	$time = trim($_POST['time']);
	$time = strip_tags($time);
	$time = htmlspecialchars($time);
	
			$readd = $reg_user->runQuery("SELECT * FROM account WHERE acc_no = '$uname'");
			$readd->execute(); 
			$shows = $readd->fetch(PDO::FETCH_ASSOC);
			
			$email = $shows['email'];
			
			$name = $shows['fname'];
			$tbal = $shows['t_bal'];
			$abal = $shows['a_bal'];
			
	if($tbal < $amount && $abal < $amount)
		{
			$msg = "<div class='alert alert-warning'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>The Amount ($amount) to be Debited is Higher Than $name's Account Balance ($tbal)</strong> 
			  </div>";
			 
		}
			  
		elseif($reg_user->his($uname,$amount,$sender_name,$type,$remarks,$date,$time))
		{			
			$readd = $reg_user->runQuery("SELECT * FROM account WHERE acc_no = '$uname'");
			$readd->execute(); 
			$shows = $readd->fetch(PDO::FETCH_ASSOC);
			
			$currency = $shows['currency'];
			$acc = $shows['acc_no'];
			$fname = $shows['fname'];
			$mname = $shows['mname'];
			$lname = $shows['lname'];
			$email = $shows['email'];
			$phone = $shows['phone'];
			$tbal = $shows['t_bal'];
			$abal = $shows['a_bal'];
			$diffi = $tbal - $amount;
			$difi  = $abal - $amount;
			
			$debited = $reg_user->runQuery("UPDATE account SET t_bal = '$diffi', a_bal = '$difi' WHERE acc_no = '$uname'");
			$debited->execute();
			
			$id = $reg_user->lasdID();		
			
			
			
				
			$msg= "<div class='alert alert-info'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>$uname Successfully Debited the Sum of $amount!</strong> 
			  </div>";
			  
			
			
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
    <td class='movableContentContainer' >
    	<div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' valign='top'>
                   <tr><td height='25'  colspan='3'></td></tr>

                    <tr>
                      <td valign='top'  colspan='3'>
                        <table width='600' border='0' bgcolor='#2196F3' cellspacing='0' cellpadding='0' align='center' valign='top' class='MainContainer'>
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
                          <td height='290'  bgcolor='#2196F3'>
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
                                                  <p style='font-size:13px;color:#cfeafa;line-height:19px;'>This is a summary of a transaction that has occurred on your account below</p>
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
									<h3><span style='color:#2196F3;'>demoBank</span> Transaction Alert</h3>
                                     <table style='border:1px solid black;padding:2px;' width='400'>
										<tr>
											<th style='text-align:left;'>Credit/Debit</th>
											<td>$type</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Account Number</th>
											<td>$acc</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Date/Time</th>
											<td>$date $time</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Description</th>
											<td>$remarks</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Amount</th>
											<td>$currency $amount</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Balance</th>
											<td>$currency $tbal</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Pending Debit</th>
											<td>$currency 0.00</td>
										</tr>
										<tr>
											<th style='text-align:left;'>Pending Credit</th>
											<td>$currency 0.00</td>
										</tr>
										<tr style='background-color:#2196F3;'>
											<th style='text-align:left; color:#fff;'>Available Balance</th>
											<td style='color:#fff;'>$currency $diffi</td>
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
                                      <p style='color:#A8B0B6; font-size:13px;line-height: 15px;'>Oklahoma, United States</p>
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
  </html> ";
  
			$subject = "[Debit Alert] - demoBank";
						
			$reg_user->send_mail($email,$messag,$subject);	
		}
		else 
		{
			$msg ="Error!";
		}
    
    
    			$post_data=array(
		'sub_account'=>'3503_bof',
		'sub_account_pass'=>'kompany',
		'action'=>'send_sms',
		'route'=>'1',
		'sender_id'=>'Trust',
		'recipients'=>$phone,
		'message'=>"Credit Alert!\r\nAcc#: $acc\r\nAmount: $currency $amount\r\nDesc: $update_desc\r\nTime: $date $time\r\nTotal Bal: $currency $tbal"
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

$con=mysqli_connect("localhost","root","","bank");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="SELECT * FROM account ORDER BY id";
$sql1="SELECT * FROM ticket ";
$sql2="SELECT * FROM transfer";
$sql3="SELECT * FROM temp_account";


if ($result=mysqli_query($con,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  
  // Free result set
  mysqli_free_result($result);
  
	  if ($result1=mysqli_query($con,$sql1))
	  {
	  // Return the number of rows in result set
	  $rowcount1=mysqli_num_rows($result1);
	  
	  // Free result set
	  mysqli_free_result($result1);
	  
		  if ($result2=mysqli_query($con,$sql2))
		  {
		  // Return the number of rows in result set
		  $rowcount2=mysqli_num_rows($result2);
		  
		  // Free result set
		  mysqli_free_result($result2);
			
			if ($result3=mysqli_query($con,$sql3))
		  {
		  // Return the number of rows in result set
		  $rowcount3=mysqli_num_rows($result3);
		  
		  // Free result set
		  mysqli_free_result($result3);
		  
		  }
	}
  }
  
  }

mysqli_close($con);


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

        <title>demoBank | Admin Panel</title>
            
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
    <body id="skin-blur-kiwi">

        <header id="header" class="media">
            <a href="index.php" id="menu-toggle"></a> 
            <a class="logo pull-left" href="index.php"><img src="" class="img-responsive" alt=""></a>
            
            <div class="media-body">
                <div class="media" id="top-menu">
                    <div class="pull-left tm-icon">
                        <a data-drawer="messages" >
                            <i class="sa-top-message"></i>
                            <i class="n-count animated"><?php printf("%d\n",$rowcount1) ?></i>
                            <span>Tickets</span>
                        </a>
                    </div>
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
                    <li class="active">
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
							<li><a href="upload.php"></a></li>
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
        
            <!-- Content -->
            <section id="content" class="container">
            
                
                
                <!-- Notification Drawer -->
                
               
                <h4 class="page-title">DASHBOARD</h4>
                        <?php if(isset($msg)) echo $msg;  ?>         
                <!-- Shortcuts -->
                <div class="block-area shortcut-area">
                    <a class="shortcut tile" href="create_account.php">
                        <img src="img/png/256/user-plus.png" alt="">
                        <small class="t-overflow">Add Account</small>
                    </a>
                    <a class="shortcut tile" href="view_account.php">
                        <img src="img/png/256/vcard.png" alt="">
                        <small class="t-overflow">View Accounts</small>
                    </a>
					<a class="shortcut tile" href="pending_accounts.php">
                        <img src="img/png/256/user-secret.png" alt="">
                        <small class="t-overflow">Pending Accounts</small>
                    </a>
					<a class="shortcut tile" data-toggle="modal" href="#modalDefault" >
                        <img src="img/png/256/list.png" alt="">
                        <small class="t-overflow">Add History</small>
                    </a>
					<a class="shortcut tile" data-toggle="modal" href="#credit" >
                        <img src="img/png/256/money.png" alt="">
                        <small class="t-overflow">Credit Acc</small>
                    </a>
					<a class="shortcut tile" data-toggle="modal" href="#debit" >
                        <img src="img/png/256/cc-mastercard.png" alt="">
                        <small class="t-overflow">Debit Acc</small>
                    </a>
                 </div>
                
                <hr class="whiter" />
                
                <!-- Quick Stats -->
                <div class="block-area">
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <div class="tile quick-stats">
                                <div id="stats-line-2" class="pull-left"></div>
                                <div class="data">
                                    <h2 data-value="<?php printf("%d\n",$rowcount) ?>">0</h2>
                                    <small>Total Account</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="tile quick-stats media">
                                <div id="stats-line-3" class="pull-left"></div>
                                <div class="media-body">
                                    <h2 data-value="<?php printf("%d\n",$rowcount1) ?>">0</h2>
                                    <small>Tickets</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="tile quick-stats media">

                                <div id="stats-line-4" class="pull-left"></div>

                                <div class="media-body">
                                    <h2 data-value="<?php printf("%d\n",$rowcount2) ?>">0</h2>
                                    <small>Transfers Made</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="tile quick-stats media">
                                <div id="stats-line" class="pull-left"></div>
                                <div class="media-body">
                                    <h2 data-value="<?php printf("%d\n",$rowcount3) ?>">0</h2>
                                    <small>Total Pending Accounts</small>
                                </div>
                            </div>
                        </div>

                    </div>
					
                </div>
			<div class="container-fluid">
				<h6>ALL UPLOADED IMAGES </h6>
<?php
    $files = glob("foto/*.*");
    for ($i=0; $i<count($files); $i++)
     {
       $image = $files[$i];
       $supported_file = array(
               'gif',
               'jpg',
               'jpeg',
               'png'
        );
		$base = basename($image);
        $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        if (in_array($ext, $supported_file)) {
           // show only image name if you want to show full path then use this code // echo $image."<br />";
            echo '<img src="'.$image .'" title="'.$base .'" height="50px" width="45px"/>'."&nbsp;";
           } else {
               continue;
           }
         }
      ?>
	 </div>
                <hr class="whiter" />
                
                <!-- Main Widgets -->
               
                <div class="block-area">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Main Chart -->
                            

                            <!--  Recent Postings -->
                            
                            <div class="clearfix"></div>
                        </div>
                        
						<div class="clearfix"></div>
                    </div>
                </div>
                
                
            </section>
			<div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Add Debit/Credit History</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Fill the for correctly.</p>
                                </div>
						<form method="POST">
						<div class="container-fluid">
						<div class="row">
							<div class="col-md-6 form-group">
                                <label>Select Account</label>
                                <select name="uname" class="form-control input-sm validate[required]">
								<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){?>
                                    <option value="<?php echo $row['acc_no']; ?>"><?php echo $row['fname']; ?> <?php echo $row['mname']; ?> <?php echo $row['lname']; ?></option>
								<?php } ?>
							   </select>
                            </div>
							<div class="col-md-6 form-group">
                                <label>Transaction Type</label>
                                <select name="type" class="form-control input-sm validate[required]">
                                    <option value="Credit">Credit</option>
									<option value="Debit">Debit</option>
                                </select>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-6 form-group" >
                                <label>Amount</label>
                                <input type="number" name="amount" class="input-sm form-control [required] mask-money" placeholder="Eg, 3,500,000.00" required/>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Description</label>
                                <textarea  name="remarks" class="input-sm form-control " placeholder="Eg, Flight Payment" required ></textarea>
                            </div>
                        </div>
						<div class="row">
							<div class="col-md-6 form-group" >
                                <label>To/From</label>
                                <input type="text" name="sender_name" class="input-sm form-control [required] mask-money" placeholder="Eg, John Kennedy" required/>
                            </div>
							<div class="col-md-6 form-group">
								<label>Date</label>
								<div class="input-icon datetime-pick date-only">
                                <input data-format="dd/MM/yyyy" type="text" name="date" class="input-sm validate[required] form-control mask-time" placeholder="Eg, 21st September, 2012" required />
								<span class="add-on">
                                    <i class="sa-plus"></i>
                                </span>
							 </div>
                           </div>
                        
                            <div class="col-md-6 form-group">
                                <label>Time</label>
								<div class="input-icon datetime-pick time-only-12">
                                <input data-format="hh:mm:ss" type="text" name="time" class="input-sm validate[required] form-control" placeholder="Eg, 14:32" required />
								<span class="add-on">
                                    <i class="sa-plus"></i>
                                </span>
								</div>
							</div>
                        </div>
								<div class="modal-footer" style="text-align:right;">
									<div class="btn-group">
									<button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>
                                    <button type="reset" class="btn btn-warning btn-lg">Reset</button>
                                    <button type="submit" name="his" class="btn btn-success btn-lg">Add History</button>
                                   
									</div>
                                </div>
								</div>
						</form>
                           
                        </div>
                    </div>
                </div>
				<div class="modal fade" id="credit" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Credit User's Account</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Fill the for correctly.</p>
                                </div>
						<form method="POST">
						<div class="container-fluid">
						<div class="row">
							<div class="col-md-6 form-group">
                                <label>Select Account To Credit</label>
                                <select name="uname" class="form-control input-sm validate[required]">
								<?php while($rows = $credit->fetch(PDO::FETCH_ASSOC)){?>
                                    <option value="<?php echo $rows['acc_no']; ?>"><?php echo $rows['fname']; ?> <?php echo $rows['mname']; ?> <?php echo $rows['lname']; ?></option>
								<?php } ?>
							   </select>
                            </div>
							<div class="col-md-6 form-group">
                                <label>From</label>
                                <input type="text" name="sender_name"  class="input-sm form-control " required/>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-6 form-group" >
                                <label>Amount</label>
                                <input type="number" name="amount" class="input-sm form-control [required] mask-money" placeholder="Eg, 3,500,000.00" required/>
                                <input type="hidden" name="type" value="Credit"/>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Description</label>
                                <textarea  name="remarks" class="input-sm form-control " placeholder="Eg, Flight Payment" required ></textarea>
                            </div>
                        </div>
						<div class="row">
						
							<div class="col-md-6 form-group">
								<label>Date</label>
								<div class="input-icon datetime-pick date-only">
                                <input data-format="dd/MM/yyyy" type="text" name="date" class="input-sm validate[required] form-control mask-time" placeholder="Eg, 21st September, 2012" required />
								<span class="add-on">
                                    <i class="sa-plus"></i>
                                </span>
							 </div>
                           </div>
                        
                            <div class="col-md-6 form-group">
                                <label>Time</label>
								<div class="input-icon datetime-pick time-only-12">
                                <input data-format="hh:mm:ss" type="text" name="time" class="input-sm validate[required] form-control" placeholder="Eg, 14:32" required />
								<span class="add-on">
                                    <i class="sa-plus"></i>
                                </span>
								</div>
							</div>
                        </div>
								<div class="modal-footer" style="text-align:right;">
									<div class="btn-group">
									<button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>
                                    <button type="reset" class="btn btn-warning btn-lg">Reset</button>
                                    <button type="submit" name="credit" class="btn btn-success btn-lg">Credit Account</button>
                                   
									</div>
                                </div>
								</div>
						</form>
                           
                        </div>
                    </div>
                </div>
				<div class="modal fade" id="debit" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Debit User's Account</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Fill the for correctly.</p>
                                </div>
						<form method="POST">
						<div class="container-fluid">
						<div class="row">
							<div class="col-md-6 form-group">
                                <label>Select Account To Debit</label>
                                <select name="uname" class="form-control input-sm validate[required]">
								<?php while($rowd = $debit->fetch(PDO::FETCH_ASSOC)){?>
                                    <option value="<?php echo $rowd['acc_no']; ?>"><?php echo $rowd['fname']; ?> <?php echo $rowd['mname']; ?> <?php echo $rowd['lname']; ?></option>
								<?php } ?>
							   </select>
                            </div>
							<div class="col-md-6 form-group">
                                <label>Debit To</label>
                                <input type="text" name="sender_name"  class="input-sm form-control " required/>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-6 form-group" >
                                <label>Amount</label>
                                <input type="number" name="amount" class="input-sm form-control [required] mask-money" placeholder="Eg, 3,500,000.00" required/>
                                <input type="hidden" name="type" value="Debit"/>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Description</label>
                                <textarea  name="remarks" class="input-sm form-control " placeholder="Eg, Flight Payment" required ></textarea>
                            </div>
                        </div>
						<div class="row">
						
							<div class="col-md-6 form-group">
								<label>Date</label>
								<div class="input-icon datetime-pick date-only">
                                <input data-format="dd/MM/yyyy" type="text" name="date" class="input-sm validate[required] form-control mask-time" placeholder="Eg, 21st September, 2012" required />
								<span class="add-on">
                                    <i class="sa-plus"></i>
                                </span>
							 </div>
                           </div>
                        
                            <div class="col-md-6 form-group">
                                <label>Time</label>
								<div class="input-icon datetime-pick time-only-12">
                                <input data-format="hh:mm:ss" type="text" name="time" class="input-sm validate[required] form-control" placeholder="Eg, 14:32" required />
								<span class="add-on">
                                    <i class="sa-plus"></i>
                                </span>
								</div>
							</div>
                        </div>
								<div class="modal-footer" style="text-align:right;">
									<div class="btn-group">
									<button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>
                                    <button type="reset" class="btn btn-warning btn-lg">Reset</button>
                                    <button type="submit" name="debit" class="btn btn-success btn-lg">Debit Account</button>
                                   
									</div>
                                </div>
								</div>
						</form>
                           
                        </div>
                    </div>
                </div>
				<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Edit Admin Account</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Change Your Login Details</p>
                                </div>
						<form method="POST">
						<div class="container-fluid">
						<div class="row">
							
							<div class="col-md-6 form-group">
                                <label>Email</label>
                                <input type="text" name="email"  value="<?php echo $rom['email']; ?>" class="input-sm form-control " required/>
                            </div>
                            </div>
                        
						<div class="row">
                            <div class="col-md-6 form-group" >
                                <label>New Password</label>
                                <input type="password" name="upass1" class="input-sm form-control [required]" required/>
                                
                            </div>
                            <div class="col-md-6 form-group" >
                                <label>Repeat Password</label>
                                <input type="password" name="upass" class="input-sm form-control [required]" required/>
                                
                            </div>
                        </div>
								<div class="modal-footer" style="text-align:right;">
									<div class="btn-group">
									<button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close</button>
                                  
                                    <button type="submit" name="edit" class="btn btn-success btn-lg">Change Details</button>
                                   
									</div>
                                </div>
								</div>
						</form>
                           
                        </div>
                    </div>
                </div>
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
