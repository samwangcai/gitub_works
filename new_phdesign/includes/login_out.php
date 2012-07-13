<?php
include_once"includes/config.php";
include_once"config.php";
// *** default message info. **
$msg = "您好, <span class='user'>".$_SESSION['uname']." </span>！";
// *** login the current user. **
$loginsubmit = 0;
$loginsubmit = $_POST['loginsubmit'] ;

$loginFormAction = $_SERVER['PHP_SELF'];
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
	$loginFormAction .= (strpos($loginFormAction, '?')) ? "&" : "?";
	$loginFormAction .= (str_replace("doLogin=true", "", $_SERVER['QUERY_STRING']));
}

if (isset($_POST['name']) && $loginsubmit == 1 ) {

  $conn = mysql_pconnect($mysql[0], $mysql[2], $mysql[3]) or trigger_error(mysql_error(),E_USER_ERROR); 
  mysql_select_db($mysql[1], $conn);
  //$conn = mysql_pconnect("221.231.138.101", "samwang", "wsw135246") or trigger_error(mysql_error(),E_USER_ERROR); 
  //mysql_select_db("samwang", $conn);
  $loginUsername=$_POST['name'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conn, $conn);
  
  $LoginRS__query=sprintf("SELECT * FROM cl_admin WHERE name='%s' AND password='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysql_query($LoginRS__query, $conn) or die(mysql_error());
  $row_user = mysql_fetch_assoc($LoginRS);
  
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser>0) {
     $loginStrGroup = "";

    //declare session variables and assign them
    $_SESSION['uid'] = $row_user['id'];
	$_SESSION['uname'] = $row_user['name'];
	$_SESSION['password'] = $row_user['password'];
	//$_SESSION['ulever'] = $row_user['u_lever'];
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	 
	$msg = "您好, <span class='user'>".$_SESSION['uname']."</span> ！";
	    
	//header(sprintf("Location: %s", $loginFormAction));
	
	$loginsubmit = 1;
  }  elseif($_POST['name']=="" || $_POST['password']=="") {
  	$msg = "<span class='alarm'>用户名,密码不能为空!</span>";
	$loginsubmit = 1;
  }	else {
    $msg = "<span class='alarm'>对不起,用户名、密码不匹配,请重试!</span>" ;
	$loginsubmit = 1;
  }
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
  $logoutAction .= (strpos($logoutAction, '?')) ? "&" : "?";
}
$pageGoto = $_SERVER['PHP_SELF'].(str_replace("doLogout=true", "?", $_SERVER['QUERY_STRING'])) ;

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['uid'] = NULL;
  $_SESSION['uname'] = NULL;
  $_SESSION['password'] = NULL;
  $_SESSION['ulever'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  unset($_SESSION['uid']);
  unset($_SESSION['uname']);
  unset($_SESSION['password']);
  unset($_SESSION['ulever']);
  unset($_SESSION['MM_UserGroup']);
  $pageGoto = "login.php";
  header(sprintf("Location: %s", $pageGoto));
}
?>
