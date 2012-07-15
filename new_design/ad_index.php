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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>yatalite-tech admin page</title>
</head>
<body>
<div class="container admin">
	<? include"includes/a_header.php"; ?>
	<div class="mainbody">
		<? include"includes/a_nav.php"; ?>
		<div class="mainbox">
			后台管理
		</div>
	</div>
	<? include"includes/a_footer.php"; ?>
</div>
<script language="javascript">

var en_content = $('#en_content').xheditor();
var zh_content = $('#zh_content').xheditor();

$(document).ready(function(){
	set_on_style();
	if($("#id").val() >0)
	{
		$("select").attr("disabled", true)
	}
});

function set_on_style()
{
	var cid = $("#id").val();
	$(".nav li").removeClass("on");
	$(".nav li[cid='"+cid+"']").addClass("on");
	
	var id = $("#id").val();
	$(".lists li").removeClass("on");
	$(".lists li[id='"+id+"']").addClass("on");
}

$(".saveBtn").bind("click",function(){
	
	var cid = $("#cid").val();
	var id = $("#id").val();
	if(id==0) { id = "" }
	
	var en_title = $("#en_title").val();
	var zh_title = $("#zh_title").val();
	var en_cont = en_content.getSource('str');
	var zh_cont = zh_content.getSource('str');
	
	var flag = true
	
	if (cid<=0)
	{
		alert("清先在左边选择一个分类")
		flag = false
	}
	if (en_title=="" && zh_title=="")
	{
		alert("标题需要填写")
		flag = false
	}
	if (en_content=="" && zh_content=="")
	{
		alert("内容需要填写")
		flag = false
	}
	if (flag)
	{
		$("#content").submit()
	}
})

$(".removeClass").bind("click",function(){
	var id = $(this).parent().attr("cid")
	var n = confirm("确定删除?")
	if(n)
	{
		$.ajax({
			type: "POST",
			url: "ad_ajax.php",
			data: "method=del&type=contents&id="+ id ,
			success: function(html)
			{
				if(html==1)
				{
					$(".nav li[cid='"+id+"']").remove();
				}
				else
				{
					alert("失败， 请重试.")
				}
			}
		});
	}
})

$(".addContentBtn").bind("click",function(){
	$("#id").val("0")
	$("#en_title").val("")
	$("#zh_title").val("")
	en_content.setSource('')
	zh_content.setSource('')
	set_on_style();
	$("select").attr("disabled", false);
})

$(".uploadFrameDiv, .InforDiv").draggable({
	handle: "h2"
});
$(".addPic").bind("click",function(){
	$(".uploadFrameDiv").css("left",$(this).position().left-$(".uploadFrameDiv").width() + $("#addPic").width())
	$(".uploadFrameDiv").css("top",$(this).position().top+30)
	$(".uploadFrameDiv").show();
	$("#uploadFrame").attr("src","upload.php?f="+$(this).attr("class"));
})
$("#uploadFrameDiv h2 a").bind("click",function(){
	$(".uploadFrameDiv").hide();
})

</script>
</body>
</html>
