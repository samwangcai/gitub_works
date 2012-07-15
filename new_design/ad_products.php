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

$page = $_GET['page']?$_GET['page']:1;
$type = $_GET['type']?$_GET['type']:"";
$maxNo = 8;
$first = ($page-1)*$maxNo;

$table = $table_per."products";
$sql = " where `category`='".$type."' order by add_time desc limit ".$first.", ".$maxNo.";";
$data = getData("ph_products","date","desc",$first,$maxNo);
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
		<p><input type="button" onclick="javascript:window.location.href='ad_products_edit.php?page=<? echo $page; ?>';" value="add new products" /></p>
		<?
			if ($data[0] >0 )
			{
				echo "<div class='pageNav'>";
				pageNav($first, $maxNo, $data[0]);
				echo "</div>";
				echo "<div class='space'></div>";
				for($a=1;$a<=$data[0]; $a++)
				{
					if ($data[$a]['id']!="")
					{
						$img = explode("||",$data[$a]['img']);
						$img = str_replace("||","",$img[0]);
						echo "<div class='dataLine'>";
						echo "<div class='img'><img src='".$folder.$img."'></div>";
						echo "<a class='title' href='ad_products_edit.php?id=".$data[$a]['id']."&page=".$page."'>".$data[$a]['title']."</a>";
						echo "<div class='date'><b>Date:</b> ".$data[$a]['date'];
						echo " &nbsp; &nbsp; &nbsp; &nbsp; <b>Place:</b> ".$data[$a]['place'];
						echo " &nbsp; &nbsp; &nbsp; &nbsp; <b>Specification:</b> ".$data[$a]['specification']."</div>";
						echo "<div class='date'><b>Packaging:</b> ".$data[$a]['packaging'];
						echo " &nbsp; &nbsp; &nbsp; &nbsp; <b>Designer:</b> ".$data[$a]['designer'];
						echo " &nbsp; &nbsp; &nbsp; &nbsp; <b>Price:</b> ".$data[$a]['price']."</div>";
						echo "<div class='date'><b>Category:</b> ".str_replace("_"," ",str_replace("||"," / ",$data[$a]['category']))."</div>";
						echo "<div class='date'><b>Material:</b> ".str_replace("_"," ",str_replace("||"," / ",$data[$a]['material']))."</div>";
						echo "<div class='date'><b>Colour:</b> ".str_replace("_"," ",str_replace("||"," / ",$data[$a]['colour']))."</div>";
						echo "<div class='synopsis'><b>Synopsis:</b> ".str_replace("\n","<br>",$data[$a]['context'])."</div>";
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
				echo "<h2>no dates </h2>";
			}
		?>
		</div>
	</div>
	<? include"includes/a_footer.php"; ?>
</div>
</body>
</html>
