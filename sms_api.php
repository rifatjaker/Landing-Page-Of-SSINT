<?php
// SMS API - GP
$arr=json_encode(array(
	"username"=>"Jabedbroadmin",
	"password"=>"Akhtar_ssint2021",
	"apicode"=>"1",
	"msisdn"=>$otp_mobile_no,
	"countrycode"=>"880",
	"cli"=>"Akhtar Feni",
	"messagetype"=>"3",
	"message"=>$msg,
	"messageid"=>"0"
));
$url = "https://gpcmp.grameenphone.com/ecmapigw/webresources/ecmapigw.v2";
$headers = array(
"Content-type: application/json",
"Content-length: ".strlen($arr)
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$resp = curl_exec($ch);
curl_close($ch);
// print $resp;

/* // +++++++++ SMS API - SONG BIRD +++++++++++++++
$apikey = "bf52e65810869207";
$apikey = urlencode($apikey);

$secretkey = "c4ba1e6a";
$secretkey = urlencode($secretkey);

$callerID = "RBB_FENI";
$callerID = urlencode($callerID);

$msg = urlencode($msg);
$otp_mobile_no = preg_replace('/^0?/','880',$otp_mobile_no);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://103.53.84.15:8746/sendtext?apikey=$apikey&secretkey=$secretkey&callerID=$callerID&toUser=$otp_mobile_no&messageContent=$msg");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$resp = curl_exec($ch);
curl_close($ch);
// print $resp; */
?>