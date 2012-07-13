<?
include"includes/config.php";
include"includes/globalFunc.php";
include"includes/getData.php";

$type = $_GET['type'];
$page = $_GET['page'];

if($type=="products")
{
	$maxNo = 14;
	$first = ($page-1)*$maxNo;
	$categorys = explode("||",$_GET['categorys']);
	$materials = explode("||",$_GET['materials']);
	$colours = explode("||",$_GET['colours']);
	$issue_dates = explode("||",$_GET['issue_dates']);

	$category = array();
	$material = array();
	$colour = array();
	$date = array();
	
	for($a=0; $a<(count($categorys)-1); $a++)
	{
		array_push($category, $categorys[$a]);
	}
	for($a=0; $a<(count($materials)-1); $a++)
	{
		array_push($material, $materials[$a]);
	}
	for($a=0; $a<(count($colours)-1); $a++)
	{
		array_push($colour, $colours[$a]);
	}
	for($a=0; $a<(count($issue_dates)-1); $a++)
	{
		array_push($date, $issue_dates[$a]);
	}
	if(count($category)>0)
	{
		$params['category'] = $category;
	}
	if(count($material)>0)
	{
		$params['material'] = $material;
	}
	if(count($colour)>0)
	{
		$params['colour'] = $colour;
	}
	if(count($date)>0)
	{
		$params['date'] = $date;
	}
	$orderBy = "date";
	$order = "desc";
	$data = searchList("ph_products", $params, $orderBy, $order, $first, $maxNo);
	echo "{";
	echo "'total':'".$data[0]."',\n";
	echo "'page':'".$page."',\n";
	echo "'list':[\n";
	for($a=1; $a<=(count($data)-1); $a++)
	{
		if($data[$a]['id']>0)
		{
			$img = explode("||",$data[$a]['img']);
			$img = str_replace("||","",$img[0]);
			echo "{\n";
			echo "'id':".GetSQLValueString($data[$a]['id'], "text").",\n";
			echo "'img':".GetSQLValueString($img, "text").",\n";
			echo "'title':".GetSQLValueString($data[$a]['title'], "text").",\n";
			echo "'category':".GetSQLValueString(str_replace("_"," ",str_replace("||"," / ",$data[$a]['category'])), "text").",\n";
			echo "'material':".GetSQLValueString(str_replace("_"," ",str_replace("||"," / ",$data[$a]['material'])), "text").",\n";
			echo "'colour':".GetSQLValueString(str_replace("_"," ",str_replace("||"," / ",$data[$a]['colour'])), "text").",\n";
			if (GetSQLValueString($data[$a]['price'], "text")!='NULL')
			{
				echo "'price':".GetSQLValueString($data[$a]['price'], "text")."\n";
			}
			else
			{
				echo "'price':''\n";
			}
			//echo "'price':".GetSQLValueString($data[$a]['price'], "text")."\n";
			if($a==(count($data)-1))
			{
				echo "}\n";
			}
			else
			{
				echo "},\n";
			}
		}
	}
	echo "]\n";
	echo "}\n";
}

?>