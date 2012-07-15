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
/*
$page = 1;
$max = 20;
$type = 0;
$method = "artEdit";

if(isset($_GET['page'])&&$_GET['page']>0)
{
	$page = $_GET['page'];
}
if(isset($_GET['type'])&&$_GET['type']!="")
{
	$type = $_GET['type'];
}
if(isset($_GET['method'])&&$_GET['method']!="")
{
	$method = $_GET['method'];
}

$first = ($page-1)*$max;

if($method=="proEdit")
{
	$totalNum = getPNum("ch_",$type);
	$dataList = getPList("ch_",$type,"p_id",$first,$max);
}
else
{
	$totalNum = getANum("ch_",1);
	$dataList = getAList("ch_",1,"a_date",$first,$max);
}
*/

$lan = $_GET['lan']?$_GET['lan']:"en";
$cid = $_GET['cid']?$_GET['cid']:"0";
$id = $_GET['id']?$_GET['id']:"0";

if ($lan == "en"){	$lan2 = "zh"; }else{	$lan2 = "en"; }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>yatalite-tech admin page</title>
</head>
<body>
<div class="container">
	<? include"includes/a_header.php"; ?>
	<div class="mainbody">
		<div class="uploadFrameDiv" style="display:none;">
			<div id="uploadFrameDiv">
				<h2><div style="width:100px; float:left;">Upload File</div><a href="###" class="closeIcon"></a></h2>
				<iframe id="uploadFrame" src="" frameborder="0"></iframe>
			</div>
		</div>
		<div class="add_class">
			<p>
				<input type="hidden" id="ecid" value="" />
				<b>添加分类：</b> &nbsp; &nbsp; 
				上级分类： 
				<select name="fclass">
					<option value="0">    </option>
					<?
					$table = $table_per."class";
					$sql = " where fid=0 order by oid asc;";
					$fclass = getData($table, $sql);
					if ($fclass[0]>0)
					{
						for($a=1;$a<=$fclass[0]; $a++)
						{
							echo "<option value='".$fclass[$a]['id']."'>".$fclass[$a]['en_name']." -- ".$fclass[$a]['zh_name']."</option>";
						}
					}
					?>
				</select>
				(如果要添加一级分类，请选空)
			</p>
			<p>	
				<input type="hidden" name="type" value="" />
				english name: <input type="text" name="en_name"  /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				中文名: <input type="text" name="zh_name"  /> &nbsp; 
				<input type="button" id="addClassBtn" value="编辑/添加 分类" />
				<input type="button" id="addPic" value="添加图片" style="float:right; margin-right:10px;" />
			</p>
		</div>
		
		<div class="nav">
			<div class="title">分类列表</div>
			<ul>
			<?
			if ($fclass[0]>0)
			{
				for($a=1; $a<=$fclass[0]; $a++)
				{
					echo "<li class='fli' fid='0' lan='".$lan."' cid='".$fclass[$a]['id']."'><a href='?lan=".$lan."&cid=".$fclass[$a]['id']."'>".$fclass[$a][$lan."_name"]."</a>  <img src='images/b_edit.png' class='editClass'> <img src='images/b_drop.png' class='removeClass'> ";
					echo "<li style='display:none;' lan='".$lan2."' class='' cid='".$fclass[$a]['id']."'>".$fclass[$a][$lan2."_name"]."<li>";
					$sql_ = " where fid=".$fclass[$a]['id']." order by oid asc;";
					$cclass = getData($table, $sql_);
					if ($cclass[0]>0)
					{
						echo "<ul>";
						for($b=1; $b<=$cclass[0]; $b++)
						{
							echo "<li class='cli' fid='".$fclass[$a]['id']."' lan='".$lan."' cid='".$cclass[$b]['id']."'><a href='?lan=".$lan."&cid=".$cclass[$b]['id']."'>".$cclass[$b][$lan."_name"]."</a> <img src='images/b_edit.png' class='editClass'> <img src='images/b_drop.png' class='removeClass'></li>";
							echo "<li style='display:none;' lan='".$lan2."' cid='".$cclass[$b]['id']."'>".$cclass[$b][$lan2."_name"]."<li>";
						}
						echo "</ul>";
					}
					echo "</li>";
				}
			}
			?>
			</ul>
		</div>
			
		<div class="maincontent">
		<form id="content" action="ad_editFuncs.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="type" value="contents" />
			<input type="hidden" name="cid" id="cid" value="<? echo $cid; ?>" />
			<input type="hidden" name="id" id="id" value="<? echo $id; ?>" />
			<ul class="lists">
			<?
			$sql_ = " where cid=".$cid." order by oid asc;";
			$cList = getData($table_per."contents", $sql_);
			if($cList[0]>0)
			{
				for($a = 1; $a<=$cList[0]; $a++)
				{
					echo "<li id='".$cList[$a]['id']."'>".$cList[$a]['id']." - <a href='?lan=".$lan."&cid=".$cList[$a]['cid']."&id=".$cList[$a]['id']."'>".$cList[$a]['en_title']." (".$cList[$a]['zh_title']." )</a></li>";
				}
			}
			else
			{
				echo "目前该分类下面没有内容";
			}
			?>
			</ul>
			<p style="margin-bottom:30px; padding-left:10px;"><input type="button" class="addContentBtn" value="在该分类下面添加内容" /></p>
			<p></p>
			<?
			$content = getInfo($table_per."contents", "id", $id);
			echo "<div class='contentAdd'>";
			echo "<h3>English: ( title + content )</h3>";
			echo "<input class='titleContent' id='en_title' name='en_title' value='".$content['en_title']."'>";
			echo "<textarea class='textareaContent' name='en_content' id='en_content'>".$content['en_content']."</textarea>";
			echo "<p>&nbsp;</p>";
			echo "<h3>中文内容: ( 标题 + 内容 )</h3>";
			echo "<input class='titleContent' id='zh_title' name='zh_title' value='".$content['zh_title']."'>";
			echo "<textarea class='textareaContent' name='zh_content' id='zh_content'>".$content['zh_content']."</textarea>";
			echo "<p>&nbsp;</p>";
			echo "<input type=\"button\" id=\"saveBtn\" value=\" 保存 \" />";
			echo "</div>";
			?>
		</div>
		<div class="space"></div>
	</div>
	<? include"includes/a_footer.php"; ?>
</div>
<script language="javascript">
$("#addClassBtn").bind("click",function(){
	var id = $("#ecid").val();
	var fid = $(".add_class").find("select[name='fclass']").val();
	var en_name = $(".add_class").find("input[name='en_name']").val();
	var zh_name = $(".add_class").find("input[name='zh_name']").val();
	if (id>0) { } else { id=0 }
	$.ajax({
		type: "POST",
		url: "ad_editFuncs.php",
		data: "method=&type=class&id="+ id +"&fid="+ fid +"&en_name="+en_name+"&zh_name="+zh_name,
		success: function(html)
		{
			if(html==1)
			{
				var n = confirm("成功， 不刷新页面继续添加？")
				if (n)
				{
					//location.reload()
				}
				else
				{
					window.location.reload() 
				}
			}
			else
			{
				alert("失败， 请重试.")
			}
		}
	});
})


var en_content = $('#en_content').xheditor();
var zh_content = $('#zh_content').xheditor();

$(document).ready(function(){
	set_on_style();
});

function set_on_style()
{
	var cid = $("#cid").val();
	$(".nav li").removeClass("on");
	$(".nav li[cid='"+cid+"']").addClass("on");
	
	var id = $("#id").val();
	$(".lists li").removeClass("on");
	$(".lists li[id='"+id+"']").addClass("on");
}

$("#saveBtn").bind("click",function(){
	
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

$(".editClass").bind("click",function(){
	var obj = $(this)
	var par = $(obj).parent()
	var cid = $(par).attr("cid")
	var fid = $(par).attr("fid")
	var lan = $(par).attr("lan")
	
	$(".nav li").find("a").css("color","black");
	$(par).find("a").css("color","red");
	$("select option[value="+fid+"]").attr("selected","selected")
	$("#ecid").val(cid);
	var clist = $(".nav li[cid='"+cid+"']")
	if($(clist[0]).attr("lan") == "en")
	{
		$("input[name='en_name']").val($(clist[0]).find("a").html())
		$("input[name='zh_name']").val($(clist[1]).html())
	}
	else
	{
		$("input[name='zh_name']").val($(clist[0]).find("a").html())
		$("input[name='en_name']").val($(clist[1]).html())
	}
	$(window).scrollTop($(".header").height());
})
$(".removeClass").bind("click",function(){
	var id = $(this).parent().attr("cid")
	var n = confirm("确定删除?")
	if(n)
	{
		$.ajax({
			type: "POST",
			url: "ad_ajax.php",
			data: "method=del&type=class&id="+ id ,
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
})

$(".uploadFrameDiv, .InforDiv").draggable({
	handle: "h2"
});
$("#addPic").bind("click",function(){
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
