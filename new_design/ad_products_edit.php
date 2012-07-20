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

$from = "ad_products.php?page=".$_GET['page'];
$id = 0;
$page = 1;
$type = "";

if(isset($_GET['page'])&&$_GET['page']>0)
{
	$page = $_GET['page'];
}
if(isset($_GET['id'])&&$_GET['id']>0)
{
	$id = $_GET['id'];
}
$table = $table_per."products";
if($id>0)
{
	$data = getInfo($table, "id", $id);
	if($data['id']>0)
	{
		$type = "edit";
	}
}
else
{
	$type = "add";
}
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
		<div class="uploadFrameDiv" style="display:none;">
				<div id="uploadFrameDiv">
				  <h2><div style="width:100px; float:left;">Upload File</div><a href="###" class="closeIcon"></a></h2>
					<iframe id="uploadFrame" src="" frameborder="0"></iframe>
				</div>
			</div>
		<?
			if ($type == "edit")
			{
				echo "<h2>Edit exist products</h2>";
			}
			else
			{
				echo "<h2>Add new products</h2>";
			}
		?>
		<form action="ad_editFuncs.php" method="post">
			<input type="hidden" name="type" value="products" />
			<input type="hidden" name="fromPage" value="<? echo $from; ?>" />
			<input type="hidden" name="id" value="<? echo $data['id']; ?>" />
			<input type="hidden" name="thumb" id="thumb" value="<? echo $data['thumb']; ?>" />
			<table class="editTable" cellpadding="0" cellspacing="0" border="0" style="width:800px;">
				<tr>
					<th width="90">Title (中文):</td>
					<td><input type="text" name="title_zh" value="<? echo str_replace('"','&quot;',$data['title_zh']); ?>" /></td>
				</tr>
				<tr>
					<th width="90">Title (English):</td>
					<td><input type="text" name="title_en" value="<? echo str_replace('"','&quot;',$data['title_en']); ?>" /></td>
				</tr>
				<tr>
					<th>Date  :</td>
					<td><input type="text" name="add_time" value="<? if($type=="edit") { echo $data['add_time']; } else { echo date("Y-m-s H:i:s"); } ?>" /></td>
				</tr>
				<tr>
					<th>Category :</td>
					<td>
						<select name="category">
							<?
							for($a=1; $a<6; $a++)
							{
								echo "<option value='".$a."' ";
								if ($a==$data['category'])
								{
									echo  "selected=selected";
								}
								echo " >".format_text("products", "zh", $a)." - ".format_text("products", "en", $a)."</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<th>Size:</td>
					<td colspan="2">
						长: &nbsp; &nbsp;<input type="text" style="width:100px;" name="length" value="<? echo str_replace('"','&quot;',$data['length']); ?>" />
						&nbsp; &nbsp; &nbsp; 宽: &nbsp; &nbsp;<input type="text" style="width:100px;" name="width" value="<? echo str_replace('"','&quot;',$data['width']); ?>" />
						&nbsp; &nbsp; &nbsp; 高: &nbsp; <input type="text" style="width:100px;" name="height" value="<? echo str_replace('"','&quot;',$data['height']); ?>" />
					</td>
				</tr>
				<tr>
					<th>Weight:</td>
					<td colspan="2">
						净重: <input type="text" style="width:100px;" name="net_weight" value="<? echo str_replace('"','&quot;',$data['net_weight']); ?>" />
						&nbsp; &nbsp; &nbsp; 毛重: <input type="text" style="width:100px;" name="gross_weight" value="<? echo str_replace('"','&quot;',$data['gross_weight']); ?>" />
					</td>
				</tr>
				<tr>
					<th>Packaging (中文):</td>
					<td><input type="text" name="packaging_zh" value="<? echo str_replace('"','&quot;',$data['packaging_zh']); ?>" /></td>
				</tr>
				<tr>
					<th>Packaging (English):</td>
					<td><input type="text" name="packaging_en" value="<? echo str_replace('"','&quot;',$data['packaging_en']); ?>" /></td>
				</tr>
				<tr>
					<th>Material (中文):</td>
					<td colspan="2">
						<input type="text" name="material_zh" value="<? echo str_replace('"','&quot;',$data['material_zh']); ?>" />
					</td>
				</tr>
				<tr>
					<th>Material (English):</td>
					<td colspan="2">
						<input type="text" name="material_en" value="<? echo str_replace('"','&quot;',$data['material_en']); ?>" />
					</td>
				</tr>
				<tr>
					<th>Material text (中文):</td>
					<td><textarea name="material_txt_zh" ><? echo str_replace('"','&quot;',$data['material_txt_zh']); ?></textarea></td>
				</tr>
				<tr>
					<th>Material text (English):</td>
					<td><textarea name="material_txt_en" ><? echo str_replace('"','&quot;',$data['material_txt_en']); ?></textarea></td>
				</tr>
				<tr>
					<th>Synopsis (中文):</td>
					<td><textarea name="synopsis_zh" ><? echo str_replace('"','&quot;',$data['synopsis_zh']); ?></textarea></td>
				</tr>
				<tr>
					<th>Synopsis (English):</td>
					<td><textarea name="synopsis_en" ><? echo str_replace('"','&quot;',$data['synopsis_en']); ?></textarea></td>
				</tr>
				<tr>
					<th>Pictures:</td>
					<td>
						<input type="hidden" name="pictures" id="imgs" value="<? echo $data['pictures']; ?>" />
						<input type="button" id="uploadBtn" class="small" value="add pictures" style="margin-bottom:15px;" />
						<div class="imgs"></div>
					</td>
				</tr>
			</table>
			<p></p>
			<p>
				<input type="submit" value="Submit" />
				<input type="reset" value="Reset" />
				<input type="button" onclick="window.location.href='ad_products.php?page=<? echo $page; ?>';" value="Back" />
			</p>
		</form>
		</div>
		<p>&nbsp;</p>
	</div>
	<? include"includes/a_footer.php"; ?>
</div>
<script language="javascript">
$(document).ready(function(){
	var imgs = $("#imgs").val();
	var type = "mimg";
	if(imgs!="")
	{
		changeBgImg(type, imgs);
	}
	var cur = $("#thumb").val()?$("#thumb").val():0;
	set_main($(".imgs .img img:eq("+cur+")"));
}); 
function changeBgImg(type, imgs)
{
	if (type=="mimg")
	{
		var t = imgs.split("||");
		var imgList = new Array();
		var html = ""
		var vals = ""
		for(var a=0; a<t.length; a++)
		{
			if(t[a]!="")
			{
				vals += t[a] + "||";
				html += "<div class='img'><img src='images/upload/" + t[a] + "' onclick='set_main(this);' /><div class='closeIcon' onclick='removeImg(this);'></div></div>\n";
			}
		}
		$("#imgs").val(vals);
		$(".imgs").html(html);
	}
	else if(type=="mimgu")
	{
		var pics = $("#imgs").val() + "||" + imgs + "||";
		var type = "mimg";
		$("#imgs").val(pics);
		changeBgImg(type, pics);
	}
	else 
	{
		$("#uploadBtn").hide();
		$("#removeBtn").show();
		var pics = $("#imgs").val();
		var type = "mimg";
		pics = pics.replace(imgs+"||");
		changeBgImg(type, pics);
	}
	
	var cur = $("#thumb").val()?$("#thumb").val():0;
	if (cur<0) { cur = 0; }
	if (cur>$(".imgs .img").length-1) { cur = $(".imgs .img").length-1; }
	set_main($(".imgs .img img:eq("+cur+")"));
}
function set_main(obj)
{
	if($(obj).attr("src")!=""||$(obj).attr("src")!="undefined")
	{
		$(".imgs .img").removeClass("imgon");
		$(obj).parent().addClass("imgon");
	}
	$("#thumb").val($(".imgs .img img").index($(obj)));
}
$(".uploadFrameDiv, .InforDiv").draggable({
	handle: "h2"
});
$("#uploadBtn").bind("click",function(){
	$(".uploadFrameDiv").css("left",$(this).position().left-0);
	$(".uploadFrameDiv").css("top",$(this).position().top+30);
	$(".uploadFrameDiv").show();
	$("#uploadFrame").attr("src","ad_pictures_iframe.php?f=mimgu");
})
function removeImg(obj)
{
	var url = top.location.href.split("ad_")[0];
	var img = $(obj).prev().attr("src").replace(url, "").replace("images/upload/", "");
	if (img!="")
	{
		var pics = $("#imgs").val();
		pics = pics.replace(img+"||", "");
		$("#imgs").val(pics);
		var type = "mimg";
		changeBgImg(type, pics);
	}
}
$("#uploadFrameDiv h2 a").bind("click",function(){
	$(".uploadFrameDiv").hide();
})
</script>
</body>
</html>
