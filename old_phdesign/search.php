<?
include"includes/config.php";
include"includes/getData.php";
include"includes/pageNav.php";

$c = "search";
$key = $_GET['key'];
$maxNo = 15;

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
	<div class="mainbody search">
		<div class="rightTitle"><img src="images/right_title_search.gif" /></div>
		<div class="space"></div>
		<div class="context">
			<div class="topTitle">
				<img src="images/title_search_for_left.gif" />
				<span class="skey"><? echo $key; ?></span>
				<img src="images/title_search_for_right.gif" />
				<div class="searchPage">
					<? pageNav(0,$maxNo,20); ?>
				</div>
			</div>
			<div class="space"></div>
			<div class="content">
				<table class="datalist" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<th width="30">No</th>
						<th width="500">title</th>
						<th width="140">date</th>
						<th width="120" style="border:none;">category</th>
					</tr>
					<tr>
						<td><b>01</b></td>
						<td>
							<div class="title">you all doproducts feraf uiiu awqce ceqowf masdfsdf<span class="showIcon"></span></div>
						</td>
						<td><div>April 25. 2011</div></td>
						<td style="border-right:none;"><div>products</div></td>
					</tr>
					<tr>
						<td><b>02</b></td>
						<td><div class="title">you all doproducts feraf uiiu awqce ceqowf masdfsdf</div></td>
						<td><div>April 25. 2011</div></td>
						<td style="border-right:none;"><div>products</div></td>
					</tr>
					<tr>
						<td><b>03</b></td>
						<td><div class="title">you all doproducts feraf uiiu awqce ceqowf masdfsdf</div></td>
						<td><div>April 25. 2011</div></td>
						<td style="border-right:none;"><div>products</div></td>
					</tr>
					<tr>
						<td><b>04</b></td>
						<td><div class="title">you all doproducts feraf uiiu awqce ceqowf masdfsdf</div></td>
						<td><div>April 25. 2011</div></td>
						<td style="border-right:none;"><div>products</div></td>
					</tr>
				</table>
			</div>
			<div>
				<? pageNav(0,$maxNo,20); ?>
			</div>
			<p>&nbsp;</p>
		</div>
	</div>
	<div class="space"></div>
	<? include"includes/footer.php"; ?>
</div>
</body>
</html>
