<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script language="javascript" src="js/jquery-1.4.2.min.js"></script>
	<script language="javascript" src="js/jquery.ui.core.min.js"></script>
	<script language="javascript" src="js/jquery.ui.widget.min.js"></script>
	<script language="javascript" src="js/jquery.ui.mouse.min.js"></script>
	<script language="javascript" src="js/commend.js"></script>
	<div class="headerBg"></div>
	<div class="header">
		<a class="logo" href="index.php"><img src="images/logo.gif" /></a>
		<div class="topNav">
			<div id="aaa"></div>
			<form action="search.php" method="get" id="searchForm">
				<a href="contact.php">Contacts</a> &middot;
				<a href="press_room.php">Press Room</a> &middot;
				<a href="http://store.taobao.com/shop/view_shop.htm?mytmenu=mdianpu&utkn=g,obugc2lemvzwsz3o1324184947125&user_number_id=618150880" target="_blank">E-shop</a> &middot;
				<input type="text" name="key" value="" class="searchInput" />
				<input type="button" value="Seach" class="searchBtn" onclick="checkSearch();" />
			</form>
			<p>
				<?
				if ($c=="homepage")
				{
					echo '<a href="index.php">homepage</a>';
				}
				else if($c=="updates")
				{
					echo '<a href="index.php">homepage</a>  / ';
					echo '<a href="updates.php">updates</a>';
				}
				else if($c=="contact")
				{
					echo '<a href="index.php">homepage</a>  / ';
					echo '<a href="contact.php">contact us</a>';
				}
				else if($c=="article")
				{
					echo '<a href="index.php">homepage</a>  / ';
					echo '<a href="article.php?id='.$data['id'].'">'.$data['title'].'</a>';
				}
				else if($c=="press_room")
				{
					echo '<a href="index.php">homepage</a>  / ';
					echo '<a href="press_room.php">press room</a>';
				}
				else if($c=="search")
				{
					echo '<a href="index.php">homepage</a>  / ';
					echo '<a href="###">search</a>';
				}
				else if($c=="products")
				{
					echo '<a href="index.php">homepage</a>  / ';
					echo '<a href="products.php">products</a>';
				}
				else if($c=="product")
				{
					echo '<a href="index.php">homepage</a>  / ';
					echo '<a href="products.php">products</a> / ';
					echo '<a href="###">'.$title.'</a>';
				}
				else if($c=="wallpapers")
				{
					echo '<a href="index.php">homepage</a>  / ';
					echo '<a href="wallpapers.php">wallpapers</a>';
				}
				else if($c=="wallpaper")
				{
					echo '<a href="index.php">homepage</a>  / ';
					echo '<a href="wallpapers.php">wallpapers</a> / ';
					echo '<a href="###">'.$title.'</a>';
				}
				?>
			</p>
		</div>
	</div>
<script language="javascript">
function checkSearch()
{
	if($(".searchInput").val()!="")
	{
		$("#searchForm").submit();
	}
}
</script>