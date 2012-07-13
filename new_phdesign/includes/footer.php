<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<div class="footer">
		<img src="images/logo_btm.gif" class="logo" />
		<span class="links"> | 
			<a href="index.php">homepage</a>
			<a href="updates.php">updates</a>
			<a href="products.php">products</a>
			<?
			$article_list = getList("ph_articles","oid","asc",0,100);
			for($a=1; $a<=$article_list[0]; $a++)
			{
				echo "<a href='article.php?id=".$article_list[$a]['id']."'>".strtolower($article_list[$a]['title'])."</a>";
			}
			?>
			<!--<a href="design_philosphy.php">design philosphy</a>
			<a href="our_team.php">our team</a>
			<a href="green_eco.php">green eco</a>
			<a href="quality_guarantee.php">quality guarantee</a>-->
		</span>
		<span class="copy">&copy; 2011 PHAIdesign S.P.A  All Rights Reserved.</span>
	</div>

<script language="javascript">
$(document).ready(function(){
	setPage();
});
$(window).resize(function(){
	setPage();
}); 
function setPage()
{
	$(".mainbody").css("height", "");
	var a = getPageSize();
	var h = a[3];
	var bh = $("body").height();
	var mh = $(".mainbody").height();
	var ah = h - $(".header").height() - 30; 
	
	if(mh<ah)
	{
		$(".mainbody").css("height", ah-5);
		$(".productBlocks").css("height", ah-5)
	}
	//$("#aaa").html((a + " " + ah + " " + mh + " " + bh))
	/*
	if (a[3]>ah)
	{
		$(".mainbody").css("height", a[3]);
	}
	if($.browser.safari)
	{
		if (a[3]>ah)
		{
			$(".mainbody").css("height", a[3]);
		}
	}
	*/
}
</script>