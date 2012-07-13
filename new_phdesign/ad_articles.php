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
$data = getList("ph_articles","oid","asc",$first,$maxNo);
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
		<p><input type="button" onclick="javascript:window.location.href='ad_articles_edit.php?page=<? echo $page; ?>';" value="add new articles" /></p>
		<?
			if ($data[0] >0 )
			{
				//echo "<div class='pageNav'>";
				//pageNav($first, $maxNo, $data[0]);
				//echo "</div>";
				echo "<div class='space'></div>";
				echo "<div id='articleList'>";
				for($a=1;$a<=$data[0]; $a++)
				{
					echo "<div class='dataLine' aid='".$data[$a]['id']."'>";
					echo "<div class='img'><img src='".$folder.$data[$a]['img']."'></div>";
					echo "<a class='title' href='ad_articles_edit.php?id=".$data[$a]['id']."&page=".$page."'>".$data[$a]['title']."</a>";
					echo "<div class='synopsis'><b>Context1:</b> ".str_replace("\n","<br />",$data[$a]['context1'])."</div>";
					echo "<div class='synopsis'><b>Context2:</b> ".str_replace("\n","<br />",$data[$a]['context2'])."</div>";
					echo "<div class='synopsis'><b>Context3:</b> ".str_replace("\n","<br />",$data[$a]['context3'])."</div>";
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
$("#articleList").sortable({
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
		data: "method=makeOrder&type=article&list="+alist,
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
