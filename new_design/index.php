<?
include"includes/config.php";
include"includes/globalFunc.php";
include"includes/getData.php";

$lan = $_GET['lan']?$_GET['lan']:"en";
$id = $_GET['id']?$_GET['id']:"0";
$content = getInfo($table_per."contents", "id", $id);

$table = $table_per."contents";
$sql = " where pid=0 order by oid asc;";
$plist = getData($table, $sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Yatalite-Tech</title>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery-1.4.2.min.js"></script>
</head>

<body>
	<div id="val" value="<? echo $lan; ?>" cid="<? echo $id; ?>" ></div>
	<div class="container">
		<div class="header">
			<a href="index.php?lan=<? echo $lan; ?>" class="logo"><img src="images/logo.gif" /></a>
			<div class="info">
				<p>email: <a href="#">sam.wang@cereson.com</a></p>
				<p>China: <span>+86 123456 789</span> <a href="#"><img src="images/icon_in.gif" /></a></p>
			</div>
			<div class="space"></div>
		</div>
		<div class="topm">
			<ul class="topmenu">
			<?
			if ($plist[0]>0)
			{
				for($a=$plist[0]; $a>=1; $a--)
				{
					echo "<li class='fli' fid='0' cid='".$plist[$a]['id']."'><a href='index.php?lan=".$lan."&id=".$plist[$a]['id']."'>".$plist[$a][$lan."_title"]."</a>";
					echo "<ul style='display:none1;' id='".$plist[$a]['id']."'>";
					$sql_ = " where pid=".$plist[$a]['id']." order by oid asc;";
					$inlist = getData($table, $sql_);
					if ($inlist[0]>0)
					{
						for($b=1; $b<=$inlist[0]; $b++)
						{
							echo "<li class='cli' fid='".$inlist[$a]['pid']."' cid='".$inlist[$b]['id']."'><a href='index.php?lan=".$lan."&id=".$inlist[$b]['id']."'>".$inlist[$b][$lan."_title"]."</a></li>";
						}
					}
					echo "</ul></li>";
				}
			}
			?>
			</ul>
		</div>
		<div class="topbanner">
			<img src="images/topbanner.jpg" />
		</div>
		<div class="space"></div>
		<div class="mainbody">
			<div class="nav">
				<div class="title"><? echo changeLan($lan, "MAIN MENU"); ?></div>
				<ul>
					<?
					if ($plist[0]>0)
					{
						for($a=1; $a<=$plist[0]; $a++)
						{
							echo "<li class='fli' fid='0' cid='".$plist[$a]['id']."'><a href='index.php?lan=".$lan."&id=".$plist[$a]['id']."'>".$plist[$a][$lan."_title"]."</a></li>";
							echo "<ul style='display:none;' id='".$plist[$a]['id']."'>";
							$sql_ = " where pid=".$plist[$a]['id']." order by oid asc;";
							$inlist = getData($table, $sql_);
							if ($inlist[0]>0)
							{
								for($b=1; $b<=$inlist[0]; $b++)
								{
									echo "<li class='cli' fid='".$inlist[$a]['pid']."' cid='".$inlist[$b]['id']."'><a href='index.php?lan=".$lan."&id=".$inlist[$b]['id']."'>".$inlist[$b][$lan."_title"]."</a></li>";
								}
							}
							echo "</ul>";
						}
					}
					?>
					<li><a href="contact.php?lan=<? echo $lan; ?>"><? echo changeLan($lan, "Contact Us"); ?></a></li>
				</ul>
			</div>
			
			<div class="maincontent">
				<div style="padding:0px;">
				<table width="100%">
					<?
					if($content[$lan.'_title']!= "")
					{
						//echo "<tr><td><h2>";
						//echo $content[$lan.'_title'];
						//echo "</h2></td></tr>";
					}
					?>
					<tr>
						<td><? echo $content[$lan.'_content']; ?></td>
					</tr>
				</table>
				</div>
			</div>
		</div>
		
		<div class="footer">
			<p>copyright</p>
		</div>
	</div>
<script language="javascript">
$(document).ready(function(){
	var lan = $("#val").attr("lan");
	var id =  $("#val").attr("cid");
	
	var cl = $(".nav li[cid='"+id+"']");
	if ($(cl).attr("fid") == 0)
	{
		$(cl).next().show();
	}
	$(cl).addClass("on");
	$(cl).parent().show();
	
	
	var navHeight = $(".nav").height()
	var conHeight = $(".maincontent").height()
	if (navHeight>=conHeight)
	{
		$(".nav").height(navHeight);
		$(".maincontent").height(navHeight);
	}
	else
	{
		$(".nav").height(conHeight);
		$(".maincontent").height(conHeight);
	}
	
});
</script>	
</body>
</html>
