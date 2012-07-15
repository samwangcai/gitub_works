// JavaScript Document

function getPageSize()
{  
	var xScroll, yScroll;
	if (window.innerHeight && document.body.scrollWidth && window.scrollMaxY != "undefined")
	{
		xScroll = document.body.scrollWidth + window.scrollMaxX;
		yScroll = window.innerHeight + window.scrollMaxY;
	}
	else if (document.body.scrollHeight > document.body.offsetHeight)
	{ // all but Explorer Mac
		xScroll = document.body.scrollWidth;
		yScroll = document.body.scrollHeight;
	}
	else
	{ // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		xScroll = document.body.scrollWidth;
		//xScroll = document.body.offsetWidth;
		yScroll = document.body.offsetHeight;
	}
	
	var windowWidth, windowHeight;
	if (self.innerHeight)
	{  // all except Explorer
		windowWidth = self.innerWidth;
		windowHeight = self.innerHeight;
	}
	else if (document.documentElement && document.documentElement.clientHeight)
	{ // Explorer 6 Strict Mode
		windowWidth = document.documentElement.clientWidth;
		windowHeight = document.documentElement.clientHeight;
	}
	else if (document.body)
	{ // other Explorers
		windowWidth = document.body.clientWidth;
		windowHeight = document.body.clientHeight;
	}  
	
	// for small pages with total height less then height of the viewport
	if(yScroll < windowHeight)
	{
		pageHeight = windowHeight;
	}
	else
	{ 
		pageHeight = yScroll;
	}
	
	if(xScroll < windowWidth)
	{  
		pageWidth = windowWidth;
	}
	else
	{
		pageWidth = xScroll;
	}
	
	if(pageWidth=="NaN")
	{
		pageWidth = Math.max(document.documentElement.scrollWidth, document.documentElement.clientWidth);	
	}
	if(pageHeight=="NaN")
	{
		pageHeight = Math.max(document.documentElement.scrollHeight, document.documentElement.clientHeight);	
	}
	arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight,xScroll,yScroll) 
	return arrayPageSize;
}




function showPages(name) { //初始化属性
	this.idname = "aa";
	this.name = name;      //对象名称
	this.page = 1;         //当前页数
	this.pageCount = 1;    //总页数
	this.argName = 'page'; //参数名
	this.showTimes = 1;    //打印次数
}

showPages.prototype.getPage = function(currentPage){ //丛url获得当前页数,如果变量重复只获取最后一个
	var args = location.search;
	var reg = new RegExp('[\?&]?' + this.argName + '=([^&]*)[&$]?', 'gi');
	var chk = args.match(reg);
	//this.page = RegExp.$1;
}
showPages.prototype.checkPages = function(){ //进行当前页数和总页数的验证
	if (isNaN(parseInt(this.page))) this.page = 1;
	if (isNaN(parseInt(this.pageCount))) this.pageCount = 1;
	if (this.page < 1) this.page = 1;
	if (this.pageCount < 1) this.pageCount = 1;
	if (this.page > this.pageCount) this.page = this.pageCount;
	this.page = parseInt(this.page);
	this.pageCount = parseInt(this.pageCount);
}
showPages.prototype.createHtml = function(){ //生成html代码
	var strHtml = '', prevPage = this.page - 1, nextPage = this.page + 1;

	//strHtml += '<span class="count">Pages: ' + this.page + ' / ' + this.pageCount + '</span>';
	strHtml += '<div id="pageNav">';
	strHtml += "<div id=page_left>";
	strHtml += "<div class='page_index'>";
	/*if (prevPage < 1) {
		strHtml += '<span title="First Page">&#171;</span>';
		strHtml += '<span title="Prev Page"><img src="images/page_first.gif"></span>';
	} else {
		strHtml += '<span class="link" title="First Page"><a href="javascript:' + this.name + '.toPage(1);">&#171;</a></span>';
		strHtml += '<span class="link" title="Prev Page"><a href="javascript:' + this.name + '.toPage(' + prevPage + ');"><img src="images/page_first.gif"></a></span>';
	}*/
	strHtml += '<a href="javascript:' + this.name + '.toPage(1);"><img src="images/page_first.gif"></a>';
	for (var i = 1; i <= this.pageCount; i++) {
		if (i > 0) {
			if (i == this.page) {
				strHtml += "<span class='page_index_disable'>" + i + "</span>";
				//strHtml += '<span title="Page ' + i + '">' + i + '</span>';
			} else {
				strHtml += '<a href="javascript:' + this.name + '.toPage(' + i + ');">' + i + '</a>';
			}
		}
	}
	/*if (nextPage > this.pageCount) {
		strHtml += '<span title="Next Page"><img src="images/page_last.gif"></span>';
		strHtml += '<span title="Last Page">&#187;</span>';
	} else {
		strHtml += '<span class="link" title="Next Page"><a href="javascript:' + this.name + '.toPage(' + nextPage + ');"><img src="images/page_last.gif"></a></span>';
		strHtml += '<span title="Last Page"><a href="javascript:' + this.name + '.toPage(' + this.pageCount + ');">&#187;</a></span>';
	}*/
	strHtml += '<a href="javascript:' + this.name + '.toPage(' + this.pageCount + ');"><img src="images/page_last.gif"></a>';
	strHtml += '</div>';
	strHtml += '</div>';
	strHtml += '</div>';
	return strHtml;
}
showPages.prototype.createUrl = function (page) { //生成页面跳转url
	if (isNaN(parseInt(page))) page = 1;
	if (page < 1) page = 1;
	if (page > this.pageCount) page = this.pageCount;
	var url = location.protocol + '//' + location.host + location.pathname;
	var args = location.search;
	var reg = new RegExp('([\?&]?)' + this.argName + '=[^&]*[&$]?', 'gi');
	args = args.replace(reg,'$1');
	if (args == '' || args == null) {
		args += '?' + this.argName + '=' + page;
	} else if (args.substr(args.length - 1,1) == '?' || args.substr(args.length - 1,1) == '&') {
			args += this.argName + '=' + page;
	} else {
			args += '&' + this.argName + '=' + page;
	}
	return url + args;
}
showPages.prototype.toPage = function(page){ //页面跳转
	var turnTo = 1;
	if (typeof(page) == 'object') {
		turnTo = page.options[page.selectedIndex].value;
	} else {
		turnTo = page;
	}
	getProducts(turnTo);
	//self.location.href = this.createUrl(turnTo);
	
}
showPages.prototype.printHtml = function(){ //显示html代码
	this.getPage();
	this.checkPages();
	return this.createHtml()
	//document.getElementById(this.idname).innerHTML = this.createHtml();
	//document.write('<div id="pages_' + this.name + '_' + this.showTimes + '" class="pages"></div>');
	//document.getElementById('pages_' + this.name + '_' + this.showTimes).innerHTML = this.createHtml(mode);
}





function removeImg(obj)
{
	var n = confirm("Confirm delete?");
	if(n)
	{
		var url = top.location.href.split("ad_pro")[0];
		var img = $(obj).prev().attr("src").replace(url, "").replace("images/upload/", "");
		if (img!="")
		{
			$.ajax({
				type: "GET",
				url: "upload.php",
				data: "m=del&n="+img+"&x="+Math.random(),
				success: function(request){
					result = request.substr(0, 1);
					if(result==1||result==3)
					{
						$(obj).parent().parent().remove()
					}
					else
					{
						alert("please try again.");
					}
				}
			})
		}		
	}
}

function useImg(obj)
{
	var url = top.location.href.split("ad_")[0];
	var img = $(obj).prev().prev().attr("src").replace(url, "").replace("images/upload/", "");
	$("#uploadFileName").html(img)
	updateToMainPage()
}


function unicode(s){
	var len=s.length;
	var rs="";
	for(var i=0;i<len;i++){
	var k=s.substring(i,i+1);
	rs+="\\u"+s.charCodeAt(i)+";";
	}
	return rs;
	//alert(rs);
}



function nextFunc()
{
	$(".nextBtn").click();
}

function setBannerNavPos()
{
	$(".bannerBlock .prevBtn").css("margin-left","0px");
	$(".bannerBlock .nextBtn").css("margin-left",($(".bannerBlock").width()-$(".bannerBlock .nextBtn").width())+"px");
	//$(".bannerBlock .moveNav").css("margin-left",($(".bannerBlock").width()-$(".bannerBlock .moveNav").width())+"px");

	$(".moveWidthOut").css("width", 3*$(".moveOut").width()+"px");
}
function setNavFunc()
{
	var imgLength = $(".imgList div").length;
	var html = "";
	for(var a=0;a<imgLength;a++)
	{
		html += "<div class=\"dot\"></div>";
	}
	$(".moveNav").html(html);
	$(".moveNav div:first-child").addClass("on");
	
	$(".moveNav div").bind("click",function(){
		var oid = $(".imgList").attr("cid");
		var nid = $(".moveNav div").index($(this));
		var state = "";
		$(".moveNav div").removeClass("on");
		$(this).addClass("on");
		$(".imgList").attr("cid",nid);
		changeBlock(oid,nid,state);
	})
	
	$(".prevBtn").bind("click",function(){
		var oid = parseInt($(".imgList").attr("cid"));
		var num = parseInt($(".imgList div").length);
		var nid = 0;
		var state = "left";
		if(oid<=0)
		{
			nid = (num - 1) ;
		}
		else
		{
			nid = (oid-1);
		}
		$(".imgList").attr("cid",nid);
		if(tag==0)
		{
			changeBlock(oid,nid,state);
		}
	})
	
	$(".nextBtn").bind("click",function(){
		var oid = parseInt($(".imgList").attr("cid"));
		var num = parseInt($(".imgList div").length);
		var nid = 0;
		var state = "right";
		if(oid==(num-1))
		{
			nid = 0;
		}
		else
		{
			nid = (oid+1);
		}
		$(".imgList").attr("cid",nid);
		if(tag==0)
		{
			changeBlock(oid,nid,state);
		}
	})
}
function setDefaultImgs()
{
	var cid = $(".imgList").attr("cid");
	var b1 = $(".imgList div:eq("+cid+")").attr("src");	
	$(".moveOut .blockImg").css("width",$(".moveOut").width()+"px");	
	//$(".moveOut .block1").css("background-image","url("+b1+")");
	$(".moveOut .block1").attr("class", "blockImg block1");
	$(".moveOut .block1").addClass("div_" + cid);	

	$(".moveOut .moveWidthOut").css("left","-"+$(".moveOut").width()+"px");

	$(".moveOut .block0").css("left","0px");
	$(".moveOut .block1").css("left",$(".moveOut").width()+"px");
	$(".moveOut .block2").css("left",2*$(".moveOut").width()+"px");
	$(".moveOut .block0").css("top","0px");
	$(".moveOut .block1").css("top","0px");
	$(".moveOut .block2").css("top","0px");
}

function changeBlock(oid,nid,state)
{
	tag = 1;
	var moveWidth = $(".moveOut").width();
	var ob = $(".imgList div:eq("+oid+")").attr("src");
	ob = oid;
	var nb = $(".imgList div:eq("+nid+")").attr("src");
	nb = nid;
	var num = parseInt($(".imgList div").length);
	
	if(oid<nid&&state=="")
	{
		$(".moveOut .block1").attr("class","blockImg block1");
		$(".moveOut .block1").addClass("div_" + ob);
		//$(".moveOut .block1").css("background-image","url("+ob+")");
		
		$(".moveOut .block2").attr("class","blockImg block2");
		$(".moveOut .block2").addClass("div_" + nb);
		//$(".moveOut .block2").css("background-image","url("+nb+")");

		$(".moveOut .moveWidthOut").animate({
			left: "-"+2*moveWidth+"px",
		},
		300,
		function(){
			$(".moveOut .block1").attr("class","blockImg block1");
			$(".moveOut .block1").addClass("div_" + nb);
			//$(".moveOut .block1").css("background-image","url("+nb+")");
			$(".moveOut .moveWidthOut").css("left","-"+$(".moveOut").width()+"px");
			$(".moveNav div").removeClass("on");
			$(".moveNav div:eq("+nid+")").addClass("on");
			tag = 0;
		})
	}
	else if(oid>nid&&state=="")
	{
		$(".moveOut .block1").attr("class","blockImg block1");
		$(".moveOut .block1").addClass("div_" + ob);
		//$(".moveOut .block1").css("background-image","url("+ob+")");
		
		$(".moveOut .block0").attr("class","blockImg block0");
		$(".moveOut .block0").addClass("div_" + nb);
		//$(".moveOut .block0").css("background-image","url("+nb+")");
		
		$(".moveOut .moveWidthOut").animate({
			left: "0px"
		},
		300,
		function(){
			$(".moveOut .block1").attr("class","blockImg block1");
			$(".moveOut .block1").addClass("div_" + nb);
			//$(".moveOut .block1").css("background-image","url("+nb+")");

			$(".moveOut .moveWidthOut").css("left","-"+$(".moveOut").width()+"px");
			$(".moveNav div").removeClass("on");
			$(".moveNav div:eq("+nid+")").addClass("on");
			tag = 0;
		})
	}
	else if(state=="left")
	{
		$(".moveOut .block1").attr("class","blockImg block1");
		$(".moveOut .block1").addClass("div_" + ob);
		//$(".moveOut .block1").css("background-image","url("+ob+")");
		
		$(".moveOut .block0").attr("class","blockImg block0");
		$(".moveOut .block0").addClass("div_" + nb);
		//$(".moveOut .block0").css("background-image","url("+nb+")");
		
		$(".moveOut .moveWidthOut").animate({
			left: "0px"
		},
		300,
		function(){
			$(".moveOut .block1").attr("class","blockImg block1");
			$(".moveOut .block1").addClass("div_" + nb);
			//$(".moveOut .block1").css("background-image","url("+nb+")");
			$(".moveOut .moveWidthOut").css("left","-"+$(".moveOut").width()+"px");
			$(".moveNav div").removeClass("on");
			$(".moveNav div:eq("+nid+")").addClass("on");
			tag = 0;
		})
	}
	else if(state=="right")
	{
		$(".moveOut .block1").attr("class","blockImg block1");
		$(".moveOut .block1").addClass("div_" + ob);
		//$(".moveOut .block1").css("background-image","url("+ob+")");

		$(".moveOut .block2").attr("class","blockImg block2");
		$(".moveOut .block2").addClass("div_" + nb);
		//$(".moveOut .block2").css("background-image","url("+nb+")");
	
		$(".moveOut .moveWidthOut").animate({
			left: "-"+2*moveWidth+"px"
		},
		300,
		function(){
			$(".moveOut .block1").attr("class","blockImg block1");
			$(".moveOut .block1").addClass("div_" + nb);
			//$(".moveOut .block1").css("background-image","url("+nb+")");
			$(".moveOut .moveWidthOut").css("left","-"+$(".moveOut").width()+"px");
			$(".moveNav div").removeClass("on");
			$(".moveNav div:eq("+nid+")").addClass("on");
			tag = 0;
		})
	}
}

function getFadeFunc()
{
	$(".moveOut .dvdbg a").bind("mouseover",function(){
		$(this).parent().fadeTo("fast", 0.45);
	})
	$(".moveOut .dvdbg a").bind("mouseout",function(){
		$(this).parent().fadeTo("fast", 1);
	})
}
