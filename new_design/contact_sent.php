<?php
session_start();
include"includes/config.php";

$method = $_POST['m'];
$title = $_POST['title'];
$name = $_POST['name'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$company = $_POST['company'];
$post = $_POST['post'];
$interested_in = $_POST['interested_in'];
$note = $_POST['note'];
/*
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
*/
$conn = mysql_pconnect($mysql[0], $mysql[2], $mysql[3]) or trigger_error(mysql_error(),E_USER_ERROR); 

if ($method == "send"&&$title!=""&&$suname!=""&&$email!=""&&$request!="")
{
	echo sentEmailAlert($title,$name,$email,$tel,$company, $post, $interested_in, $note);
}

function sentEmailAlert($title,$name,$email, $tel, $company, $post, $interested_in, $note)
{
	global $mailto; 
	$sub = 'phaidesing - webside mail';
	$msg = "Title:".$title."\r\n Name:".$name."\r\n Email:".$email."\r\n Tel/Tel:".$tel."\r\n Company:".$company."\r\n Post:".$post."\r\n Interested in:".$interested_in."\r\n Note:".$note;
	$headers = "From: ".$mailto."\r\nReply-To: ".$mailto;
	if(mail($mailto, $sub, $msg, "From: $from")) { return 1; }
}
?>