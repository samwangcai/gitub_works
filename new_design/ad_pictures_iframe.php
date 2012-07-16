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
//$cfolder = str_replace("//", "/", $cfolder);

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

if (isset($_POST['f']) && $_POST['f'] !="" ) {
	$from = $_POST['f'];
}
if (isset($_GET['f']) && $_GET['f'] !="" ) {
	$from = $_GET['f'];
}

if (isset($_POST['fn']) && $_POST['fn'] !="" ) {
	$fname = $_POST['fn'];
}
if (isset($_GET['fn']) && $_GET['fn'] !="" ) {
	$fname = $_GET['fn'];
}


if(isset($_POST['POSTACTION'])&&$_POST['POSTACTION']=="UPLOAD")
{
	$sdir = $_POST['sdir']?$_POST['sdir']:"";
	$cfolder = $folder.$sdir."/";
	$uploaddir = $cfolder."/";
	$uploaddir = str_replace("//", "/", $uploaddir);
	$uploadfile = $uploaddir. $_FILES['userfile']['name'];
	$uploadfilename = strtolower(str_replace(" ","_",$_FILES['userfile']['name']));
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir.$uploadfilename)) {
		$upmsg = "<font style='color:red;'>upload success.</font>";
		$_GET['POSTACTION'] = "";
		
	} else {
		$upmsg = "<font style='color:red;'>upload failed.</font>";
	}
	$editGoTo = "?f=".$from."&fn=".$uploadfilename."&sdir=".$sdir;
	header(sprintf("Location: %s", $editGoTo));
}
$allPics = getAllPics($cfolder);
asort($allPics);
?>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<link href="css/upload.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language='javascript' src='js/jquery-1.4.2.min.js'></script>
<script language='javascript' src='js/commend.js'></script>
<?
if($allPics!="")
{
	echo "<div>";
	echo "<span id='uploadFileName' style='display:none1'>".$fname."</span>";
	echo "<span id='uploadFrom' style='display:none1;'>".$from."</span>";
	echo "</div>";
	
	echo "<a href='?f=".$from."&fn=".$fname."'>root</a> / ";
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
				echo "<a href='?f=".$from."&fn=".$fname."&sdir=".$fsd."'>".$fsdir_list[$a]."</a> / ";
			}
		}
	}
	?>
	<div class="space"></div>
	
	<div class="topLine">
		<form enctype="multipart/form-data" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>">
			<input type="hidden" name="sdir" id="sdir" value="<? echo $fsdir; ?>"  />
			<input type="hidden" name="f" value="<? echo $from; ?>" />
			<B>Upload:</B>
			<input name="MAX_FILE_SIZE" value="100000000" type="hidden">
			<input name="POSTACTION" value="UPLOAD" type="hidden">
			<input name="userfile" type="file" style="width:220px; height:22px;">
			<input value="上传" type="submit" />
			<? echo "<input type='button' onclick='add_folder();' style='cursor:pointer; margin-left:30px;' value='+ add Folder' />"; ?>
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
			if ($allPics[$cu] == "." || $allPics[$cu] == "..")
			{
				//echo "<div class='picBlocks'>";
				//echo "<div class='img'><img src='images/folder.jpg' style='height:auto;'></div>";
				//echo "<div class='name' style='font-weight:bold;'>".$allPics[$cu]."</div>";
				//echo "</div>";
			}
			else if(is_dir($cfolder."/".$allPics[$cu]))
			{
				echo "<div class='picBlocks'>";
				echo "<div class='img'><img src='images/folder.jpg' style='height:auto;'><div class='closeIcon' onclick='removeFolder(this);'></div></div>";
				echo "<a href='?f=".$from."&fn=".$fname."&sdir=".$fsdir."/".$allPics[$cu]."' class='name' style='font-weight:bold;'>".$allPics[$cu]."</a>";
				echo "</div>";
			}
			else if(is_file($cfolder."/".$allPics[$cu]))
			{
				echo "<div class='picBlocks'>";
				echo "<div class='img'><img src='".$cfolder.$allPics[$cu]."'><div class='closeIcon' onclick='removeImg(this);'></div><div class='editIcon' onclick='useImg(this);'>Use it</div></div>";
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
}
else
{
	echo "<p>no folder found.</p>";
}
?>
<div class="space"></div>
<script language="javascript">
$(document).ready(function(){
	hide_is_used();
});
function hide_is_used()
{
	try{
		var show_use = parent.$("#ad_pictures").attr("show_use");
		if(parseInt(show_use) == 0)
		{
			$(".picBlocks .editIcon").hide();
		}
	}
	catch(e){alert(e)}
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
function removeFolder(obj)
{
	var n = confirm("Confirm delete?");
	if(n)
	{
		var url = top.location.href.split("ad_pro")[0];
		var folder = $(obj).parent().next().attr("href").replace(url, "")
		folder = folder.split("=")[1].replace("images/upload/", "");
		if (folder!="")
		{
			$.ajax({
				type: "GET",
				url: "upload.php",
				data: "m=del&n="+folder+"&x="+Math.random(),
				success: function(request){
					result = request.substr(0, 1);
					if(result==1||result==3)
					{
						$(obj).parent().parent().remove()
					}
					else
					{
						alert("Folder may not empty, please delete files in it first.");
					}
				}
			})
		}		
	}
}
function add_folder()
{
	var n = prompt("Enter folder name (26 letter and numbers only):");
	if(n)
	{
		var url = top.location.href.split("ad_pro")[0];
		var f = $("#sdir").val();
		$.ajax({
			type: "GET",
			url: "upload.php",
			data: "m=adir&n="+n+"&f="+escape(f)+"&x="+Math.random(),
			success: function(request){
				result = request.substr(0, 1);
				if(result==1||result==3)
				{
					window.location.reload();
				}
				else
				{
					alert("please try again.");
				}
			}
		})
	}
}
function updateToMainPage()
{
	var fileName = $('#uploadFileName').html();
	var fileFrom = $('#uploadFrom').html();
	parent.$('#uploadFrameDiv').parent().hide();
	parent.$('#uploadFrame').src = '';
	parent.changeBgImg(fileFrom, fileName);
}
</script>