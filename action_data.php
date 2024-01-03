<?php 
include("auth.php");
include("database_connection.php");
include("clean.php");

// set OTP receiver number
$otp_mobile_no = preg_replace('/^88/','',$admin_phone['phone']);
$vcode = rand(1000 , 9999);
// end


// otp entry
if(!empty($_POST['process_status']) && $_POST['process_status']=='otp'){
	
	// html data
	$project_name = clean($_POST['project_name']);
	$project_mode = clean($_POST['project_mode']);
	$project_session_time = clean($_POST['project_session_time']);
	$session_time_local = date("d-m-Y h:i:s a", strtotime($project_session_time));
	$operator = $_SESSION['APANEL_SESS_OPERATOR_NAME'];
	$setupArray = 'Project Name: '. $project_name . ', Project Mode: ' . $project_mode . ', Session Time: ' . $session_time_local;
	$msg = "Hi Admin! $operator OTP ($vcode) to $project_mode ($setupArray) - PROJECT ACCESS CONTROL";
	
	// SMS START
	include("sms_api.php");
	file_put_contents("lock_vcode.txt", $vcode);
	print 1;
	// end
	
exit();
}


// ready to insert new data
if(!empty($_POST['process_status']) && $_POST['process_status']=='final_entry'){
	
	// html data
	$setup_final_vcode = clean($_POST['setup_final_vcode']);
	$project_name = clean($_POST['project_name']);
	$project_mode = clean($_POST['project_mode']);
	$project_session_time 	= clean($_POST['project_session_time']);
	$last_update = $_SESSION['APANEL_SESS_OPERATOR_NAME'] . ' @ ' . date("d-m-Y h:i:s a") . ' <br /> IP: '. $_SERVER['REMOTE_ADDR'];
	
	// check valid otp
	$dynamic_password = file_get_contents("lock_vcode.txt");
	if($setup_final_vcode!=trim($dynamic_password)){
		print 'invalid_otp';
		exit();
	}
	
	// ALL PROJECT LOCK - UNLOCK
	if($project_name=='All'){

		// ready to update
		$sql = $connect->prepare("UPDATE `access_panel` SET project_mode='".$project_mode."', project_session_time='".$project_session_time."', last_update='".$last_update."' WHERE project_name IS NOT NULL ");
		$sql->execute();

	}else{
		
		// check duplicate data
		$qry = $connect->prepare("SELECT * FROM `access_panel` WHERE project_name='".$project_name."' ");
		$qry->execute();
		if($qry->rowCount() > 0){
			
			// ready to update
			$sql = $connect->prepare("UPDATE `access_panel` SET project_mode='".$project_mode."', project_session_time='".$project_session_time."', last_update='".$last_update."' WHERE project_name='".$project_name."' ");
			$sql->execute();
			
		}else{
			
			// ready to insert
			$sql = $connect->exec("INSERT INTO `access_panel` (`id`, `project_name`, `project_mode`, `project_session_time`, `last_update`) VALUES('0', '".$project_name."', '".$project_mode."', '".$project_session_time."', '".$last_update."') ");
		}
		// end
	}
	
	// query success
	if($sql){
		file_put_contents("lock_vcode.txt", 0);
		print 2;
	}else{
		print "Setup is failed!!";
	}
	
exit(); 
}
?>