<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<div class="footer">
		<img src="images/logo.gif" class="logo" height="30" />
		<span class="copy">&copy; 2011 YataLite-Tech  All Rights Reserved.</span>
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
	$(".nav").css("height", "");
	var a = getPageSize();
	var h = a[3];
	var bh = $("body").height();
	var mh = $(".mainbody").height();
	var ah = h - $(".header").height() - 30; 
	
	if(mh<ah)
	{
		$(".mainbody").css("height", ah-5);
		$(".nav").css("height",  ah-5);
	}
	else
	{
		$(".nav").css("height",  mh-5);
	}
	//$("#aaa").html((a + "-" + ah + " " + mh + " " + bh))
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