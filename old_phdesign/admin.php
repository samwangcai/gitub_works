<?
session_start();
if(!isset($_SESSION['uname'])||$_SESSION['uname']=="")
{
	$pageGoto = "login.php";
	header(sprintf("Location: %s", $pageGoto));
}
include"includes/config.php";
include"includes/globalFunc.php";
include"includes/getData.php";
include"includes/login_out.php";
include"includes/pageNav.php";
//include("fckeditor/fckeditor.php") ;
/*
$page = 1;
$max = 20;
$type = 0;
$method = "artEdit";

if(isset($_GET['page'])&&$_GET['page']>0)
{
	$page = $_GET['page'];
}
if(isset($_GET['type'])&&$_GET['type']!="")
{
	$type = $_GET['type'];
}
if(isset($_GET['method'])&&$_GET['method']!="")
{
	$method = $_GET['method'];
}

$first = ($page-1)*$max;

if($method=="proEdit")
{
	$totalNum = getPNum("ch_",$type);
	$dataList = getPList("ch_",$type,"p_id",$first,$max);
}
else
{
	$totalNum = getANum("ch_",1);
	$dataList = getAList("ch_",1,"a_date",$first,$max);
}
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>phdesign admin page</title>
</head>
<body class="admin">
<div id="container">
	<? include"includes/a_header.php"; ?>
	<div class="mainbody">
		<? include"includes/a_nav.php"; ?>
		<div class="mainbox">
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="dataTable">
			<?
			echo "<tr><td>欢迎来到管理页面</td></tr>";
			?>
        </table>
		</div>
	</div>
	<? include"includes/a_footer.php"; ?>
</div>
</body>
</html>
