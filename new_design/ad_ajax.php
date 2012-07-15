<?
include"includes/config.php";
include"includes/globalFunc.php";
include"includes/getData.php";

$type = $_POST['type'];
$method = $_POST['method'];
$list = $_POST['list'];

$i = 0;
if($type != "")
{
	$table = $table_per.$type;
	if($method == "makeOrder" && $list != "")
	{
		$t = explode("||",$list);
		$flag = 1;
		for($a = 1; $a <= count($t); $a++)
		{
			if($t[$a]!="")
			{
				$p = explode("|",$t[$a]);
				if($p[0]!="")
				{
					$pid = $p[0];
					
					$keys = array();
					$vals = array();
					array_push($keys, "id");
					array_push($vals, $pid);
					array_push($keys, "oid");
					array_push($vals, $i);
					//print_r($keys);
					//print_r($vals);
					$i += 1;
					$result = upData($table, $keys, $vals);
					if($result<=0)
					{
						$flag = 0;
						break;
					}
					for($b=1; $b<=count($p); $b++)
					{
						if($p[$b]!="")
						{
							$keys = array();
							$vals = array();
							array_push($keys, "id");
							array_push($vals, $p[$b]);
							array_push($keys, "pid");
							array_push($vals, $pid);
							array_push($keys, "oid");
							array_push($vals, $i);
							//print_r($keys);
							//print_r($vals);
							$i += 1 ;
							$result = upData($table, $keys, $vals);
							if($result<=0)
							{
								$flag = 0;
								break;
							}
						}
					}
				}
				else
				{
					$flag = 0;
					break;
				}
			}
		}
		if($flag == 1)
		{
			echo  "1";
		}
	}
	else if ($method == "del")
	{
		if($_POST['id']>0)
		{
			$result = removeData($table, $_POST['id']);
			echo $result;
		}
	}
}

?>