<?php
require_once('auth.php');
include("database_connection.php");

//Unset the variables stored in session
unset($_SESSION['APANEL_SESS_MEMBER_ID']);
header("location:index.php");
?>
