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
else if($_GET['m']=="adir"&&$_GET['n']!="")
{
	echo addFolder($folder."".$_GET['f'], $_GET['n']);
}

function deletFile($folder, $file)
{
	if(is_dir($folder.$file))
	{
		if(file_exists($folder.$file."/Thumbs.db"))
		{
			unlink($folder.$file."/Thumbs.db");
		}
		if(rmdir($folder.$file)) { $delmsg = "1"; }
		else { $delmsg = "2"; }
	}
	else if(file_exists($folder.$file))
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


?>
