<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>品牌文化</title>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery-1.4.2.min.js"></script>
</head>

<body>
	<div class="container">
		<? include "includes/header_en.php"; ?>
		<div class="navigation">
			Location：
			<a href="index_en.php">Homepage</a> / 
			<a href="#">Contact Us</a>
		</div>
		<div class="mainbody">
			<div class="nav">
				<ul>
					<li class="title"><img src="images/nav_title_contact.jpg" /></li>
					<li style="height:110px;">零售及加盟: </li>
					<li>网上留言： &nbsp; </li>
				</ul>
			</div>
			
			<div class="maincontent">
				<div class="title"><img src="images/title_contact_en.jpg" /></div>
				<div style="height:110px;">
					<table cellpadding="0" cellspacing="0" border="0" class="normalTable" style="border-left:1px solid #ccc;">
						<tr>
							<td width="120" style="padding-left:10px;"><b class="big">电话:</b></td>
							<td width="220">86-18930069121</td>
							<td width="140" style="border-right:1px solid #ccc;"><b class="big">礼品及团购:</b></td>
							<td width="120" style="padding-left:10px;"><b class="big">电话:</b></td>
							<td>86-18930069121</td>
						</tr>
						<tr>
							<td style="padding-left:10px;"><b class="big">电邮:</b></td>
							<td>phaidesign@gmail.com</td>
							<td style="border-right:1px solid #ccc;"></td>
							<td style="padding-left:10px;"><b class="big">电邮:</b></td>
							<td>phaidesign@gmail.com</td>
						</tr>
					</table>
				</div>
				<div id="sendMail">
				<table cellpadding="0" cellspacing="0" border="0" class="normalTable" style="border-left:1px solid #ccc; width:90%">
					<tr>
						<td style="padding-left:10px;"><b class="big">标题：</b></td>
						<td><input class="input1" name="title" /></td>
					</tr>
					<tr>
						<td width="120" style="padding-left:10px;"><b class="big">姓名：</b></td>
						<td><input class="input1" name="name" /></td>
					</tr>
					<tr>
						<td style="padding-left:10px;"><b class="big">公司：</b></td>
						<td><input class="input1" name="company" /></td>
					</tr>
					<tr>
						<td style="padding-left:10px;"><b class="big">职位:</b></td>
						<td><input class="input1" name="post" /></td>
					</tr><tr>
						<td style="padding-left:10px;"><b class="big">电话：</b></td>
						<td><input class="input1" name="tel" /></td>
					</tr>
					<tr>
						<td style="padding-left:10px;"><b class="big">电邮：</b></td>
						<td><input class="input1" name="email" /></td>
					</tr>
					<tr>
						<td style="padding-left:10px;"><b class="big">联系目的：</b></td>
						<td>
							<select name="interested_in" class="input1">
								<option value="加盟代理">加盟代理</option>
								<option value="团购批发">团购批发</option>
								<option value="礼品采购">礼品采购</option>
								<option value="礼品定制">礼品定制</option>
								<option value="产品售后">产品售后</option>
								<option value="投诉建议">投诉建议</option>
							</select>
						</td>
					</tr>
					<tr>
						<td style="padding-left:10px; height:125px;"><b class="big">留言：</b></td>
						<td><textarea name="note" class="textarea1"></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td style="text-align:right;">
							<button class="confirm"  onclick="checkInputs();">确认提交</button>
						</td>
					</tr>
				</table>
				</div>
				<div id="sentMail" style="display:none;">
					<p>&nbsp;</p>
					<p><b>信息已保存.</b></p>
				</div>
			</div>
			<div class="space"></div>
		</div>
		<? include "includes/footer_en.php"; ?>
	</div>	
<script language="javascript">
function clearInputs()
{
	$("input[type='text'], textarea").val("");
}
function checkInputs()
{
	var tag = true;
	var msg = "";
	var title = $("input[name='title']").val();
	var name = $("input[name='name']").val();
	var email = $("input[name='email']").val();
	var company = $("input[name='company']").val();
	var post = $("input[name='post']").val();
	var tel = $("input[name='tel']").val();
	var interested_in = $("select[name='interested_in']").val();
	var note = $("textarea[name='note']").val();
	
	if(title=="")
	{
		msg += " 标题 "
	}
	if(name=="")
	{
		msg += " 姓名 "
	}
	if(email=="")
	{
		msg += " 电邮 "
	}
	if (msg =="")
	{
		$.ajax({
			type: "POST",
			url: "contact_sent.php",
			data: "m=send&title="+escape(title)+"&suname="+escape(name)+"&email="+escape(email)+"&tel="+escape(tel)+"&company="+escape(company)+"&interested_in="+escape(interested_in)+"&note="+escape(note)+"&x="+Math.random(),
			success: function(request){
				if(request==1)
				{
					$("#sendMail").hide();
					$("#sentMail").show();
				}
				else
				{
					alert("保存失败， 请重试。");
				}
			}
		});
	}
	else
	{
		alert("请输入: " + msg);
	}
}
$(document).ready(function(){
	var inputList = $("input")
	for(var i=0; i<inputList.length; i++)
	{
		$(inputList[i]).data("value", $(inputList[i]).val()) 
	}
	$("input").bind("focus",function(){
		if($(this).data("value") == $(this).val())
		{
			$(this).val("")
		}
	})
	$("input").bind("blur",function(){
		if($(this).val() == "")
		{
			$(this).val($(this).data("value"))
		}
	})
}); 
</script>	
</body>
</html>
