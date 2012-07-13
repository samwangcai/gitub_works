<?
include"includes/config.php";
include"includes/globalFunc.php";
include"includes/getData.php";

$c = "pressroom";
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
	<div class="mainbody">
		<div class="rightTitle"><img src="images/right_title_press_room.gif" /></div>
		<div class="space"></div>
		<div class="context" style="padding:15px;">
			<img src="images/title_press_room.gif" />
			<div class="space"></div>
			<div class="content" style="width:650px;">
				<div style="font-size:14px;">
					Thanks for your interests in PHAI design S.P.A. <br>
					Please fill out the form below and we will get back to you as soon as possible. <br>
					You can reach us by email us or telephone. <br>
				</div>
				<form method="post" enctype="multipart/form-data" id="sendMail">
				<table width="100%" cellpadding="0" cellspacing="0" border="0" class="normalTable">
					<tr>
						<td width="85" class="title">Title:</td>
						<td><input type="text" name="title" value="Title" /></td>
					</tr>
					<tr>
						<td class="title">Suname:</td>
						<td><input type="text" name="suname" value="Suname" /></td>
					</tr>
					<tr>
						<td class="title">Given name:</td>
						<td><input type="text" name="givenname" value="Given name" /></td>
					</tr>
					<tr>
						<td class="title">Press name:</td>
						<td><input type="text" name="pressname" value="Press name" /></td>
					</tr>
					<tr>
						<td class="title">Email:</td>
						<td><input type="text" name="email" value="Email" /></td>
					</tr>
					<tr>
						<td class="title">Tel/mobile:</td>
						<td><input type="text" name="phone" value="Tel/mobile" /></td>
					</tr>
					<tr>
						<td class="title">Request:</td>
						<td><textarea name="request"></textarea></td>
					</tr>
					<tr>
						<td class="title">&nbsp;</td>
						<td class="subBtms">
							<a href="###" class="clear" onclick="javascript:clearInputs()">clear all</a>
							<a href="###" class="send" onclick="javascript:checkInputs();">send</a>
						</td>
					</tr>
				</table>
				</form>
				<div id="sentMail" style="display:none;">
					<p>&nbsp;</p>
					<p><b>Your message have been sent.</b></p>
				</div>
			</div>
		</div>
	</div>
	<div class="space"></div>
	<? include"includes/footer.php"; ?>
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
	var suname = $("input[name='suname']").val();
	var givenname = $("input[name='givenname']").val();
	var pressname = $("input[name='pressname']").val();
	var email = $("input[name='email']").val();
	var phone = $("input[name='phone']").val();
	var request = $("textarea[name='request']").val();
	if(title=="")
	{
		msg += "title "
	}
	if(email=="")
	{
		msg += "email "
	}
	if(request=="")
	{
		msg += "content "
	}
	if (msg =="")
	{
		$.ajax({
			type: "POST",
			url: "press_room_sent.php",
			data: "m=send&title="+escape(title)+"&suname="+escape(suname)+"&givenname="+escape(givenname)+"&pressname="+escape(pressname)+"&email="+escape(email)+"&phone="+escape(phone)+"&request="+escape(request)+"&x="+Math.random(),
			success: function(request){
					if(request==1)
					{
						$("#sendMail").hide();
						$("#sentMail").show();
					}
					else
					{
						alert("failt to send Email. Please try again.");
					}
				}
			});
	}
	else
	{
		alert("Please enter " + msg);
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
