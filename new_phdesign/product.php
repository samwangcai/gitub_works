<?
include"includes/config.php";
include"includes/globalFunc.php";
include"includes/getData.php";

$id = 0;
if(isset($_GET['id'])&&$_GET['id']>0)
{
	$id = $_GET['id'];
}
if($id>0)
{
	$data = getInfo("ph_products", "id", $id);
}
$c = "product";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Phdesign - <? echo $data['title']; ?></title>
<link href="css/global.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container">
	<div class="floatDiv"><div class="logo"></div><div class="close" onclick="hideBigImg()">close</div><div class="space"></div><p><img src="" /></p></div>
	<div class="maskDiv"></div>
	<? include"includes/header.php"; ?>
	<div class="space"></div>
	<div class="mainbody product">
		<div class="space"></div>
		<div class="context">
		<?
		if($data['id']>0)
		{
		?>
			<div id="imgsDiv" style="display:none;"><? echo $data['img']; ?></div>
			<div class="topTitle"><span><? echo $data['title']; ?></span></div>
			<div class="productImgs">
				<div class="imgs"></div>
				<div class="imgs"></div>
			</div>
			<div class="space"></div>
			<table cellpadding="0" cellspacing="0" border="0" style="width:98%">
				<tr>
					<td width="300" class="borderRight">
					<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<th width="110">category:</th>
						<td width="190"><? echo str_replace("||"," / ",str_replace("_"," ",$data['category'])); ?></td>
					</tr>
					<tr>
						<th>product place:</th>
						<td><? echo $data['place']; ?></td>
					</tr>
					<tr>
						<th>material:</th>
						<td><? echo str_replace("||"," / ",$data['material']); ?></td>
					</tr>
					<tr>
						<th>specification:</th>
						<td><? echo $data['specification']; ?></td>
					</tr>
					<tr>
						<th>colour:</th>
						<td><? echo str_replace("||"," / ",$data['material']); ?></td>
					</tr>
					<tr>
						<th>packaging:</th>
						<td><? echo $data['packaging']; ?></td>
					</tr>
					<tr>
						<th>designer:</th>
						<td><? echo $data['designer']; ?></td>
					</tr>
					<tr>
						<th>price:</th>
						<td><? echo $data['price']; ?></td>
					</tr>
					</table>
					<p>&nbsp;</p>
					</td>
					<td>
						<div class="proDetails">
							<p><? echo str_replace("\n","<br />",$data['context']); ?></p>
						</div>
					</td>
				</tr>
			</table>
			<p>&nbsp;</p>
		<?
		}
		else
		{
			echo  "<div style='margin:20px;'><h2>Bad request.</h2><p><a href='products.php'>Back to products page</a></p></div>";
		}
		?>
		</div>
	</div>
	<div class="space"></div>
	<? include"includes/footer.php"; ?>
</div>
<script language="javascript">
var t ;
$(document).ready(function(){
	t = setInterval(setImgs,1500);
}); 
$(window).resize(function(){
	clearInterval(t)
	t = setInterval(setImgs,1500);
});
function setImgs()
{
	var imgs = $("#imgsDiv").html();
	if(imgs!="")
	{
		var t = imgs.split("||");
		var html = ""
		var n = 0;
		for(var a=0; a<t.length; a++)
		{
			if(t[a]!="")
			{
				n += 1 ;
				html += "<div class='imgs' onclick='showBigImg(this);'><img src='images/upload/" + t[a] + "' /></div>\n";
			}
		}
		$(".productImgs").html(html);
		var ieSpace = 0;
		if ($.browser.msie)
		{
			ieSpace = 20;
		}
		//alert(jQuery.support.boxModel)
		var width = Math.floor(($(".productImgs").width()-ieSpace)/n);
		var height = Math.floor(width*4/3);
		if (height > 250) { height = 250; }
		$(".productImgs").find(".imgs").css("width", width-2);
		$(".productImgs").find(".imgs").css("height", height);
		//$(".productImgs").find("img").css("width", width-1);
		$(".productImgs").find("img").css("height", height);
		//alert($(".productImgs").width() + ' ' + $(".productImgs").find(".imgs").width())
	}
}
function showBigImg(obj)
{
	var img = $(obj).find("img").attr("src");
	var width = $("body").width();
	var height = $("body").height();
	a = getPageSize();
	$(".floatDiv").find("img").attr("src", img);
	$(".floatDiv").find("img").css("width", parseInt(width*0.7));
	$(".floatDiv").css("left", width*0.15);
	$(".maskDiv").show(300);
	$(".floatDiv").show(300, function(){
		var top = height/2-$(".floatDiv").find("img").height()/2
		if(top<=0)
		{
			top = 10;
		}
		$(".floatDiv").css("top", top);
		$(".maskDiv").css("height", a[3]);
		$(".maskDiv").css("width", $("body").width());
	});
	$(".footer").hide();
}
function hideBigImg()
{
	$(".maskDiv").hide(300);
	$(".floatDiv").hide(300);
	$(".footer").show();
}
</script>
</body>
</html>
