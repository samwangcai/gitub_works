<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<div class="footer">
		<p><img src="images/footer_01_zh.jpg" /></p>
		<p><img src="images/footer_logo.jpg" /></p>
		<p class="copy">
			Copyright &copy;  2012 by PHAIdesign All Right Reserved.<br>
			所有图形，设计，产品图片及文字资料均为PHAIdesign  版权所有，仿冒必究！
		</p>
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