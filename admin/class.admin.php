<?php

require_once 'dbconfig.php';

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function create($fname,$mname,$lname,$uname,$upass,$phone,$email,$type,$reg_date,$work,$acc_no,$addr,$sex,$dob,$marry,$t_bal,$a_bal,$currency,$cot,$tax,$imf)
	{
		try
		{							
			$upass = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO account(fname,mname,lname,uname,upass,phone,email,type,reg_date,work,acc_no,addr,sex,dob,marry,t_bal,a_bal,currency,cot,tax,imf) 
			                                             VALUES(:fname, :mname, :lname, :uname, :upass, :phone, :email, :type, :reg_date, :work, :acc_no, :addr, :sex, :dob, :marry, :t_bal, :a_bal, :currency, :cot, :tax, :imf)");
			
			$stmt->bindparam(":fname",$fname);
			$stmt->bindparam(":mname",$mname);
			$stmt->bindparam(":lname",$lname);
			$stmt->bindparam(":uname",$uname);
			$stmt->bindparam(":upass",$upass);
			$stmt->bindparam(":phone",$phone);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":type",$type);
			$stmt->bindparam(":reg_date",$reg_date);
			$stmt->bindparam(":work",$work);
			$stmt->bindparam(":acc_no",$acc_no);
			$stmt->bindparam(":addr",$addr);
			$stmt->bindparam(":sex",$sex);
			$stmt->bindparam(":dob",$dob);
			$stmt->bindparam(":marry",$marry);
			$stmt->bindparam(":t_bal",$t_bal);
			$stmt->bindparam(":a_bal",$a_bal);
			$stmt->bindparam(":currency",$currency);
			$stmt->bindparam(":cot",$cot);
			$stmt->bindparam(":tax",$tax);
			$stmt->bindparam(":imf",$imf);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function signup($fname,$mname,$lname,$upass,$phone,$email,$type,$work,$addr,$sex,$dob,$marry,$currency,$code)
	{
		try
		{							
			$upass = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO temp_account(fname,mname,lname,upass,phone,email,type,work,addr,sex,dob,marry,currency,code) 
			                                             VALUES(:fname, :mname, :lname, :upass, :phone, :email, :type, :work, :addr, :sex, :dob, :marry, :currency, :code)");
			
			$stmt->bindparam(":fname",$fname);
			$stmt->bindparam(":mname",$mname);
			$stmt->bindparam(":lname",$lname);
			$stmt->bindparam(":upass",$upass);
			$stmt->bindparam(":phone",$phone);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":type",$type);
			$stmt->bindparam(":work",$work);
			$stmt->bindparam(":addr",$addr);
			$stmt->bindparam(":sex",$sex);
			$stmt->bindparam(":dob",$dob);
			$stmt->bindparam(":marry",$marry);
			$stmt->bindparam(":currency",$currency);
			$stmt->bindparam(":code",$code);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function his($uname,$amount,$sender_name,$type,$remarks,$date,$time)
	{
		try
		{							
			$stmt = $this->conn->prepare("INSERT INTO alerts(uname,amount,sender_name,type,remarks,date,time) 
			                                             VALUES(:uname, :amount, :sender_name, :type, :remarks, :date, :time)");
			
			$stmt->bindparam(":uname",$uname);
			$stmt->bindparam(":amount",$amount);
			$stmt->bindparam(":sender_name",$sender_name);
			$stmt->bindparam(":type",$type);
			$stmt->bindparam(":remarks",$remarks);
			$stmt->bindparam(":date",$date);
			$stmt->bindparam(":time",$time);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function transfer($amount,$uname,$bank_name,$acc_name,$acc_no,$type,$swift,$routing,$remarks,$email,$phone)
	{
		try
		{							
			
			$stmt = $this->conn->prepare("INSERT INTO transfer(amount,uname,bank_name,acc_name,acc_no,type,swift,routing,remarks,email,phone) 
			                                             VALUES(:amount, :unmae, :bank_name, :acc_name, :acc_no, :type, :swift, :routing, :remarks, :email, :phone)");
			$stmt->bindparam(":amount",$amount);
			$stmt->bindparam(":uname",$uname);
			$stmt->bindparam(":bank_name",$bank_name);
			$stmt->bindparam(":acc_name",$acc_name);
			$stmt->bindparam(":acc_no",$acc_no);
			$stmt->bindparam(":type",$type);
			$stmt->bindparam(":swift",$swift);
			$stmt->bindparam(":routing",$routing);
			$stmt->bindparam(":remarks",$remarks);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":phone",$phone);
			
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function ticket($tc,$sender_name,$subject,$msg,$status)
	{
		try
		{							
			
			$stmt = $this->conn->prepare("INSERT INTO ticket(tc,sender_name,subject,msg,$tatus) 
			                                             VALUES(:tc, :sender_name, :subject, :msg, :status)");
			$stmt->bindparam(":tc",$tc);
			$stmt->bindparam(":sender_name",$sender_name);
			$stmt->bindparam(":subject",$subject);
			$stmt->bindparam(":msg",$msg);
			$stmt->bindparam(":status",$status);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function message($sender_name,$reci_name,$subject,$msg)
	{
		try
		{							
			
			$stmt = $this->conn->prepare("INSERT INTO message(sender_name,reci_name,subject,msg) 
			                                             VALUES(:sender_name, :reci_name, :subject, :msg)");
			
			$stmt->bindparam(":sender_name",$sender_name);
			$stmt->bindparam(":reci_name",$reci_name);
			$stmt->bindparam(":subject",$subject);
			$stmt->bindparam(":msg",$msg);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function del($id)
	{
		try
		{							
			
			$stmt = $this->conn->prepare("DELETE FROM account WHERE id = :id"); 
			                                            
			$stmt->bindparam(":id",$id);
			
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function update($fname,$mname,$lname,$uname,$upass,$phone,$email,$type,$work,$acc_no,$addr,$sex,$dob,$marry,$t_bal,$a_bal,$cot,$tax,$imf,$currency)
	{
		try
		{	$id=$_GET['id'];				
			$upass = md5($upass);
			$stmt = $this->conn->prepare("UPDATE account SET fname = :fname, mname = :mname, lname = :lname, uname = :uname, upass = :upass, phone = :phone, email = :email, type = :type, work = :work, acc_no = :acc_no, addr = :addr, sex = :sex, dob = :dob, marry = :marry, t_bal = :t_bal, a_bal = :a_bal, cot = :cot, tax = :tax, imf = :imf, currency = :currency WHERE id='$id'");
			
			$stmt->bindparam(":fname",$fname);
			$stmt->bindparam(":mname",$mname);
			$stmt->bindparam(":lname",$lname);
			$stmt->bindparam(":uname",$uname);
			$stmt->bindparam(":upass",$upass);
			$stmt->bindparam(":phone",$phone);
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":type",$type);
			$stmt->bindparam(":work",$work);
			$stmt->bindparam(":acc_no",$acc_no);
			$stmt->bindparam(":addr",$addr);
			$stmt->bindparam(":sex",$sex);
			$stmt->bindparam(":dob",$dob);
			$stmt->bindparam(":marry",$marry);
			$stmt->bindparam(":t_bal",$t_bal);
			$stmt->bindparam(":a_bal",$a_bal);
			$stmt->bindparam(":cot",$cot);
			$stmt->bindparam(":tax",$tax);
			$stmt->bindparam(":imf",$imf);
			$stmt->bindparam(":currency",$currency);
			$stmt->execute();	
			return $stmt;
		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM admin WHERE email=:email");
			$stmt->execute(array(":email"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['verified_count']=="Y")
				{
					if($userRow['upass']==md5($upass))
					{
						$_SESSION['userSession'] = $userRow['id'];
						return true;
					}
					else
					{
						header("Location: login.php?error");
						exit;
					}
				}
				else
				{
					header("Location: login.php?inactive");
					exit;
				}	
			}
			else
			{
				header("Location: login.php?error");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	function send_mail($email,$messag,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "server113.web-hosting.com";      
		$mail->Port       = 465;             
		$mail->AddAddress($email);
		$mail->Username="support@demo.com";  
		$mail->Password="W.p9hOB&&isx";            
		$mail->SetFrom('','support@demo.com');
		$mail->AddReplyTo("","support@demo.com");
		$mail->Subject    = $subject;
		$mail->MsgHTML($messag);
		$mail->Send();
	}	
}
?>
