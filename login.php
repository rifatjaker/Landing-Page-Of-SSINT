<?php
//Start session
session_start();
date_default_timezone_set('Asia/Dhaka');
include("database_connection.php");
include("clean.php");

## check html value
$process = clean($_POST['process_status']);
$email = clean($_POST['email1']);
$login_final_vcode = clean($_POST['login_final_vcode']);
$password = md5($_POST['password1']); // Password Encryption, If you like you can also leave sha1.
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ip_number = $_SERVER['HTTP_CLIENT_IP'];
}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ip_number = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
    $ip_number = $_SERVER['REMOTE_ADDR'];
}

// check if e-mail address syntax is valid or not
$email = filter_var($email, FILTER_SANITIZE_EMAIL); // sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)

if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
	echo "Invalid Email";
}else{
	
	// Matching user input email and password with stored email and password in database.
	$sql = $connect->prepare("SELECT * FROM `addmin` WHERE email_add='".$email."' AND password='".$password."' AND block='No' LIMIT 1");
	$sql->execute();
	$member = $sql->fetch(PDO::FETCH_ASSOC);
	$data = $sql->rowCount();
	if($data == 1){
		
		if($process == 'primary_entry'){
			
			// variable define
			$vcode = rand(1000 , 9999);
			$operator = $member['f_name'].$member['l_name'];
			$otp_mobile_no = preg_replace('/^88/','',$member['phone']);
			$msg = "Hi! $operator your login OTP is $vcode - PROJECT ACCESS CONTROL";
			
			// SMS API
			include("sms_api.php");
			file_put_contents("login_vcode.txt", $vcode);
			echo "Primary Logged in";
			
		}else if($process == 'final_entry'){
			
			// invalid otp
			$dynamic_password = file_get_contents("login_vcode.txt");
			if($login_final_vcode!=trim($dynamic_password)){
				print 'invalid_otp';
				exit();
			}
			// end otp
		
			echo "Successfully Logged in";
			
			//Login Successful
			session_regenerate_id();
			$_SESSION['APANEL_SESS_MEMBER_ID'] = $member['id'];
			$_SESSION['APANEL_SESS_OPERATOR_NAME'] = $member['f_name'].$member['l_name'];
			session_write_close();

			// vcode reset
			file_put_contents("login_vcode.txt", 0);
		}
		
	}else{
		echo "Email or Password is wrong";
	}
}
?>