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

if($id>0)
{
	$data = getInfo("ph_products", "id", $id);
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
			<input type="hidden" name="img" id="imgs" value="<? echo $data['img']; ?>" />
			<input type="hidden" name="category" id="category" value="<? echo $data['category']; ?>" />
			<input type="hidden" name="material" id="material" value="<? echo $data['material']; ?>" />
			<input type="hidden" name="colour" id="colour" value="<? echo $data['colour']; ?>" />
			<table class="editTable" cellpadding="0" cellspacing="0" border="0" style="width:800px;">
				<tr>
					<th width="90">Title:</td>
					<td><input type="text" name="title" value="<? echo str_replace('"','&quot;',$data['title']); ?>" /></td>
				</tr>
				<tr>
					<th>Date  :</td>
					<td><input type="text" name="date" value="<? if($type=="edit") { echo $data['date']; } else { echo date("Y-m-s H:i:s"); } ?>" /></td>
				</tr>
				<tr>
					<th>Category :</td>
					<td>
						<label><input type="checkbox" name="categoryCheckbox" value="daily_goods" />daily goods</label>
						<label><input type="checkbox" name="categoryCheckbox" value="organizer" />organizer</label>
						<label><input type="checkbox" name="categoryCheckbox" value="home_textile" />home textile</label>
						<label><input type="checkbox" name="categoryCheckbox" value="kitechen_dinning" />kitechen_dinning</label>
						<label><input type="checkbox" name="categoryCheckbox" value="living_room" />living room</label>
						<label><input type="checkbox" name="categoryCheckbox" value="paper_stationary" />paper stationary</label>
						<label><input type="checkbox" name="categoryCheckbox" value="health_aid" />health aid</label>
					</td>
				</tr>
				<tr>
					<th>Material:</td>
					<td colspan="2">
						<label><input type="checkbox" name="materialCheckbox" value="fabric" />fabric</label>
						<label><input type="checkbox" name="materialCheckbox" value="wood" />wood</label>
						<label><input type="checkbox" name="materialCheckbox" value="silicon" />silicon</label>
						<label><input type="checkbox" name="materialCheckbox" value="paper" />paper</label>
						<label><input type="checkbox" name="materialCheckbox" value="metal" />metal</label>
						<label><input type="checkbox" name="materialCheckbox" value="plastic" />plastic</label>
						<label><input type="checkbox" name="materialCheckbox" value="leather" />leather</label>
						<label><input type="checkbox" name="materialCheckbox" value="others" />others</label>
					</td>
				</tr>
				<tr>
					<th>Colour:</td>
					<td colspan="2">
						<label><input type="checkbox" name="colourCheckbox" value="nature" />nature</label>
						<label><input type="checkbox" name="colourCheckbox" value="black" />black</label>
						<label><input type="checkbox" name="colourCheckbox" value="grey" />grey</label>
						<label><input type="checkbox" name="colourCheckbox" value="white" />white</label>
						<label><input type="checkbox" name="colourCheckbox" value="brown" />brown</label>
						<label><input type="checkbox" name="colourCheckbox" value="red" />red</label>
						<label><input type="checkbox" name="colourCheckbox" value="orange" />orange</label>
						<label><input type="checkbox" name="colourCheckbox" value="others" />others</label>
					</td>
				</tr>
				<tr>
					<th>Product place:</td>
					<td><input type="text" name="place" value="<? echo str_replace('"','&quot;',$data['place']); ?>" /></td>
				</tr>
				<tr>
					<th>Specification:</td>
					<td><input type="text" name="specification" value="<? echo str_replace('"','&quot;',$data['specification']); ?>" /></td>
				</tr>
				<tr>
					<th>Packaging:</td>
					<td><input type="text" name="packaging" value="<? echo str_replace('"','&quot;',$data['packaging']); ?>" /></td>
				</tr>
				<tr>
					<th>Designer:</td>
					<td><input type="text" name="designer" value="<? echo str_replace('"','&quot;',$data['designer']); ?>" /></td>
				</tr>
				<tr>
					<th>Price:</td>
					<td><input type="text" name="price" value="<? echo str_replace('"','&quot;',$data['price']); ?>" /></td>
				</tr>
				<tr>
					<th>Pictures:</td>
					<td>
						<input type="button" id="uploadBtn" class="small" value="upload" style="margin-bottom:15px;" />
						<div class="imgs"></div>
					</td>
				</tr>
				<tr>
					<th>Synopsis:</td>
					<td colspan="2"><textarea name="context"><? echo $data['context']; ?></textarea></td>
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
	var type = "mimg"
	if(imgs!="")
	{
		changeBgImg(type, imgs);
	}
	setCheckboxs();
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
				//imgList.push(t[a]);
				vals += t[a] + "||";
				html += "<div class='img'><img src='images/upload/" + t[a] + "' /><div class='closeIcon' onclick='removeImg(this);'></div></div>\n";
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
}
$(".uploadFrameDiv, .InforDiv").draggable({
	handle: "h2"
});
$("#uploadBtn").bind("click",function(){
	$(".uploadFrameDiv").css("left",$(this).position().left-0)
	$(".uploadFrameDiv").css("top",$(this).position().top+30)
	$(".uploadFrameDiv").show();
	$("#uploadFrame").attr("src","upload.php?f=mimgu");
})
function removeImg(obj)
{
	//var n = confirm("Confirm delete?");
	//if(n)
	//{
		var url = top.location.href.split("ad_")[0];
		var img = $(obj).prev().attr("src").replace(url, "").replace("images/upload/", "");
		if (img!="")
		{
			var pics = $("#imgs").val();
			pics = pics.replace(img+"||", "");
			$("#imgs").val(pics);
			var type = "mimg";
			changeBgImg(type, pics);
			/*
			$.ajax({
				type: "GET",
				url: "upload.php",
				data: "m=del&n="+img+"&x="+Math.random(),
				success: function(request){
					result = request.substr(0, 1);
					if(result==1||result==3)
					{
						var pics = $("#imgs").val();
						pics = pics.replace(img+"||", "");
						$("#imgs").val(pics);
						var type = "mimg";
						changeBgImg(type, pics);
					}
					else
					{
						alert("please try again.");
					}
				}
			})
			*/
		}		
	//}
}
$("#removeBtn").bind("click",function(){
	var n = confirm("Confirm delete?");
	if(n)
	{
		var fname = $("#small").val();
		if(fname!="")
		{
			$.ajax({
				type: "GET",
				url: "upload.php",
				data: "m=del&n="+fname+"&x="+Math.random(),
				success: function(request){
					result = request.substr(0, 1);
					if(result==1||result==3)
					{
						$("#small").val("");
						$(".img img").attr("src", "");
						$("#uploadBtn").show();
						$("#removeBtn").hide();
					}
					else
					{
						alert("please try again.");
					}
				}
			})
		}
	}
})
$("#uploadFrameDiv h2 a").bind("click",function(){
	$(".uploadFrameDiv").hide()
})
function setCheckboxs()
{
	var categorys = $("input[name='category']").val();
	var material = $("input[name='material']").val();
	var colour = $("input[name='colour']").val();
	setCheckbox("category", categorys);
	setCheckbox("material", material);
	setCheckbox("colour", colour);
}
function setCheckbox(name, vals)
{
	var list = $("input[name='"+name+"Checkbox']");
	var valList = vals.split("||");
	for(var a=0; a<(valList.length-1); a++)
	{
		for(var b=0; b<list.length; b++)
		{
			if(valList[a] == $(list[b]).val())
			{
				$(list[b]).attr("checked", "checked");
			}
		}
	}
}
$("input[name='categoryCheckbox'], input[name='materialCheckbox'], input[name='colourCheckbox']").bind("click",function(){
	var name = $(this).attr("name");
	var list = $("input[name='"+name+"']");
	var html = "";
	for(var a=0; a<list.length; a++)
	{
		if($(list[a]).attr("checked")==true)
		{
			html += $(list[a]).val() + "||"; 
		}
	}
	$("input[name='"+name.replace('Checkbox','')+"']").val(html);
})

$(".imgs").sortable({
	stop: function(event, ui) {
		setContent()
	}
});

function setContent()
{
	var url = top.location.href.split("ad_")[0];
	var list = $(".imgs .img");
	var val = ""
	for(var a=0; a<list.length; a++)
	{
		val += $(list[a]).find("img").attr("src").replace(url, "").replace("images/upload/", "") + "||";
	}
	$("#imgs").val(val);
}
</script>
</body>
</html>
