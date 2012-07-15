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

$id = $_GET['id']?$_GET['id']:"0";

$table = $table_per."contents";
$sql = " where pid=0 order by oid asc;";
$plist = getData($table, $sql);

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
		<div class="nav">
			<div class="title">标题列表</div>
			<ul>
			<?
			if ($plist[0]>0)
			{
				for($a=1; $a<=$plist[0]; $a++)
				{
					echo "<li class='fli' fid='0' cid='".$plist[$a]['id']."'><a href='admin.php?id=".$plist[$a]['id']."'>".$plist[$a]["en_title"]." (".$plist[$a]["zh_title"].")</a>";
					$sql_ = " where pid=".$plist[$a]['id']." order by oid asc;";
					$inlist = getData($table, $sql_);
					if ($inlist[0]>0)
					{
						echo "<ul>";
						for($b=1; $b<=$inlist[0]; $b++)
						{
							echo "<li class='cli' fid='".$inlist[$a]['pid']."' cid='".$inlist[$b]['id']."'><a href='admin.php?id=".$inlist[$b]['id']."'>".$inlist[$b]["en_title"]." (".$inlist[$b]["zh_title"].")</a></li>";
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
			<p>
				<input type="button" class="saveBtn" value="  保存修改  " />
				&nbsp; &nbsp; &nbsp; &nbsp; ( 拖拽下方标题排序 )
			</p>
			<div class="orderList">
			<?
			if ($plist[0]>0)
			{
				for($a=1; $a<=$plist[0]; $a++)
				{
					echo "<div class='fli' cid='".$plist[$a]['id']."'>".$plist[$a]["en_title"]." (".$plist[$a]["zh_title"].")</div>";
					$sql_ = " where pid=".$plist[$a]['id']." order by oid asc;";
					$inlist = getData($table, $sql_);
					if ($inlist[0]>0)
					{
						for($b=1; $b<=$inlist[0]; $b++)
						{
							echo "<div class='cli' cid='".$inlist[$b]['id']."'> >> ".$inlist[$b]["en_title"]." (".$inlist[$b]["zh_title"].")</div>";
						}
					}

				}
			}
			?>
			</div>
			<p><input type="button" class="saveBtn" value="  保存修改  " /></p>
		</div>
		<div class="space"></div>
		</form>
	</div>
	<? include"includes/a_footer.php"; ?>
</div>
<script language="javascript">
$(".orderList").sortable({});
$(".saveBtn").bind("click",function(){ saveorder(); })
function saveorder()
{
	var list = $(".orderList div");
	var r = ""
	for (var a=0; a<list.length; a ++)
	{
		var c = $(list[a])
		if($(c).attr("class") == "fli")
		{
			r += "||" + $(c).attr("cid");
		}
		else
		{
			r += "|" + $(c).attr("cid");
		}
	}
	if(r.substr(0,2) != "||")
	{
		alert("第一个必需为一级内容");
	}
	else
	{
		$.ajax({
			type: "POST",
			url: "ad_ajax.php",
			data: "method=makeOrder&type=contents&list="+ r ,
			success: function(html)
			{
				if(html==1)
				{
					window.location.reload();
				}
				else
				{
					alert("失败， 请重试.");
				}
			}
		});
	}
}

</script>
</body>
</html>
