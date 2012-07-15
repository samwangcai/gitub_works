<?
session_start();
include"includes/config.php";
// *** default message info. **
$msg = "欢迎<b>".$_SESSION['uname']."</b>到来！";
// *** login the current user. **
$loginsubmit = 0;
$loginsubmit = $_POST['loginsubmit'] ;

$loginFormAction = $_SERVER['PHP_SELF'];
$pageGoto = "ad_index.php";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
	$loginFormAction .= (strpos($loginFormAction, '?')) ? "&" : "?";
	$loginFormAction .= (str_replace("doLogin=true", "", $_SERVER['QUERY_STRING']));
}

if (isset($_POST['name']) && $loginsubmit == 1 ) {
  $conn = mysql_pconnect($hostname_conn, $username_conn, $password_conn) or trigger_error(mysql_error(),E_USER_ERROR); 
  mysql_select_db($database_conn, $conn);
  $loginUsername=$_POST['name'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conn, $conn);
  
  $LoginRS__query=sprintf("SELECT * FROM %sadmin WHERE name='%s' AND password='%s'",
    $table_per, get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysql_query($LoginRS__query, $conn) or die(mysql_error());
  $row_user = mysql_fetch_assoc($LoginRS);
  
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser>0) {
     $loginStrGroup = "";

    //declare session variables and assign them
    $_SESSION['uid'] = $row_user['id'];
	$_SESSION['uname'] = $row_user['name'];
	$_SESSION['password'] = $row_user['password'];
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	 
	$msg = "欢迎<b>".$_SESSION['uname']."</b>到来！";
	    
	header(sprintf("Location: %s", $pageGoto));
	
	$loginsubmit = 1;
  }  elseif($_POST['name']=="" || $_POST['password']=="") {
  	$msg = "<span class='alarm'>用户名,密码不能为空!</span>";
	$loginsubmit = 1;
  }	else {
    $msg = "<span class='alarm'>对不起,用户名、密码不匹配,请重试!</span>" ;
	$loginsubmit = 1;
  }
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>asdfasf</title>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<meta name="robots" content="noindex, nofollow">
<script language="javascript" src="js/jquery.js"></script>
</head>
<body>
<div id="container">
    <form ACTION="<?php echo $loginFormAction; ?>" method="POST" name="formlogin" >
		<table width="300px" cellpadding="0" cellspacing="0" border="0" style="margin:10px auto;">
			<tr>
				<th colspan="2" height="25" align="left">管理员登陆:</th>
			</tr>
			<tr>
				<td width="70" valign="middle"><div class="light">登陆名：</div></td>
				<td width="85" valign="middle"><input name="name" value="" type="text" class="input1" /></td>
			</tr>
			<tr>   
				<td width="60" valign="middle"><div class="light">密码：</div></td>
				<td width="85" valign="middle"><input name="password" value="" type="password" class="input1" /></td>
			</tr>
			<tr>    
				<input name="loginsubmit" type="hidden" value="1" />
				<td width="45" valign="middle"><input type="submit" value="登陆" class="btn1" /></td>
			</tr>
		</table>
    </form>
</div>
<script language="javascript" src="js/aaa.js"></script>
<script language="javascript">
<!--[if gte IE 5.5000]>
window.onload = correctPNG;
<!--[endif]--> 
</script>
</body>
</html>