<?
function getList($table, $orderBy, $order, $first, $max)
{
	global $mysql; 
	$conn = mysql_pconnect($mysql[0], $mysql[2], $mysql[3]) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($mysql[1], $conn);
	mysql_query("set names 'utf8'");
	
	$sql = "SELECT * FROM ".$table ;
	$query_data_all = sprintf($sql);
	if($orderBy!="")
	{
		if ($order == "desc")
		{
			$sql .= " order by ".$orderBy." ".$order ;
		}
		else
		{
			$sql .= " order by ".$orderBy." asc" ;
		}
	}
	if ($first > -1 && $max > 0 )
	{
		$sql .= " limit ".$first.", ".$max ;
	}
	//echo $sql;
	$query_data = sprintf($sql);
	
	$data_all = mysql_query($query_data_all, $conn) or die(mysql_error());
	$totalRows_data_all = mysql_num_rows($data_all);
	$data = mysql_query($query_data, $conn) or die(mysql_error());
	$row_data = mysql_fetch_assoc($data);
	$totalRows_data = mysql_num_rows($data);

	if ( $totalRows_data > 0 ) {
		$i = 1 ;
		do {
			$dataList[$i] = $row_data;
			$i++;
		} while ($row_data = mysql_fetch_assoc($data));
	}
	$dataList[0] =  $totalRows_data_all ;
	return $dataList;
}

function getInfo($table, $colum, $value)
{
	global $mysql; 
	$conn = mysql_pconnect($mysql[0], $mysql[2], $mysql[3]) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_select_db($mysql[1], $conn);
	mysql_query("set names 'utf8'");
	$query_data = sprintf("SELECT * FROM %s where `%s` = %s ;", $table, $colum, GetSQLValueString($value, "text"));

	$data = mysql_query($query_data, $conn) or die(mysql_error());
	$row_data = mysql_fetch_assoc($data);
	$totalRows_data = mysql_num_rows($data);
	return $row_data;
}

function upData($table, $keys, $vals)
{
	global $mysql ; 
	$conn = mysql_pconnect($mysql[0], $mysql[2], $mysql[3]) or trigger_error(mysql_error(),E_USER_ERROR) ; 
	mysql_select_db($mysql[1], $conn) ;
	mysql_query("set names 'utf8'") ;
	
	for($a=0; $a<count($keys); $a++)
	{
		if($keys[$a]=="id" && $vals[$a]>0)
		{
			$id = $vals[$a] ;
			$data = getInfo($table, "id", $vals[$a]) ;
		}
		if($keys[$a]=="date" && $vals[$a]=="")
		{
			$vals[$a] = date("Y-m-s H:i:s");
		}
	}
	if($data['id']>0)
	{
		$sql_query = "" ;
		for($a=0; $a<count($keys); $a++)
		{
			if($keys[$a]!="id")
			{
				$sql_query .= "`".$keys[$a]."`=".GetSQLValueString($vals[$a], "text").", ";
			}
		}
		$sql_query = substr($sql_query, 0,(strlen($kys)-2)) ;
		$sql_query = $sql_query." WHERE id=".$id." ;" ;
		$sql = sprintf("UPDATE %s SET %s", $table, $sql_query) ;
	}
	else
	{
		$sql_query = "" ;
		for($a=0; $a<count($keys); $a++)
		{
			if($keys[$a]!="id")
			{
				$kys .= "`".$keys[$a]."`, " ;
				$vls .= GetSQLValueString($vals[$a], "text").", " ;
			}
		}
		$kys = substr($kys, 0, (strlen($kys)-2)) ;
		$vls = substr($vls, 0, (strlen($vls)-2)) ;
		$sql_query .= " ( ".$kys.") values ( ".$vls.") ;" ;
		$sql = sprintf("INSERT INTO %s %s", $table, $sql_query) ;
	}
	//echo $sql."<br>" ;
	return mysql_query($sql, $conn) or die(mysql_error());
}

function searchList($table, $params, $orderBy, $order, $first, $max)
{
	global $mysql ; 
	$conn = mysql_pconnect($mysql[0], $mysql[2], $mysql[3]) or trigger_error(mysql_error(),E_USER_ERROR) ; 
	mysql_select_db($mysql[1], $conn) ;
	mysql_query("set names 'utf8'") ;
	
	$sql_all = sprintf("select * from %s where 1 ", $table);
	if($params!="")
	{
		foreach($params as $k => $v)
		{
			$tmp = "";
			for($a=0; $a<count($v); $a++)
			{
				$val = "%".$v[$a]."%";
				$tmp .= sprintf("`%s` like %s or ", $k, GetSQLValueString($val, "text"));
			}
			$sql_all .= " and ( ".substr($tmp, 0, -3)." ) ";
		}
	}
	$sql = $sql_all;
	if($orderBy!="")
	{
		if ($order == "desc")
		{
			$sql .= " order by ".$orderBy." ".$order ;
		}
		else
		{
			$sql .= " order by ".$orderBy." asc" ;
		}
	}
	if ($first > -1 && $max >0 )
	{
		$sql .= " limit ".$first.", ".$max ;
	}
	//echo $sql_all."<br>";
	//echo $sql."<br>";
	$data_all = mysql_query($sql_all, $conn) or die(mysql_error());
	$totalRows_data_all = mysql_num_rows($data_all);
	$data = mysql_query($sql, $conn) or die(mysql_error());
	$row_data = mysql_fetch_assoc($data);
	$totalRows_data = mysql_num_rows($data);

	if ( $totalRows_data > 0 ) {
		$i = 1 ;
		do {
			$dataList[$i] = $row_data;
			$i++;
		} while ($row_data = mysql_fetch_assoc($data));
	}
	$dataList[0] =  $totalRows_data_all ;
	return $dataList;
}

function getAllPics($dir) {
	$handle = opendir($dir);
	$i = 0 ;
	while(false!==($filename=readdir($handle))) {
		if ($filename!="." && $filename!=".." && $filename!="Thumbs.db") {
			$names[$i] = $filename;
			//$sizes[$i] = (filesize($dir."/".$filename)/1000);
			//$type[$i] = (filetype($dir."/".$filename));
			$i++;
		}
	}
	return $names;
}
function listAllPic($dir,$page,$maxNo) {
	$handle = opendir($dir);
	$i = 0 ;
	while(false!==($filename=readdir($handle))) {
		if ($filename!="." && $filename!="..") {
			$names[$i] = $filename;
			$sizes[$i] = (filesize($dir."/".$filename)/1000);
			//$type[$i] = (filetype($dir."/".$filename));
			$i++;
		}
	}
	//array_multisort($names,SORT_DESC,$filename);     

	$pagenum = 1;
	if (isset($page)) {
	  $pagenum = $page;
	}
	$startnum = ($pagenum - 1) * $maxNo ;
	$endnum = $startnum + $maxNo;

	for($m = $startnum; $m<$endnum; $m++)
	{
		if($names[$m]!="")
		{
			echo "<tr style='background:#fff'>";
			echo "<td width='100' style='height:40px;'><a href='".$dir.$names[$m]."' target='_blank' class='folderNum' title='$names[$m]'><img src='".$dir.$names[$m]."'  height='30' border=0></a></td>";
			echo "<td>".$names[$m]."</td>";
			echo "<td><input style='width:320px;' value='".$dir.$names[$m]."'></td>";
			echo "<td><a href='?page=".$page."&method=del&name=".$names[$m]."'>Delete</a></td>";
			echo "</tr>";
		}
	}
	echo "</table>";
	echo "<table width='100%' border='0' cellpadding='0' cellspacing='0' class='dataTable'>";
	echo "<tr><td colspan='3'>";
	pageNav($startnum, $maxNo, $i);
	echo "</td></tr>";
	echo "</table>";
}

function deleteImg($folder,$name)
{
	if(file_exists($folder.$name))
	{
		if(unlink($folder.$name))
		{
			$delmsg = "Delete success.";
		}
		else
		{
			$delmsg = "Delete Failed.";
		}
	}
}


function getTime($time)
{
	$time2['y'] = substr($time,0,4);
	$time2['m'] = substr($time,5,2);
	$time2['d'] = substr($time,8,2);
	
	$time2['h'] = substr($time,11,2);
	$time2['i'] = substr($time,14,2);
	$time2['s'] = substr($time,17,2);
	return $time2;
}

function u2utf82gb($c){
    $str="";
	if($c>1000)
	{
		if ($c < 0x80) {
			 $str.=$c;
		} else if ($c < 0x800) {
			 $str.=chr(0xC0 | $c>>6);
			 $str.=chr(0x80 | $c & 0x3F);
		} else if ($c < 0x10000) {
			 $str.=chr(0xE0 | $c>>12);
			 $str.=chr(0x80 | $c>>6 & 0x3F);
			 $str.=chr(0x80 | $c & 0x3F);
		} else if ($c < 0x200000) {
			 $str.=chr(0xF0 | $c>>18);
			 $str.=chr(0x80 | $c>>12 & 0x3F);
			 $str.=chr(0x80 | $c>>6 & 0x3F);
			 $str.=chr(0x80 | $c & 0x3F);
		}
		//return iconv('utf-8', 'GB2312', $str);
		return mb_convert_encoding($str, "gbk", "utf-8");
	}
	else
	{
		return chr($c);
	}
}
function strChange($str)
{
	$strTmp = explode("\\u",$str);
	for($a=1;$a<count($strTmp);$a++)
	{
		if($strTmp[$a]!="")
		{
			$strChange[$a] = u2utf82gb($strTmp[$a]);
		}
		$tmp .= $strChange[$a];
	}
	return $tmp;
}
?>
