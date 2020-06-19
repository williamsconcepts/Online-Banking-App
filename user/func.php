<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
	$user_login->redirect('index.php');
}

if(isset($_POST['login']))
{
	$email = trim($_POST['email']);
	$upass = trim($_POST['upass']);
	
	if($user_login->login($email,$upass))
	{
		$user_login->redirect('index.php');
	}
	else {
		header('Location: login.php');
	}
}
?>