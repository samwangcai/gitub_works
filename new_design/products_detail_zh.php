<?
session_start();

include"includes/config.php";
include"includes/globalFunc.php";
include"includes/getData.php";
include"includes/login_out.php";
include"includes/pageNav.php";
//include("fckeditor/fckeditor.php") ;

$id = $_GET['id']?$_GET['id']:0;

$table = $table_per."products";
$data = getInfo($table, "id", $id);
$img = explode("||",$data['pictures']);

$table = $table_per."pro_story";
$sql = " where 1 and product_id=".$data['id']." limit 0, 1;";
$rela_story = getData($table,$sql);

if($rela_story[0]>0)
{
	$table = $table_per."story";
	$rela_data = getInfo($table, "id", $rela_story[1]['id']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>phdesign admin page</title>
</head>
<body>
	<div class="container">
		<? include"includes/header_en.php"; ?>
		<div class="mainbody">
			<div class="bannerBlock">
				<div class="imgList" cid="0">
					<?
					$i = 0;
					echo "<style>";
					for($a=0; $a<count($img); $a++)
					{
						if($a!=$data['thumb'] && $img[$a]!="")
						{
							echo ".div_".$i." { background-image:url(".$folder.$img[$a].") }\n";
							$i ++;
						}
					}
					echo "</style>";
					
					$i = 0;
					for($a=0; $a<count($img); $a++)
					{
						if($a!=$data['thumb'] && $img[$a]!="")
						{
							echo "<div src='".$folder.$img[$a]."' ></div>\n";
							$i ++;
						}
					}
					?> 
				</div>
				<div class="prevBtn"></div>
				<div class="nextBtn"></div>
	
				<div class="moveNav"></div>
				<?
				$i = 0; 
				for($a=0; $a<count($img); $a++)
				{
					if($a!=$data['thumb'] && $img[$a]!="")
					{
						echo "<div class='div_".$i."'></div>\n";
						$i ++;
					}
				}
				?>
				<div class="moveOut">
					<div class="moveWidthOut">
						<div class="blockImg block0"></div>
						<div class="blockImg block1"></div>
						<div class="blockImg block2"></div>
					</div>		
				</div>
				
				<div class="navigation">
					<div style="float:left; 
					<?
					if( $rela_data['id']>0 )
					{
						echo " width:80%; ";
					}
					else
					{
						echo " width:100%; ";
					}
					?>
					overflow-x:hidden;">
					Location:
					<a href="index_en.php">Homepage</a> / 
					<a href="products_en.php">Products</a>
					<?
					if($data['id']!="")
					{
						echo " / <a href='#'>".$data['title_en']."</a>";
					}
					?>
					</div>
					
					<?
					if( $rela_data['id']>0 )
					{
						echo "<div style='float:right; width:20%; overflow-x:hidden;'>";
						echo "<a href='design_story_detail_zh.php?id=".$rela_data['id']."'>".$rela_data['title_zh']."</a>";
						echo "</div>";
					}
					?>
				</div>
				
				<div class="">
					<div class="pro_syno">
						<div class="title">产品简介</div>
						<div class="p_c">
							<? echo $data['synopsis_zh']; ?>
						</div>
					</div>
					<div class="pro_mate">
						<div class="title">产品简介</div>
						<div class="p_c">
							<? echo $data['material_txt_zh']; ?>
						</div>
					</div>
					<div class="pro_para">
						<div class="title">规格参数</div>
						<div class="p_c">
							<? echo "<div class='img'><img src='".$folder.$img."'></div>\n"; ?>
							<table cellpadding="0" cellspacing="0" border="0" class="normalTable">
								<tr>
									<th width="20%">长:</th>
									<td width="30%"><? echo $data['length']; ?></td>
									<th width="20%">包装:</th>
									<td width="30%"><? echo $data['packaging_zh']; ?></td>
								</tr>
								<tr>
									<th>宽:</th>
									<td><? echo $data['width']; ?></td>
									<th>净重:</th>
									<td><? echo $data['net_weight']; ?></td>
								</tr>
								<tr>
									<th>高:</th>
									<td><? echo $data['height']; ?></td>
									<th>毛重:</th>
									<td><? echo $data['gross_weight']; ?></td>
								</tr>
								<tr>
									<th>材质:</td>
									<td colspan="3"><? echo $data['material_zh']; ?></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="space"></div>
				</div>
			</div>
		</div>
		<? include"includes/footer_en.php"; ?>
	</div>
<script language="javascript">
var tag = 0;
$(document).ready(function(){
	setBannerNavPos();
	setNavFunc();
	setDefaultImgs();
});
$(".bannerBlock").bind("mouseover",function(){
	clearTimeout(y);
})
$(".bannerBlock").bind("mouseout",function(){
	y = setInterval(nextFunc,7000);
})
var y = setInterval(nextFunc,7000);
</script>	
</body>
</html>
