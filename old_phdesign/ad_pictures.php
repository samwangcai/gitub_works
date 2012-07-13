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

$fsdir = $_GET['sdir']?$_GET['sdir']:"";
$fsdir = str_replace("//", "/", $fsdir);

$cfolder = $folder.$fsdir."/";

if (isset($_GET['page']) && $_GET['page'] >0 ) {
	$page = $_GET['page'];
}

if (isset($_GET['method']) && $_GET['method']=="del" ) {
	if(isset($_GET['name']) && $_GET['name']!="")
	deleteImg($cfolder, $_GET['name']);
}
if (isset($_GET['method']) && $_GET['method']=="adir" ) {
	if(isset($_GET['name']) && $_GET['name']!="")
	addFolder($cfolder, $_GET['name']);
}

$first = ($page-1)*$maxNo;

if(isset($_POST['POSTACTION'])&&$_POST['POSTACTION']=="UPLOAD")
{
	$sdir = $_POST['sdir']?$_POST['sdir']:"";
	$cfolder = $folder.$sdir."/";
	$uploaddir = $cfolder."/";
	$uploaddir = str_replace("//", "/", $uploaddir);
	$uploadfile = $uploaddir. $_FILES['userfile']['name'];
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir.$_FILES['userfile']['name'])) {
		$upmsg = "<font style='color:red;'>upload success.</font>";
		$_GET['POSTACTION'] = "";
		
	} else {
		$upmsg = "<font style='color:red;'>upload failed.</font>";
	}
	$editGoTo = "?&sdir=".$sdir;
	header(sprintf("Location: %s", $editGoTo));
}
$allPics = getAllPics($cfolder);
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
			<?
			echo "<a href='?'>root</a> / ";
			if ($fsdir != "")
			{
				$fsdir_list = explode("/", $fsdir);
				for ($a=0; $a < count($fsdir_list); $a++)
				{
					$fsd = "";
					for($b=0; $b <= $a; $b++)
					{
						$fsd .= $fsdir_list[$b]."/";
					}
					if($fsdir_list[$a])
					{
						echo "<a href='?sdir=".$fsd."'>".$fsdir_list[$a]."</a> / ";
					}
				}
			}
			?>
			<div class="space"></div>
			
			<div class="topLine">
				<form enctype="multipart/form-data" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>">
					<input type="hidden" name="sdir" value="<? echo $fsdir; ?>"  />
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
			echo "<a href='?method=adir&sdir=".$fsdir."' class='picBlocks'>";
			echo "<div class='img'><img src='images/folder.jpg' style='height:auto;'></div>";
			echo "<div class='name' style='font-weight:bold;'>+ add Folder</div>";
			echo "</a>";
			for($a=0; $a<$maxNo; $a++)
			{
				$cu = $a + $first;
				if($allPics[$cu]!="")
				{
					if ($allPics[$cu] == "." || $allPics[$cu] == "..")
					{
						//echo "<div class='picBlocks'>";
						//echo "<div class='img'><img src='images/folder.jpg' style='height:auto;'></div>";
						//echo "<div class='name' style='font-weight:bold;'>".$allPics[$cu]."</div>";
						//echo "</div>";
					}
					else if(is_dir($cfolder."/".$allPics[$cu]))
					{
						echo "<a href='?sdir=".$fsdir."/".$allPics[$cu]."' class='picBlocks'>";
						echo "<div class='img'><img src='images/folder.jpg' style='height:auto;'></div>";
						echo "<div href='' class='name' style='font-weight:bold;'>".$allPics[$cu]."</div>";
						echo "</a>";
					}
					else if(is_file($cfolder."/".$allPics[$cu]))
					{
						echo "<div class='picBlocks'>";
						echo "<div class='img'><img src='".$cfolder.$allPics[$cu]."'><div class='closeIcon' onclick='removeImg(this);'></div></div>";
						echo "<div class='name'>".$allPics[$cu]."</div>";
						echo "</div>";
					}
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