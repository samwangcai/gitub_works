<?
include"includes/config.php";
include"includes/globalFunc.php";
include"includes/getData.php";

$c = "article";
$id = 0;
if(isset($_GET['id'])&&$_GET['id']>0)
{
	$id = $_GET['id'];
}
if($id>0)
{
	$data = getInfo("ph_articles", "id", $id);
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
	<div class="mainbody article" style="background-image:url(images/upload/<? echo $data['img']; ?>);">
		<div class="contextDown">
			<h2><? echo $data['title']; ?></h2>
			<table>
				<tr>
					<td width="33%" valign="top">
						<? echo str_replace("\n","<br />",$data['context1']); ?>
					</td>
					<td width="33%" valign="top">
						<? echo str_replace("\n","<br />",$data['context2']); ?>
					</td>
					<td width="33%" valign="top" style="border:none;">
						<? echo str_replace("\n","<br />",$data['context3']); ?>
					</td>
				</tr>
			</table>
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
</body>
</html>
