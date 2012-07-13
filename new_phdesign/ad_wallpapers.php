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
$maxNo = 100;

if(isset($_GET['page'])&&$_GET['page']>0)
{
	$page = $_GET['page'];
}

$first = ($page-1)*$maxNo;
$data = getList("ph_wallpapers","oid","asc",$first,$maxNo);
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
		<p><input type="button" onclick="javascript:window.location.href='ad_wallpapers_edit.php?page=<? echo $page; ?>';" value="add new wallpapers" /></p>
		<?
			if ($data[0] >0 )
			{
				//echo "<div class='pageNav'>";
				//pageNav($first, $maxNo, $data[0]);
				//echo "</div>";
				echo "<div class='space'></div>";
				echo "<div id='wallpaperList'>";
				for($a=1;$a<=$data[0]; $a++)
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
					$types = "";
					for($x=0; $x<(count($tmp)-1); $x++)
					{
						$t = explode("||",$tmp[$x]);
						$types .= $t[1]." , ";
					}
					echo "<div class='dataLine' aid='".$data[$a]['id']."'>";
					echo "<div class='img'><img src='".$folder.$img."'></div>";
					echo "<a class='title' href='ad_wallpapers_edit.php?id=".$data[$a]['id']."&page=".$page."'>".$data[$a]['title']."</a>";
					echo "<div class='synopsis'><b>Types:</b> ".$types."</div>";
					echo "<div class='space'></div>";
					echo "</div>";
				}
				echo "</div>";
				echo "<div class='space'></div>";
				//echo "<div class='pageNav'>";
				//pageNav($first, $maxNo, $data[0]);
				//echo "</div>";
				echo "<p>&nbsp;</p>";
				echo "<p>&nbsp;</p>";
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
<script language="javascript">
$("#wallpaperList").sortable({
	stop: function(event, ui) {
		resetOrderlist();
	}
});
function resetOrderlist()
{
	var alist = "";
	var list = $(".dataLine");
	for(var a=0; a<list.length; a++)
	{
		alist += $(list[a]).attr("aid")+",";
	}
	$.ajax({
		type: "POST",
		url: "ad_ajax.php",
		data: "method=makeOrder&type=wallpapers&list="+alist,
		success: function(html)
		{
			if(html=="updated")
			{
			}
			else
			{
				//alert("web connect error, please try again.")
			}
		}
	});
}
</script>
</body>
</html>
