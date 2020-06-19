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
	
	public function create($pishure,$fname,$mname,$lname,$uname,$upass,$phone,$email,$type,$work,$acc_no,$addr,$sex,$dob,$marry,$t_bal,$a_bal)
	{
		try
		{							
			$upass = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO account(pishure,fname,mname,lname,uname,upass,phone,email,type,work,acc_no,addr,sex,dob,marry,t_bal,a_bal) 
			                                             VALUES(:pishure, :fname, :mname, :lname, :uname, :upass, :phone, :email, :type, :work, :acc_no, :addr, :sex, :dob, :marry, :t_bal, :a_bal)");
			$stmt->bindparam(":pishure",$pishure);
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
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function transfer($email,$amount,$acc_no,$acc_name,$bank_name,$swift,$routing,$type,$remarks)
	{
		try
		{							
			
			$stmt = $this->conn->prepare("INSERT INTO transfer(email,amount,acc_no,acc_name,bank_name,type,swift,routing,remarks) 
			                                             VALUES(:email, :amount, :acc_no, :acc_name, :bank_name, :type, :swift, :routing, :remarks)");
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":amount",$amount);
			$stmt->bindparam(":acc_no",$acc_no);
			$stmt->bindparam(":acc_name",$acc_name);
			$stmt->bindparam(":bank_name",$bank_name);
			$stmt->bindparam(":type",$type);
			$stmt->bindparam(":swift",$swift);
			$stmt->bindparam(":routing",$routing);
			$stmt->bindparam(":remarks",$remarks);
			
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function temp($email,$amount,$acc_no,$acc_name,$bank_name,$swift,$routing,$type,$remarks)
	{
		try
		{							
			
			$stmt = $this->conn->prepare("INSERT INTO temp_transfer(email,amount,acc_no,acc_name,bank_name,type,swift,routing,remarks) 
			                                             VALUES(:email, :amount, :acc_no, :acc_name, :bank_name, :type, :swift, :routing, :remarks)");
			$stmt->bindparam(":email",$email);
			$stmt->bindparam(":amount",$amount);
			$stmt->bindparam(":acc_no",$acc_no);
			$stmt->bindparam(":acc_name",$acc_name);
			$stmt->bindparam(":bank_name",$bank_name);
			$stmt->bindparam(":type",$type);
			$stmt->bindparam(":swift",$swift);
			$stmt->bindparam(":routing",$routing);
			$stmt->bindparam(":remarks",$remarks);
			
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function ticket($tc,$sender_name,$sub,$msg)
	{
		try
		{							
			
			$stmt = $this->conn->prepare("INSERT INTO ticket(tc,sender_name,subject,msg) 
			                                             VALUES(:tc, :sender_name, :subject, :msg)");
			$stmt->bindparam(":tc",$tc);
			$stmt->bindparam(":sender_name",$sender_name);
			$stmt->bindparam(":subject",$sub);
			$stmt->bindparam(":msg",$msg);
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
	
	public function delaccount($id)
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
	
	public function update($email,$phone,$addr)
	{
		$update = "UPDATE account SET
				email = :email,
				phone = :phone,
				addr = :addr,
				
				WHERE id = :id";
		try
		{							
			$stmt = $this->conn->prepare($update); 
			                                         
			$stmt->bindparam(':email', $_POST['email'], PDO::PARAM_STR);
			$stmt->bindparam(':phone', $_POST['phone'], PDO::PARAM_STR);
			$stmt->bindparam(':addr', $_POST['addr'], PDO::PARAM_STR);
			
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function bal($t_bal)
	{
		$update = "UPDATE account SET
				t_bal = :t_bal,
				
				WHERE id = :id";
		try
		{							
			$stmt = $this->conn->prepare($update); 
			                                         
			$stmt->bindparam(':t_bal', $_POST['t_bal'], PDO::PARAM_STR);
			
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function login($acc_no,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM account WHERE acc_no=:acc_no");
			$stmt->execute(array(":acc_no"=>$acc_no));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['upass']==md5($upass))
					{
						$_SESSION['userSession'] = $userRow['acc_no'];
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