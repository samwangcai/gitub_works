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

$from = "ad_updates.php?page=".$_GET['page'];
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
	$data = getInfo("ph_updates", "id", $id);
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
				echo "<h2>Edit exist updates</h2>";
			}
			else
			{
				echo "<h2>Add new updates</h2>";
			}
		?>
		<form action="ad_editFuncs.php" method="post">
			<input type="hidden" name="type" value="updates" />
			<input type="hidden" name="fromPage" value="<? echo $from; ?>" />
			<input type="hidden" name="id" value="<? echo $data['id']; ?>" />
			<input type="hidden" name="img" id="small" value="<? echo $data['img']; ?>" />
			<table class="editTable" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<th width="90">Title:</td>
					<td><input type="text" name="title" value="<? echo $data['title']; ?>" /></td>
					<td width="120" rowspan="4">
						<div class="img"><img src="<? echo $folder.$data['img']; ?>" /></div>
						<input type="button" id="uploadBtn" class="small" value="upload" />
						<input type="button" id="removeBtn" class="small" value="remove" style="display:none;" />
					</td>
				</tr>
				<tr>
					<th>Date  :</td>
					<td><input type="text" name="date" value="<? if($type=="edit" && $data['date'] != "0000-00-00 00:00:00") { echo $data['date']; } else { echo date("Y-m-s H:i:s"); } ?>" /></td>
				</tr>
				<tr>
					<th>Author :</td>
					<td><input type="text" name="author" value="<? echo $data['author']; ?>" /></td>
				</tr>
				<tr>
					<th>Tags:</td>
					<td><input type="text" name="tags" value="<? echo $data['tags']; ?>" /></td>
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
				<input type="button" onclick="window.location.href='ad_updates.php?page=<? echo $page; ?>';" value="Back" />
			</p>
		</form>
		<div class="space"></div>
		</div>
	</div>
	<? include"includes/a_footer.php"; ?>
</div>
<script language="javascript">
$(document).ready(function(){
	var img = $("#small").val();
	if(img!="")
	{
		changeBgImg("", img);
	}
}); 

function changeBgImg(from, img)
{
	$("#uploadBtn").hide();
	$("#removeBtn").show();
	$("#"+from).val(img);
	$(".img img").attr("src", "images/upload/"+img);
}
$(".uploadFrameDiv, .InforDiv").draggable({
	handle: "h2"
});
$("#uploadBtn").bind("click",function(){
	$(".uploadFrameDiv").css("left",$(this).position().left-0)
	$(".uploadFrameDiv").css("top",$(this).position().top+30)
	$(".uploadFrameDiv").show();
	$("#uploadFrame").attr("src","upload.php?f="+$(this).attr("class"));
})
$("#removeBtn").bind("click",function(){
	//var n = confirm("Confirm delete?");
	//if(n)
	//{
		var fname = $("#small").val();
		if(fname!="")
		{
			$("#small").val("");
			$(".img img").attr("src", "");
			$("#uploadBtn").show();
			$("#removeBtn").hide();
			/*
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
			*/
		}
	//}
})
$("#uploadFrameDiv h2 a").bind("click",function(){
	$(".uploadFrameDiv").hide()
})

</script>
</body>
</html>
