<?
include"includes/config.php";
include"includes/globalFunc.php";
include"includes/getData.php";

$c = "wallpaper";
$id = 0;
if(isset($_GET['id'])&&$_GET['id']>0)
{
	$id = $_GET['id'];
}
if($id>0)
{
	$data = getInfo("ph_wallpapers", "id", $id);
	$title = $data['title'];
}
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
	<?
	if($data['id']>0)
	{
	?>
	<div class="mainbody wallpapers">
		<div class="context">
			<h2><? echo $data['title']; ?></h2>
			<?
			$tmp = explode("||||",$data['content']);
			for($b=0; $b<count($tmp); $b++)
			{
				if($tmp[$b]!="")
				{
					echo  "<p>";
					$tmp2 = explode("||",$tmp[$b]);
					echo "<a href='".$folder.$tmp2[0]."'><img src='".$folder.$tmp2[0]."' target='_blank'></a><br>";
					echo "<a href='".$folder.$tmp2[0]."' target='_blank'>".$tmp2[1]."</a>";
					echo  "</p>";
				}
			}
			?>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
		</div>
	</div>
	<?
	}
	else
	{
		echo "<div style='margin:15px;'>";
		echo "<h2>Bad request.</h2>";
		echo "<p><a href='index.php'>back to home page.</a></p>";
		echo "</div>";
	}
	?>
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
