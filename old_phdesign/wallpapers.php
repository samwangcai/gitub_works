<?
include"includes/config.php";
include"includes/globalFunc.php";
include"includes/getData.php";
include"includes/pageNav.php";

$c = "wallpapers";
$page = 1;
$maxNo = 8;
if(isset($_GET['page'])&&$_GET['page']>0)
{
	$page = $_GET['page'];
}
$first = ($page-1)*$maxNo;
$data = getList("ph_wallpapers","oid","asc",$first,$maxNo);
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

	<div class="mainbody wallpapers">
		<div class="context">
			<h2>Wallpapers</h2>
			<?
			if($data[0]>0)
			{
				for($a=1; $a<count($data); $a++)
				{
					$tmp = explode("||||",$data[$a]['content']);
					$tmp2 = explode("||",$tmp[0]);
					$img = $tmp2[0];
					for($b=0; $b<count($tmp); $b++)
					{
						$tmp2 = explode("||",$tmp[$b]);
						if ($tmp2[2] == 1)
						{
							$img = $tmp2[0];
							break;
						}
					}
					echo "<div class='innerBlock'>";
					echo "<a class='img img2 bleft' href='wallpaper.php?id=".$data[$a]['id']."'><img src='".$folder.$img."'></a>";
					echo "<div class='bright'>";
					for($b=0; $b<count($tmp); $b++)
					{
						$tmp2 = explode("||",$tmp[$b]);
						echo "<a class='link' href='".$folder.$tmp2[0]."' target='_blank'>".$tmp2[1]."</a>";
					}
					echo "</div>";
					echo "<div class='space'></div>";
					echo "</div>";
					echo "<div class='space'></div>";
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
		<div class="space"></div>
		<div>
			<? 
			if ($wallpapers[0]>0)
			{
				pageNav(0,$maxNo,$wallpapers[0]);
			}
			?>
		</div>
		<p>&nbsp;</p>
	</div>
	<div class="space"></div>
	<? include"includes/footer.php"; ?>
</div>
<script language="javascript">
var t ;
$(document).ready(function(){
	t = setInterval(setPage,50);
}); 
</script>
</body>
</html>
