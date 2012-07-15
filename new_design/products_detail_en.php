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

$id = $_GET['id']?$_GET['id']:0;
$table = $table_per."products";

$data = getInfo($table, "id", $id);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>phdesign admin page</title>
<style>
.div_0 { background-image:url(http://www.veaone.com/images/upload/pca_cover.jpg); }
.div_1 { background-image:url(http://www.veaone.com/images/upload/s_and_s_cover_01.jpg); }
.div_2 { background-image:url(http://www.veaone.com/images/upload/versus_cover.jpg); }
.div_3 { background-image:url(http://www.veaone.com/images/upload/starting11_cover.jpg); }
.div_4 { background-image:url(http://www.veaone.com/images/upload/nerf_cover.jpg); }
 
</style>
</head>
<body>
	<div class="container">
		<? include"includes/header_en.php"; ?>
		<div class="navigation">
			Location：
			<a href="index_en.php">Homepage</a> / 
			<a href="products_en.php">Products</a>
			<?
			if($data['id']!="")
			{
				echo " / <a href='#'>".$data['title_en']."</a>";
			}
			?>
		</div>
		<div class="mainbody">
			<div class="bannerBlock">
				<div class="imgList" cid="0">
					<div title="7 People's Choice Awards" src="images/upload/pca_cover.jpg"></div>
					<div title="6 Sticks and Stones Show Open" src="images/upload/s_and_s_cover_01.jpg"></div>
					<div title="5" src="images/upload/versus_cover.jpg"></div>
					<div title="4" src="images/upload/starting11_cover.jpg"></div>
					<div title="2" src="images/upload/nerf_cover.jpg"></div>
				</div>
				<div class="prevBtn"></div>
				<div class="nextBtn"></div>
	
				<div class="moveNav"></div>
				
				<div class="div_0"></div>
				<div class="div_1"></div>
				<div class="div_2"></div>
				<div class="div_3"></div>
				<div class="div_4"></div>
				
				<div class="moveOut">
					<div class="moveWidthOut">
						<div class="blockImg block0"></div>
						<div class="blockImg block1"></div>
						<div class="blockImg block2"></div>
					</div>		
				</div>	
				<?
					if($data['id']!="")
					{
						$t = getTime($data[$a]["add_time"]);
						echo "<a class='_block products_block' href='product_detail_en.php?id=".$data[$a]['id']."'>";
						echo "<div class='img'><img src='".$folder.$data[$a]["thumb"]."'></div>";
						echo "<div class='s_title'><span class='txt'>".$data[$a]["title_en"]."</span><span class='time'>".$t['y'].".".$t[m].".".$t[d]."</span></div>";
						echo "<div class='s_con'>".$data[$a]["synopsis_en"]."</div>";
						echo "</a>";
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
<script language="javascript">
var tag = 0;
$(document).ready(function(){
	setBannerNavPos();
	setNavFunc();
	setDefaultImgs();
});
$(".bannerBlock").bind("mouseover",function(){
	clearTimeout(y);
})
$(".bannerBlock").bind("mouseout",function(){
	y = setInterval(nextFunc,30000);
})
var y = setInterval(nextFunc,30000);
</script>	
</body>
</html>
