<?php
session_start();
include"includes/config.php";

$method = $_POST['m'];
$title = $_POST['title'];
$suname = $_POST['suname'];
$givenname = $_POST['givenname'];
$pressname = $_POST['pressname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$request = $_POST['request'];
/*
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
*/
$conn = mysql_pconnect($mysql[0], $mysql[2], $mysql[3]) or trigger_error(mysql_error(),E_USER_ERROR); 

if ($method == "send"&&$title!=""&&$suname!=""&&$email!=""&&$request!="")
{
	echo sentEmailAlert($title,$suname,$givenname,$pressname,$email,$phone,$request);
}

function sentEmailAlert($title,$suname,$givenname,$pressname,$email,$phone,$request)
{
	global $mailto; 
	$sub = 'Phdesign press room mail';
	$msg = "Title:".$title."\r\n Suname:".$suname."\r\n Givenname:".$givenname."\r\n Pressname:".$pressname."\r\n Email:".$email."\r\n Tel/mobile:".$phone."\r\n Request:".$request;
	$headers = "From: wswwangcai1981@126.com\r\nReply-To: wswwangcai1981@126.com";
	if(mail($mailto, $sub, $msg, "From: $from")) { return 1; }
}
?>