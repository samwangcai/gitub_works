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

$from = "ad_wallpapers.php?page=".$_GET['page'];
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
	$data = getInfo("ph_wallpapers", "id", $id);
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
				echo "<h2>Edit exist wallpapers</h2>";
			}
			else
			{
				echo "<h2>Add new wallpapers</h2>";
			}
		?>
		<form action="ad_editFuncs.php" method="post">
			<input type="hidden" name="type" value="wallpapers" />
			<input type="hidden" name="fromPage" value="<? echo $from; ?>" />
			<input type="hidden" name="id" value="<? echo $data['id']; ?>" />
			<input type="hidden" name="content" id="content" value="<? echo $data['content']; ?>" />
			<table class="editTable" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<th width="90">Title:*</th>
					<td><input type="text" name="title" value="<? echo $data['title']; ?>" /></td>
				</th>
				<tr>
					<th>Wallpapers:*</th>
					<td>
						<input type="button" id="uploadBtn" class="small" value="upload" style="margin-bottom:15px;" />
						<div class="imgs"></div>
					</td>
				</tr>
			</table>
			<p></p>
			<p>
				<input type="submit" onclick="setContent()" value="Submit" />
				<input type="reset" value="Reset" />
				<input type="button" onclick="window.location.href='ad_wallpapers.php?page=<? echo $page; ?>';" value="Back" />
			</p>
		</form>
		<div class="space"></div>
		<p>&nbsp;</p>
		</div>
	</div>
	<? include"includes/a_footer.php"; ?>
</div>
<script language="javascript">
$(document).ready(function(){
	var imgs = $("#content").val();
	var type = "mimg";
	if(imgs!="")
	{
		changeBgImg(type, imgs);
	}
}); 
function changeBgImg(type, imgs)
{
	if (type=="mimg")
	{
		var t = imgs.split("||||");
		var imgList = new Array();
		var html = ""
		var vals = ""
		var rlist = ["1920*1200", "1680*900", "1440*810", "1280*800", "1024*768"]
		for(var a=0; a<t.length; a++)
		{
			if(t[a]!="")
			{
				var ct = t[a].split("||");
				vals += ct[0] + "||"+ct[1] + "||" + ct[2] +"||||" ;
				if (ct[2]==1)
				{
					html += "<div class='img imgon' attr='1'>"
				}
				else
				{
					html += "<div class='img' attr='0'>"
				}
				html += "<img src='images/upload/" + ct[0] + "' /><div class='closeIcon' onclick='removeImg(this);'></div>";
				//html += "<input type='text' value='" + ct[1] + "' name='useless' />";
				html += "<select onchange='setContent()'>";
				for(var x=0; x<rlist.length; x++)
				{
					html += "<option value='" + rlist[x] + "' ";
					if(rlist[x] == ct[1])
					{
						html += " selected = 'selected' "
					}
					html += ">" + rlist[x] + "</option>";
				}
				html += "</select>";
				html += "</div>\n";
			}
		}
		$("#content").val(vals);
		$(".imgs").html(html);
		$(".img").bind("click",function(){
			$(".img").removeClass("imgon");
			$(".img").attr("attr", "0");
			$(this).addClass("imgon");
			$(this).attr("attr", "1");
			setContent();
		})
	}
	else if(type=="mimgu")
	{
		var pics = $("#content").val() + "||||" + imgs + "||1920*1200||1";
		var type = "mimg";
		$("#content").val(pics);
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
		var cu = $(obj).parent();
		if (img!="")
		{
			$(cu).remove();
			setContent();
			/*
			$.ajax({
				type: "GET",
				url: "upload.php",
				data: "m=del&n="+img+"&x="+Math.random(),
				success: function(request){
					result = request.substr(0, 1);
					if(result==1||result==3)
					{
						$(cu).remove();
						setContent();
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
$("#uploadFrameDiv h2 a").bind("click",function(){
	$(".uploadFrameDiv").hide()
})
function setContent()
{
	var url = top.location.href.split("ad_")[0];
	var list = $(".imgs .img");
	var val = ""
	for(var a=0; a<list.length; a++)
	{
		val += $(list[a]).find("img").attr("src").replace(url, "").replace("images/upload/", "") + "||" + $(list[a]).find("select option:selected").val() + "||" + $(list[a]).attr("attr") + "||||";
	}
	$("#content").val(val);
}
$(".imgs").sortable({
	stop: function(event, ui) {
		setContent()
	}
});
</script>
</body>
</html>
