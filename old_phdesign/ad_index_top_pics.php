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

if($_POST['type']=="pics")
{
	$keys = array();
	$vals = array();
	foreach($_POST as $k => $v)
	{
		array_push($keys, $k);
		array_push($vals, $v);
	}
	global $mysql ; 
	$conn = mysql_pconnect($mysql[0], $mysql[2], $mysql[3]) or trigger_error(mysql_error(),E_USER_ERROR) ; 
	mysql_select_db($mysql[1], $conn) ;
	mysql_query("set names 'utf-8'") ;
	
	$table = "ph_pics";
	$sql_query = "";
	for($a=0; $a<count($keys); $a++)
	{
		$sql_query = "update ".$table." set `url`='".$vals[$a]."' where `id` = '".$keys[$a]."';";
		$sql = sprintf($sql_query) ;
		mysql_query($sql, $conn) or die(mysql_error());
	}
}

$data = getList("ph_pics","name","asc",0,100);

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
		<div class="uploadFrameDiv" style="display:none;">
			<div id="uploadFrameDiv">
				<h2><div style="width:100px; float:left;">Upload File</div><a href="###" class="closeIcon"></a></h2>
				<iframe id="uploadFrame" src="" frameborder="0"></iframe>
			</div>
		</div>
		<form action="?" method="post">
			<input type="hidden" name="type" value="pics" />
			<table class="editTable" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td colspan="3"><h2>Homepage top 4 pictures edit</h2></td>
				</tr>
				<?
				for($a=1; $a<=$data[0]; $a++)
				{
					echo "<tr>";
					echo "<th width=100>".$data[$a]['name']."</th>";
					echo "<td width=160><img src='".$folder.$data[$a]['url']."' width=160 height=120 /></td>";
					echo "<td><input type='text' name='".$data[$a]['id']."' value='".$data[$a]['url']."' ></td>";
					echo "</tr>";
				}
				?>
			</table>
			<p></p>
			<p>
				<input type="submit" value="Submit" />
				<input type="reset" value="Reset" />
				<input type="button" onclick="window.location.href='ad_articles.php?page=<? echo $page; ?>';" value="Back" />
			</p>
		</form>
		<div class="space"></div>
		<p>&nbsp;</p>
		</div>
	</div>
	<? include"includes/a_footer.php"; ?>
</div>
			


