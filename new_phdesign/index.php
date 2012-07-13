<?
include"includes/config.php";
include"includes/globalFunc.php";
include"includes/getData.php";

$c = "homepage";
$top_pic_data = getList("ph_pics","name","asc",0,100);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>phdesign</title>
<link href="css/global.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container">
	<? include"includes/header.php"; ?>
	<div class="space"></div>
	<div class="mainbody">
		<div class="topBlocks" style="border:1px solid #000;">
			<?
			$top_article_list = getList("ph_articles","oid","asc",0,10);
			for ($a=1; $a<5; $a++)
			{
				echo "<div class='topBlock'>";
				echo "<a class='text' href='article.php?id=".$top_article_list[$a]['id']."'>".ucfirst($top_article_list[$a]['title'])."</a>";
				echo "<a href='article.php?id=".$top_article_list[$a]['id']."'><img src='".$folder.$top_pic_data[$a]['url']."' /></a>";
				echo "</div>";
			}
			/*
			echo "<div class='topBlock'>";
			echo "<a class='text' href='article.php?id=".$top_article_list[1]['id']."'>".$top_article_list[1]['title']."</a>";
			echo "<a href='article.php?id=".$top_article_list[1]['id']."'><img src='".$folder.$top_pic_data[1]['url']."' /></a>";
			echo "</div>";
			?>
			<!--div class='topBlock'>
			<a class='text' href='products.php'>Products</a>
			<a href='products.php'><img src='<? echo $folder.$top_pic_data[2]['url']; ?>' /></a>			</div-->
			<?
			echo "<div class='topBlock'>";
			echo "<a class='text' href='article.php?id=".$top_article_list[2]['id']."'>".$top_article_list[2]['title']."</a>";
			echo "<a href='article.php?id=".$top_article_list[2]['id']."'><img src='".$folder.$top_pic_data[3]['url']."' /></a>";
			echo "</div>";
			echo "<div class='topBlock'>";
			echo "<a class='text' href='article.php?id=".$top_article_list[3]['id']."'>".$top_article_list[3]['title']."</a>";
			echo "<a href='article.php?id=".$top_article_list[3]['id']."'><img src='".$folder.$top_pic_data[4]['url']."' /></a>";
			echo "</div>";
			*/
			?>			
		</div>
		<div class="space"></div>
		<div class="content" style="margin-bottom:15px;">
			<div class="index_left">
				<div class="toptitle"><a href="updates.php"><img src="images/index_title_updates.gif" /></a></div>
				<div class="space"></div>
				<div class="bbb">
				<?
					$updates = getList("ph_updates","date","desc",0,10);
					if(count($updates)>1)
					{
						for($a=1; $a<count($updates); $a++)
						{
							echo "<div class='innerBlock'>";
							echo "<a href='updates.php?id=".$updates[$a]['id']."' class='btitle' title='".$updates[$a]['title']."'>".$updates[$a]['title']."</a>";
							echo "<div class='date'>".date("F d Y H:i ", strtotime($updates[$a]['date']))."GMT</div>";
							echo "<div class='author'>".$updates[$a]['author']." <b>Tag:</b> ".$updates[$a]['tags']."</div>";
							echo "</div>";
						}
					}
					else
					{
						echo "<div class='innerBlock'>";
						echo "<h2>No datas.</h2>";
						echo "</div>";
					}
				?>
				</div>
				<p style="margin-bottom:10px;">&nbsp;</p>
			</div>
			<div class="index_middle">
				<div class="toptitle"><a href="products.php"><img src="images/index_title_products.gif" /></a></div>
				<div class="space"></div>
				<div class="bbb">
				<?
					$products = getList("ph_products","id","desc",0,5);
					if(count($products)>1)
					{
						for($a=1; $a<count($products); $a++)
						{
							$img = explode("||",$products[$a]['img']);
							$img = str_replace("||","",$img[0]);
							echo "<div class='innerBlock'>";
							echo "<a class='img' href='product.php?id=".$products[$a]['id']."'><img src='".$folder.$img."'></a>";
							echo "<div class='bright'>";
							echo "<a href='product.php?id=".$products[$a]['id']."' class='btitle' title='".$products[$a]['title']."'>".$products[$a]['title']."</a>";
							echo "<div><a href='product.php?id=".$products[$a]['id']."'>".str_replace("\n","<br>",$products[$a]['context'])."</a></div>";
							echo "</div>";
							echo "</div>";
						}
					}
					else
					{
						echo "<div class='innerBlock'>";
						echo "<h2>No datas.</h2>";
						echo "</div>";
					}
				?>
				</div>
				<p style="margin-bottom:10px;">&nbsp;</p>
			</div>
			<div class="index_right">
				<div class="toptitle"><a href="wallpapers.php"><img src="images/index_title_wallpapers.gif" /></a></div>
				<div class="space"></div>
				<div class="bbb">
				<?
					$wallpapers = getList("ph_wallpapers","oid","asc",0,5);
					if(count($wallpapers)>1)
					{
						for($a=1; $a<count($wallpapers); $a++)
						{
							$tmp = explode("||||",$wallpapers[$a]['content']);
							$tmp2 = explode("||",$tmp[0]);
							$img = $tmp2[0];
							$types = "";
							for($x=0; $x<(count($tmp)-1); $x++)
							{
								$t = explode("||",$tmp[$x]);
								$types .= "<a href='wallpaper.php?id=".$wallpapers[$a]['id']."#".$t[1]."'>".$t[1]."</a><br>";
							}
							echo "<div class='innerBlock'>";
							echo "<a class='img img2' href='wallpaper.php?id=".$wallpapers[$a]['id']."'><img src='".$folder.$img."'></a>";
							echo "<div class='bright' style='height:130px;'>";
							echo "<a href='wallpaper.php?id=".$wallpapers[$a]['id']."#".$t[1]."' class='btitle'>".$wallpapers[$a]['title']."</a>";
							echo "<div class='date'>".$types."</div>";
							echo "</div>";
						}
					}
					else
					{
						echo "<div class='innerBlock'>";
						echo "<h2>No datas.</h2>";
						echo "</div>";
					}
				?>
				</div>
				<p style="margin-bottom:10px;">&nbsp;</p>
			</div>
			<div class="space"></div>
		</div>
		<div class="space"></div>
	</div>
	<div class="space"></div>
	<? include"includes/footer.php"; ?>
</div>
<script language="javascript">
var t ;
$(document).ready(function(){
	t = setInterval(setBlocks,50);
}); 
$(window).resize(function(){
	clearInterval(t)
	t = setInterval(setBlocks,50);
});
function setBlocks()
{
	// set top 4 pictures
	var blocks = $(".topBlocks").html();
	if(blocks!="")
	{
		var n = 4;
		var width = parseInt($(".topBlocks").width()/n);
		var height = parseInt(width*4/3);
		if (height > 230) { height = 230; }
		$(".topBlocks").find(".topBlock").css("width", width-2);
		$(".topBlocks").find(".topBlock").css("height", height);
		$(".topBlocks").find("img").css("height", height);
		$(".topBlocks").find("topBlock").css("height", height);
	}
	
	// set bottom 3 blocks
	//var bwidth = ($(".content").width()/3 - 20);
	//if (bwidth > 320)
	//{
	//	bwidth = 320
	//}
	
	$(".index_left").css("width", width-10);
	$(".index_right").css("width", width-5);
	$(".index_middle").css("width", ($(".content").width() - $(".index_left").width() - $(".index_right").width() - 30))
}

</script>
</body>
</html>
