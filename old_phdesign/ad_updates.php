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

$page = 1;
$maxNo = 8;

if(isset($_GET['page'])&&$_GET['page']>0)
{
	$page = $_GET['page'];
}

$first = ($page-1)*$maxNo;
$data = getList("ph_updates","date","desc",$first,$maxNo);
/**/
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
		<p><input type="button" onclick="javascript:window.location.href='ad_updates_edit.php?page=<? echo $page; ?>';" value="add new updates" /></p>
		<?
			if (count($data) > 1 )
			{
				echo "<div class='pageNav'>";
				pageNav($first, $maxNo, $data[0]);
				echo "</div>";
				echo "<div class='space'></div>";
				for($a=1;$a<=$maxNo; $a++)
				{
					if($data[$a]['id']>0)
					{
						echo "<div class='dataLine'>";
						echo "<div class='img'><img src='".$folder.$data[$a]['img']."'></div>";
						echo "<a class='title' href='ad_updates_edit.php?id=".$data[$a]['id']."&page=".$page."'>".$data[$a]['title']."</a>";
						echo "<div class='date'><b>Date:</b> ".$data[$a]['date'];
						echo " &nbsp; &nbsp; &nbsp; &nbsp; <b>Author:</b> ".$data[$a]['author'];
						echo " &nbsp; &nbsp; &nbsp; &nbsp; <b>Tags:</b> ".$data[$a]['tags']."</div>";
						echo "<div class='synopsis'><b>Synopsis:</b> ".$data[$a]['context']."</div>";
						echo "<div class='space'></div>";
						echo "</div>";
					}
				}
				echo "<div class='space'></div>";
				echo "<div class='pageNav'>";
				pageNav($first, $maxNo, $data[0]);
				echo "<p>&nbsp;</p>";
				echo "<p>&nbsp;</p>";
				echo "</div>";
			}
			else
			{
				echo "<p>no dates </p>";
			}
		?>
		</div>
	</div>
	<? include"includes/a_footer.php"; ?>
</div>
</body>
</html>
