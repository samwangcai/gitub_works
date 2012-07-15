<?
header('Content-Type:text/html;charset=utf-8');
session_start();
include"includes/config.php";
include"includes/getData.php";
include"includes/pageNav.php";

$page = 1;
$maxNo = 20;
if (isset($_POST['page']) && $_POST['page'] >0 ) {
	$page = $_POST['page'];
}
if (isset($_GET['page']) && $_GET['page'] >0 ) {
	$page = $_GET['page'];
}
$first = ($page-1)*$maxNo;

if (isset($_POST['f']) && $_POST['f'] !="" ) {
	$from = $_POST['f'];
}
if (isset($_GET['f']) && $_GET['f'] !="" ) {
	$from = $_GET['f'];
}

if($_GET['m']=="del"&&$_GET['n']!="")
{
	echo deletFile($folder,$_GET['n']);
}
else if($_GET['m']=="adir"&&$_GET['n']!=""&&$_GET['f'])
{
	echo addFolder($folder."".$_GET['f'], $_GET['n']);
}
else
{
	echo "<link href='css/upload.css' rel='stylesheet' type='text/css' />";
	echo "<body style='background:#dbdbdb;'>";
	$fsdir = $_GET['sdir']?$_GET['sdir']:"";
	$fsdir = str_replace("//", "/", $fsdir);
	$cfolder = $folder.$fsdir."/";
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
	echoUploadInput();
	if(isset($_POST['POSTACTION'])&&$_POST['POSTACTION']=="UPLOAD")
	{
		//$uploadfile = strtolower(str_replace(" ","_",$_FILES['userfile']['name']));
		$sdir = $_POST['sdir']?$_POST['sdir']:"";
		$cfolder = $folder.$sdir."/";
		$uploaddir = $cfolder."/";
		$uploaddir = str_replace("//", "/", $uploaddir);
		$uploadfile = $uploaddir. $_FILES['userfile']['name'];
		echo "<span id='uploadFileName' style='display:none1'>".$uploadfile."</span>";
		echo "<div id='uploadFrom' style='display:none;'>".$from."</div>";
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
			$_POST['POSTACTION'] = "";
			//echo "<div id='uploadFileOldName' class='img'><img src='".$folder.$uploadfile."'><div class='closeIcon' onclick='removeImg(this);'></div></div>";
			echo "<div class='topLine'><b>".$uploadfile."</b> upload success.  <input type='button' id='getUpload' value='Use it?' onClick='updateToMainPage();' style='display:none;'></div>";
		}
	}
	$allPics = getAllPics($cfolder);
	if (count($allPics) >0 )
	{
		asort($allPics);
	}
	echo "<div class='pageNav'>";
	pageNav($first, $maxNo, count($allPics));
	echo "</div>";
	for($a=0; $a<$maxNo; $a++)
	{
		$cu = $a + $first;
		if($allPics[$cu]!="")
		{
			if ($allPics[$cu] == "." || $allPics[$cu] == "..")
			{
			}
			else if(is_dir($cfolder."/".$allPics[$cu]))
			{
				echo "<a href='?sdir=".$fsdir."/".$allPics[$cu]."' class='picBlocks'>";
				echo "<div class='img'><img src='images/folder.jpg' style='height:auto;'></div>";
				echo "<div href='' class='name' style='font-weight:bold;'>".$allPics[$cu]."</div>";
				echo "</a>";
			}
			else
			{
				echo "<div class='picBlocks'>";
				echo "<div class='img'><img src='".$cfolder.$allPics[$cu]."'><div class='closeIcon' onclick='removeImg(this);'></div><div class='editIcon' onclick='useImg(this);'>Use it</div></div>";
				echo "<div class='name'>".$allPics[$cu]."</div>";
				echo "</div>";
			}
		}
	}
	echo "<div class='space'></div>";
	echo "<div class='pageNav'>";
	pageNav($first, $maxNo, count($allPics));
	echo "</div>";
	echoJSFunc();
	echo "</body>";
}

function deletFile($folder, $file)
{
	if(file_exists($folder.$file))
	{
		if(unlink($folder.$file)) { $delmsg = "1"; }
		else { $delmsg = "2"; }
	}
	else
	{
		$delmsg = "3";
	}
	return $delmsg;
}

function addFolder($folder, $name)
{
	$f = $folder."/".$name;
	$f = str_replace("//", "/", $f);
	if(!is_dir($f))
	{
		if(mkdir($f, 0777)) { $delmsg = "1"; }
		else { $delmsg = "2"; }
	}
	else
	{
		$delmsg = "3";
	}
	return $delmsg;
}

function echoUploadInput()
{
	$fsdir = $_GET['sdir']?$_GET['sdir']:"";
	$fsdir = str_replace("//", "/", $fsdir);
	if ($fsdir=="")
	{
		$fsdir = $_POST['sdir']?$_POST['sdir']:"";
		$fsdir = str_replace("//", "/", $fsdir);
	}
	echo "<script language='javascript' src='js/jquery-1.4.2.min.js'></script>\n";
	echo "<form enctype='multipart/form-data' method='post' action='?'>";
	echo "<input type='hidden1' name='sdir' id='sdir' value=".$fsdir."  />";
	echo "<input name='page' value='".$_GET['page']."' type='hidden'>";
	echo "<input name='MAX_FILE_SIZE' value='100000000' type='hidden'>";
	echo "<input name='f' value='".$_GET['f']."' type='hidden'>";
	echo "<input name='POSTACTION' value='UPLOAD' type='hidden'>";
	echo "<input name='userfile' type='file' id='userfile' value='' >";
	echo "<input value='upload' type='submit'>";
	//echo "<p style='font-size:11px; color:#595959; font-family:Arial,Verdana;'>Upload picture.</p>";
	echo "</form>";
	echo "<div class='space'></div>";
	echo "<script language='javascript' type='text/javascript'> \n";
	//echo "document.getElementById('userfile').click();\n";
	/*
	echo "var x = null; \n";
	echo "function checkUploadFile()";
	echo "{ \n";
		echo "if($('#userfile').val()!='') \n"; 
		echo "{ \n";
			echo "$('form').submit();";
		echo "} \n";
	echo "} \n";
	
	echo "x = setInterval(checkUploadFile, 1000);\n";
	*/
	echo "$('#userfile').bind('change',function(){ \n";
		echo "$('form').submit();";
	echo "})";
	
	echo "</script>\n";
}
function echoJSFunc()
{
	echo "<script language='javascript' src='js/jquery-1.4.2.min.js'></script>\n";
	echo "<script language='javascript' src='js/jquery.ui.core.min.js'></script>\n";
	echo "<script language='javascript' src='js/jquery.ui.widget.min.js'></script>\n";
	echo "<script language='javascript' src='js/jquery.ui.mouse.min.js'></script>\n";
	echo "<script language='javascript' src='js/commend.js'></script>\n";
	echo "<script language='javascript' type='text/javascript'> \n";
	echo "function updateToMainPage() \n";
	echo "{ \n";
	#echo "var fileOldName = $('#uploadFileOldName').html(); \n";
	echo "var fileName = $('#uploadFileName').html(); \n";
	echo "var fileFrom = $('#uploadFrom').html(); \n";
	//echo "alert(fileName+' '+fileFrom); \n";
	//echo "parent.document.getElementById(fileFrom).value = fileName; \n";
	echo "parent.document.getElementById('uploadFrameDiv').parentNode.style.display = 'none'; \n";
	echo "parent.document.getElementById('uploadFrame').src = ''; \n";
	echo "parent.changeBgImg(fileFrom,fileName) \n";
	echo "} \n";
	
	echo "$(document).ready(function(){\n";
	//echo "updateToMainPage()\n";
	echo "}); \n";
	//echo "updateToMainPage()";
	
	echo "</script>";
}
?>
