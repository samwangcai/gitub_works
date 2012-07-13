<?

function pageNav($first,$maxNo,$total)
{		
//初始值	
	$currentPage = 1 ;
	$pageNum = ceil($total / $maxNo);
	$url = getURL();
	
//去掉"&page=*"字段
	$tmp = explode("&amp;",$url);
	for($a=1;$a<count($tmp);$a++)
	{
		if(preg_match("/page=/i",$tmp[$a]))
		{
			$tmp[$a] = "";
		}
		else
		{
			$tmp[$a] = "&amp;".$tmp[$a];
		}
	}
	$url = implode("",$tmp);

//判断当前页是否在可行范围之内
	if(isset($_GET['page']))
	{
		if($_GET['page']<1) 
		{
			$currentPage = 1 ;
		}
		else if($_GET['page']>$pageNum)
		{
			$currentPage = $pageNum ;
		}
		else
		{
			$currentPage = $_GET['page'] ;
		}
	}
	
	printPageNav($currentPage,$pageNum,$url,$total);
}

function getURL()
{
	$regFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
	  $regFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}
	return $regFormAction;
}

function printPageNav($currentPage,$pageNum,$url,$total)
{
	echo "<div id=pageNav>";
	echo "<div id=page_left>";
	//echo "<div class='totalPage'>total : ".$total."</div>";
	echo "<div class='page_index'>";
	//echo "<div class='pageTitle' >current page : </div>";

	$maxNum = 10;
	$start = 1;
	$end = $pageNum;
	
	if($pageNum>$maxNum)
	{
		if($currentPage>5)
		{
			if(($currentPage+5) <= $pageNum)
			{
				$start = ($currentPage-5);
				$end = ($currentPage+5);
			}
			else
			{
				$start = $pageNum-10;
				$end = $pageNum;
			}
		}
		else if($currentPage<=5)
		{
			if(($currentPage+5) < $end)
			{
				$end = ($currentPage+5)+(6-$currentPage);
			}
		}
	}
	else
	{
		$start = 1;
		$end = $pageNum;
	}
	echo "<a href='".$url."&page=1'><img src='images/page_first.gif'></a>";
	for($a=$start;$a<=$end;$a++)
	{
		
		if($a==$currentPage)
		{
			echo "<span class='page_index_disable'>".$a."</span>";
		}
		else
		{
			echo "<a href='".$url."&page=".$a."'>".$a."</a>";
		}
	}
	echo "<a href='".$url."&page=".$pageNum."'><img src='images/page_last.gif'></a>";
	echo "</div>";
	echo "</div>";
	
	/*
	echo "<div id='page_right'>";
	if($currentPage==1)
	{
		echo "<div class='page_button_disable'>第一页</div>";
		echo "<div class='page_button_disable'>前一页</div>";
	}
	else
	{
		echo "<a href='".$url."page=1' class='page_button'>第一页</a>";
		echo "<a href='".$url."page=".($currentPage-1)."' class='page_button'>前一页</a>";
	}
	
	if($currentPage == $pageNum)
	{
		echo "<div class='page_button_disable'>下一页</div>";
		echo "<div class='page_button_disable'>最后页</div>";
	}
	else
	{
		echo "<a href='".$url."page=".($currentPage+1)."' class='page_button'>下一页</a>";
		echo "<a href='".$url."page=".$pageNum."' class='page_button'>最后页</a>";
	}
	echo "</div>";
	*/
	echo "</div>";
	
}


?>