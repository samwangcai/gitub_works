<?
include"includes/config.php";
include"includes/getData.php";
include"includes/pageNav.php";

$c = "updates";

$page = 1;
$maxNo = 8;

if(isset($_GET['page'])&&$_GET['page']>0)
{
	$page = $_GET['page'];
}

$first = ($page-1)*$maxNo;
$data = getList("ph_updates","date","desc",$first,$maxNo);

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
	<div class="mainbody">
		<div class="rightTitle"><img src="images/right_title_updates.gif" /></div>
		<div class="space"></div>
		<div class="context">
			<img src="images/title_updates.gif" />
			<div class="space"></div>
			<div class="content">
				<?
				if($data[0]>0)
				{
				?>
				<table class="datalist" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<th width="600">title</th>
						<th width="140">date</th>
						<th width="120">author</th>
						<th width="255" style="border:none;">tags</th>
					</tr>
					<?
					for($a=1; $a<$maxNo; $a++)
					{
						if($data[$a]['id']>0)
						{
							echo "<tr status='off' onclick='removeAllDetails(this);'>";
							echo "<td>";
							echo "<div class='title'><span style='float:left;'>".$data[$a]['title']."</span> <span class='controlIcon show'></span></div>";
							echo "<div class='details' style='display:none;'>";
							if ($data[$a]['img'] != "")
							{
								echo "<img src='".$folder.$data[$a]['img']."' /> ".$data[$a]['context']." <div class='space'></div>";
							}
							else
							{
								echo "".$data[$a]['context']." <div class='space'></div>";
							}
							echo "</div>";
							echo "</td>";
							echo "<td><div>".date("M d Y", strtotime($data[$a]['date']))."</div></td>";
							echo "<td><div>".$data[$a]['author']."</div></td>";
							echo "<td style='border:none;'><div>".$data[$a]['tags']."</div></td>";
							echo "</td>";
							echo "</tr>";
						}
					}
					?>
				</table>
				<?
				}
				else
				{
					echo "<div style='margin:15px;'>";
					echo "<h2>No data.</h2>";
					echo "<p><a href='index.php'>back to home page.</a></p>";
					echo "</div>";
				}
				?>
			</div>
			<div class="space"></div>
			<div>
				<? 
				if ($data[0]>0)
				{
					pageNav(0,$maxNo,$data[0]);
				}
				?>
			</div>
			<p>&nbsp;</p>
		</div>
	</div>
	<div class="space"></div>
	<? include"includes/footer.php"; ?>
</div>
<script language="javascript">
function removeAllDetails(tr)
{
	var alltrs = $(".datalist").find("tr");
	var tag = ""
	for(var x=0; x<$(alltrs).length; x++)
	{
		if($(alltrs[x]).attr("status")=="on")
		{
			showDetail($(alltrs[x]));
			tag = $(alltrs[x]);
		}
	}
	if($(tag).html()!=$(tr).html())
	{
		showDetail(tr);
	}
}
function showDetail(tr)
{
	var obj = $(tr).find(".controlIcon");
	var tr = $(tr)
	var title = $(tr).find(".title")
	var detail = $(tr).find(".details");
	var tds = $(tr).children();
	if($(tr).attr("status")=="off")
	{
		$(obj).removeClass("show");
		$(obj).addClass("hide");
		$(tr).attr("status","on");
		$(detail).slideDown(300, function(){
			for(var a=1; a<$(tds).length; a++)
			{
				$(tds[a]).find("div").css("height", $(detail).height()+41);
			}
			$(tr).addClass("on");
		});
	}
	else
	{
		$(obj).removeClass("hide");
		$(obj).addClass("show");
		$(tr).removeClass("on");
		$(tr).attr("status","off");
		$(detail).slideUp(300);
		for(var a=1; a<$(tds).length; a++)
		{
			$(tds[a]).find("div").css("height", 22);
		}
	}
	//alert($(tr).html())
}
</script>
</body>
</html>
