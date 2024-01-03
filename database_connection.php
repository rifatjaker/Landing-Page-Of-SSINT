<?php
$servername = "localhost";
$username = "root";
$password = "akhtar_root";
$database = "jbexport";

try {
	$connect = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password,array(PDO::MYSQL_ATTR_LOCAL_INFILE => true));
	// set the PDO error mode to exception
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected successfully"; 
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
}

## otp mobile no
$sql = $connect->prepare("SELECT phone FROM addmin WHERE get_admin_otp='yes' ");
$sql->execute();
$admin_phone = $sql->fetch(PDO::FETCH_ASSOC);
?>