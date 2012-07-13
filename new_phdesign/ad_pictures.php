<?
session_start();
if(!isset($_SESSION['uname'])||$_SESSION['uname']=="")
{
	$pageGoto = "login.php";
	header(sprintf("Location: %s", $pageGoto));
}
include"includes/config.php";
include"includes/globalFunc.php";
include"includes/getData.php";
include"includes/login_out.php";
include"includes/pageNav.php";
//include("fckeditor/fckeditor.php") ;

$page = 1;
$maxNo = 25;

if (isset($_GET['page']) && $_GET['page'] >0 ) {
	$page = $_GET['page'];
}

if (isset($_GET['method']) && $_GET['method']=="del" ) {
	if(isset($_GET['name']) && $_GET['name']!="")
	deleteImg($folder,$_GET['name']);
}

$first = ($page-1)*$maxNo;

if(isset($_POST['POSTACTION'])&&$_POST['POSTACTION']=="UPLOAD")
{
	$uploaddir = $folder;
	$uploadfile = $uploaddir. $_FILES['userfile']['name'];
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir.$_FILES['userfile']['name'])) {
		$upmsg = "<font style='color:red;'>upload success.</font>";
		$_POST['POSTACTION'] = "";
		
	} else {
		$upmsg = "<font style='color:red;'>upload failed.</font>";
	}
}
$allPics = getAllPics($folder);
asort($allPics);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>phdesign admin page</title>
</head>

<body class="admin">
<div id="container">
	<? include"includes/a_header.php"; ?>
	<div class="mainbody">
		<? include"includes/a_nav.php"; ?>
		<div class="mainbox">
			<div class="topLine">
				<form enctype="multipart/form-data" method="post" action="?">
				<B>Upload:</B>
				<input name="MAX_FILE_SIZE" value="100000000" type="hidden">
				<input name="POSTACTION" value="UPLOAD" type="hidden">
				<input name="userfile" type="file" style="width:220px; height:22px;">
				<input value="上传" type="submit">
				<? echo $upmsg; ?><? echo $delmsg; ?>
				</form>
			</div>
			<div class="space"></div>
			<? 
			for($a=0; $a<$maxNo; $a++)
			{
				$cu = $a + $first;
				if($allPics[$cu]!="")
				{
					echo "<div class='picBlocks'>";
					echo "<div class='img'><img src='".$folder.$allPics[$cu]."'><div class='closeIcon' onclick='removeImg(this);'></div></div>";
					echo "<div class='name'>".$allPics[$cu]."</div>";
					echo "</div>";
				}
			}
			?>
			<div class="space"></div>
			<?
			echo "<div class='space'></div>";
			echo "<div class='pageNav'>";
			pageNav($first, $maxNo, count($allPics));
			echo "</div>";
			?>
			<div class="space"></div>
			<p>&nbsp;</p>
		</div>
	</div>
	<? include"includes/a_footer.php"; ?>
</div>
<script language="javascript">
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
</script>
</body>
</html>