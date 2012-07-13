<?
include"includes/config.php";
include"includes/globalFunc.php";
include"includes/getData.php";

$type = $_POST['type'];
$method = $_POST['method'];
$list = $_POST['list'];

if($type != "")
{
	if($method == "makeOrder" && $list != "")
	{
		if($type == "article")
		{
			$table = "ph_articles";
		}
		else if($type == "wallpapers")
		{
			$table = "ph_wallpapers";
		}
		else if ($type == "wallpaperInner")
		{
			$table = "ph_wallpapers";
		}
		$t = explode(",",$list,-1);
		$flag = 1;
		for($a = 0; $a < count($t); $a++)
		{
			$keys = array();
			$vals = array();
			array_push($keys, "oid");
			array_push($vals, ($a+1));
			array_push($keys, "id");
			array_push($vals, $t[$a]);
			//print_r($keys);
			//print_r($vals);
			$result = upData($table, $keys, $vals);
			if($result<0)
			{
				$flag = 0;
			}
		}
		if($flag == 1)
		{
			echo  "updated";
		}
	}
}

?>