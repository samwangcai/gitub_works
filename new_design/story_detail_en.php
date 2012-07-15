<?
include"includes/config.php";
include"includes/globalFunc.php";
include"includes/getData.php";
include"includes/pageNav.php";

$id = $_GET['id']?$_GET['id']:1;
$table = $table_per."news";
$data = getInfo($table, "id", $id);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Story</title>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery-1.4.2.min.js"></script>
</head>

<body>
	<div class="container">
		<? include "includes/header_en.php"; ?>
		<div class="banner">
		
		</div>
		<div class="navigation">
			Location：
			<a href="index_en.php">Homepage</a> / 
			<a href="story_en.php">Design Stories</a> /
			<a href="#"><? echo $data["title_en"]; ?></a>
		</div>
		<div class="mainbody">
			<div class="nav nav_en">
				<ul>
					<li class="title"><img src="images/nav_title_story.jpg" /></li>
				</ul>
			</div>
			
			<div class="maincontent">
				<div class="title" style="border-bottom:none;"><img src="images/title_story_en.jpg" /></div>
				<div style="width:550px; text-align:right; float:right; margin-top:-40px;">
				</div>
				<?
				if ($data[0] > 0)
				{
					for ($a=1; $a<(count($data)); $a++)
					{
						$t = getTime($data[$a]["add_time"]);
						echo "<a class='story_block' href='story_detail_en.php?id=".$data[$a]['id']."'>";
						echo "<div class='img'><img src='".$folder.$data[$a]["thumb"]."'></div>";
						echo "<div class='s_title'><span class='txt'>".$data[$a]["title_en"]."</span><span class='time'>".$t['y'].".".$t[m].".".$t[d]."</span></div>";
						echo "<div class='s_con'>".$data[$a]["context_en"]."</div>";
						echo "</a>";
					}
				}
				?>
			</div>
			<div class="space"></div>
		</div>
		<? include "includes/footer_en.php"; ?>
	</div>	
</body>
</html>
