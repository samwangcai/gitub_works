<?
include"includes/config.php";
include"includes/globalFunc.php";
include"includes/getData.php";

$c = "products";
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
	<div class="mainbody products">
		<div class="space"></div>
		<div class="context">
			<div class="proNav">
				<img src="images/title_products.gif" />
				<ul>
					<li class="title">Category</li>
					<li><span class="checkbox" name="category" status="on" value="daily_goods"></span> daily goods</li>
					<li><span class="checkbox" name="category" status="on" value="organizer"></span> organizer</li>
					<li><span class="checkbox" name="category" status="on" value="home_textile"></span> home textile</li>
					<li><span class="checkbox" name="category" status="on" value="kitechen_dinning"></span> kitechen & Dinning</li>
					<li><span class="checkbox" name="category" status="on" value="living_room"></span> living Room</li>
					<li><span class="checkbox" name="category" status="on" value="paper_stationary"></span> paper & stationary</li>
					<li><span class="checkbox" name="category" status="on" value="health_aid"></span> health aid</li>
				</ul>
				<ul>
					<li class="title">Material</li>
					<li>
						<span class="checkbox" name="material" status="on" value="fabric"></span> <span>fabric</span>
						<span class="checkbox" name="material" status="on" value="wood"></span> wood
					</li>
					<li>
						<span class="checkbox" name="material" status="on" value="silicon"></span> <span>silicon</span>
						<span class="checkbox" name="material" status="on" value="paper"></span> paper
					</li>
					<li>
						<span class="checkbox" name="material" status="on" value="metal"></span> <span>metal</span>
						<span class="checkbox" name="material" status="on" value="plastic"></span> plastic
					</li>
					<li>
						<span class="checkbox" name="material" status="on" value="leather"></span> <span>leather</span>
						<span class="checkbox" name="material" status="on" value="others"></span> others
					</li>
				</ul>
				<ul>
					<li class="title">Colour</li>
					<li>
						<span class="checkbox nature" name="colour" status="on" value="nature"></span> <span>nature</span>
						<span class="checkbox black" name="colour" status="on" value="black"></span> black
					</li>
					<li>
						<span class="checkbox grey" name="colour" status="on" value="grey"></span> <span>grey</span>
						<span class="checkbox white" name="colour" status="on" value="white"></span> white
					</li>
					<li>
						<span class="checkbox brown" name="colour" value="brown"></span> <span>brown</span>
						<span class="checkbox red" name="colour" value="red"></span> red
					</li>
					<li>
						<span class="checkbox orange" name="colour" status="on" value="orange"></span> <span>orange</span>
						<span class="checkbox others" name="colour" status="on" value="others"></span> others
					</li>
				</ul>
				<ul>
					<li class="title">Issue date</li>
					<li><span class="checkbox" name="issue_date" status="on" value="2011"></span> 2011</li>
					<li><span class="checkbox" name="issue_date" status="on" value="2010"></span> 2010</li>
				</ul>
			</div>
			<h2 class="processing" style="display:none;">Loading ... </h2>
			<div class="productBlocks">
				<!--div class="productBlock">
					<a href="product.php?id=1"><img src="images/upload/pro_01_01.jpg" /></a>
					<table width="200" cellpadding="0" cellspacing="0" border="0" class="ptable">
						<tr>
							<th width="65">Name:</th>
							<td><span>white adhensive tape</span></td>
						</tr>
						<tr>
							<th>Category:</th>
							<td><span>Paper & stationary</span></td>
						</tr>
						<tr>
							<th>Material:</th>
							<td><span>BOPP</span></td>
						</tr>
						<tr>
							<th>colour:</th>
							<td><span>white</span></td>
						</tr>
						<tr>
							<th>Price:</th>
							<td><span>Eur 1.2 /  Rmb: 6.8</span></td>
						</tr>
					</table>
				</div-->
				<div class="space"></div>
				<p>&nbsp;</p>
			</div>
		
		</div>
	</div>
	<div class="space"></div>
	<? include"includes/footer.php"; ?>
</div>
<script language="javascript">
var maxNo = 14;
$(document).ready(function(){
	getProducts(1);
});
$(".checkbox").toggle(
	function(){
		$(this).attr("status", "off");
		$(this).addClass("off");
		getProducts(1);
	},
	function(){
		$(this).attr("status", "on");
		$(this).removeClass("off");
		getProducts(1);
	}
)
function getProducts(page)
{
	$(".processing").show();
	$(".productBlocks").html("");
	var categorys = "";
	var materials = "";
	var colours = "";
	var issue_dates = "";
	var lists = $(".checkbox[status='on']");
	for(var a=0; a<lists.length; a++)
	{
		if($(lists[a]).attr("name")=="category")
		{
			categorys += $(lists[a]).attr("value")+"||";
		}
		if($(lists[a]).attr("name")=="material")
		{
			materials += $(lists[a]).attr("value")+"||";
		}
		if($(lists[a]).attr("name")=="colour")
		{
			colours += $(lists[a]).attr("value")+"||";
		}
		if($(lists[a]).attr("name")=="issue_date")
		{
			issue_dates += $(lists[a]).attr("value")+"||";
		}
	}
	var search_data = "";
	if(categorys!=""&&materials!=""&&colours!=""&&issue_dates!="")
	{
		search_data = "type=products&categorys="+categorys+"&materials="+materials+"&colours="+colours+"&issue_dates="+issue_dates+"&page="+page
	}
	if( search_data != "")
	{
		$.ajax({
			type: "GET",
			url: "ajax.php",
			data: search_data,
			success: function(response){
				var result = eval("("+response+")");
				if(result.list.length>0)
				{
					formatProducts(result);
				}
				else
				{
					$(".productBlocks").html("<h2 style='margin:20px;'>No product found.</h2>")
				}
				$(".processing").hide();
				setInterval(setPage2, 500);
			}
		});
	}
	else
	{
		$(".productBlocks").html("<h2 style='margin:20px;'>No product found.</h2>")
		$(".processing").hide();
		setInterval(setPage2, 500);
	}
}
function formatProducts(data)
{
	var html = "";
	for(var a=0; a<data.list.length; a++)
	{
		html += '<div class="productBlock">';
		html += '<a href="product.php?id='+data.list[a].id+'" class="img"><img src="images/upload/'+data.list[a].img+'" /></a>';
		html += '<table width="200" cellpadding="0" cellspacing="0" border="0" class="ptable">';
		html += '<tr>';
		html += '<th width="65">Name:</th>';
		html += '<td><span>'+data.list[a].title+'</span></td>';
		html += '</tr>';
		html += '<tr>';
		html += '<th>Category:</th>';
		html += '<td><span>'+data.list[a].category+'</span></td>';
		html += '</tr>';
		html += '<tr>';
		html += '<th>Material:</th>';
		html += '<td><span>'+data.list[a].material+'</span></td>';
		html += '</tr>';
		html += '<tr>';
		html += '<th>Colour:</th>';
		html += '<td><span>'+data.list[a].colour+'</span></td>';
		html += '</tr>';
		html += '<tr>';
		html += '<th>Price:</th>';
		html += '<td><span>'+data.list[a].price+'</span></td>';
		html += '</tr>';
		html += '</table>';
		html += '</div>';
	}
	var pageHtml = formatPageNav(data.page, maxNo, data.total);
	html += "<div class='space'></div>";
	html += "<div id='pageNavgation' class='pageNavgation'>"+ pageHtml +"</div>";
	html += "<p>&nbsp;</p>";
	html += "<p>&nbsp;</p>";
	$(".productBlocks").html(html);
	$(".pageNavgation").css("width", $(".productBlocks").width())
}

var pg = new showPages('pg');
function formatPageNav(page, maxNo, total)
{
	pg.page = page
	pg.idname = "pageNavgation";
	pg.pageCount = Math.ceil(total/maxNo) ;
	return pg.printHtml();
}


function setPage2()
{
	$(".productBlocks").css("width", $(".mainbody").width() - $(".proNav").width() - 40);	
	$(".mainbody").css("height", "");
	$(".nav").css("height", "");
	var a = getPageSize();
	var h = Math.max(a[3], a[1]);
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
}
</script>
</body>
</html>