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
$maxNo = 9;
$first = ($page-1)*$maxNo;

$table = $table_per."products";
if ($type!="")
{
	$sql = " where `category`='".$type."' order by add_time desc limit ".$first.", ".$maxNo.";";
}
else
{
	$sql = " where 1 order by add_time desc limit ".$first.", ".$maxNo.";";
}
$data = getData($table, $sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>products</title>
</head>
<body>
	<div class="container">
		<? include"includes/header_en.php"; ?>
		<div class="navigation">
			Location：
			<a href="index_en.php">Homepage</a> / 
			<a href="products_en.php">Products</a>
			<?
			if($type!="")
			{
				echo " / <a href='products_en.php?type=".$type."&page=".$page."'>".format_text("products", "en", $type)."</a>";
			}
			?>
		</div>
		<div class="mainbody">
			<div class="nav nav_en">
				<ul>
					<li class="title"><a href="products_en.php"><img src="images/nav_title_products.jpg" /></a></li>
					<?
					for ($i=1; $i<6; $i++)
					{
						echo "<li><a href='products_en.php?type=".$i."&page=".$page."'>".format_text("products", "en", $i)."</a></li>";
					}
					?>
				</ul>
			</div>
			<div class="maincontent">
				<div class="title" style="border-bottom:none;"><img src="images/title_products_<? echo $type; ?>_en.jpg" /></div>
				<div style="width:550px; text-align:right; float:right; margin-top:-40px;">
					<? pageNav($first, $maxNo, $data[0]); ?>
				</div>
			<?
				if ($data[0] >0 )
				{
					for($a=1;$a<=$data[0]; $a++)
					{
						if($data[$a]['id']!="")
						{
							$t = getTime($data[$a]["add_time"]);
							echo "<a class='_block products_block' href='products_detail_en.php?id=".$data[$a]['id']."'>";
							echo "<div class='img'><img src='".$folder.$data[$a]["thumb"]."'></div>";
							echo "<div class='s_title'><span class='txt'>".$data[$a]["title_en"]."</span><span class='time'>".$t['y'].".".$t[m].".".$t[d]."</span></div>";
							echo "<div class='s_con'>".$data[$a]["synopsis_en"]."</div>";
							echo "</a>";
						}
					}
				}
				else
				{
					echo "<div>no dates </div>";
				}
			?>
			</div>
		</div>
		<? include"includes/footer_en.php"; ?>
	</div>
</body>
</html>
