<?php
include("config.php");
$sql_danxuan="SELECT * 
FROM  `danxuan` 
LIMIT 0 , 35";
$sql_cailiao="SELECT * 
FROM  `cailiao` 
LIMIT 0 , 30";
$sql_xiezuo="SELECT * 
FROM  `xiezuo` 
LIMIT 0 , 30";
$result=mysql_query($sql_danxuan);
$i=0;
while($row=mysql_fetch_array($result)){
	$row['content']=iconv("gb2312","utf-8//IGNORE",$row['content']);
	$row['a']=iconv("gb2312","utf-8//IGNORE",$row['a']);
	$row['b']=iconv("gb2312","utf-8//IGNORE",$row['b']);
	$row['c']=iconv("gb2312","utf-8//IGNORE",$row['c']);
	$row['d']=iconv("gb2312","utf-8//IGNORE",$row['d']);
	$row['answer']=iconv("gb2312","utf-8//IGNORE",$row['answer']);
	$row['analysis']=iconv("gb2312","utf-8//IGNORE",$row['analysis']);
	$danxuan[$i]['content']=urlencode($row['content']);
	$danxuan[$i]['a']=urlencode($row['a']);
	$danxuan[$i]['b']=urlencode($row['b']);
	$danxuan[$i]['c']=urlencode($row['c']);
	$danxuan[$i]['d']=urlencode($row['d']);
	$danxuan[$i]['answer']=urlencode($row['answer']);
	$danxuan[$i]['analysis']=urlencode($row['analysis']);
	$i++;
}
//////////////////////////////////////////////
$result=mysql_query($sql_cailiao);
$i=1;
while($row=mysql_fetch_array($result)){
	$row['content']=iconv("gb2312","utf-8//IGNORE",$row['content']);
	$row['answer']=iconv("gb2312","utf-8//IGNORE",$row['answer']);
	$cailiao[$i]['content']=urlencode($row['content']);
	$cailiao[$i]['answer']=urlencode($row['answer']);
	$i++;
}
////////////////////////////////////////////////////
$result=mysql_query($sql_xiezuo);
$i=1;
while($row=mysql_fetch_array($result)){
	$row['content']=iconv("gb2312","utf-8//IGNORE",$row['content']);
	$row['answer']=iconv("gb2312","utf-8//IGNORE",$row['answer']);
	$xiezuo[$i]['content']=urlencode($row['content']);
	$xiezuo[$i]['answer']=urlencode($row['answer']);
	$i++;
}
////////////////////////////////////////////////////


$page=file_get_contents('template/home.html');
//////////////////////////////////////////////////////////////////php中数组传入JS
$danx_json = json_encode($danxuan);
$cail_json = json_encode($cailiao);
$xiez_json = json_encode($xiezuo);
$danx_count=count($danxuan);
$script1 = "<script>
var danxArr=eval('(".$danx_json.")');
var cailArr=eval('(".$cail_json.")');
var xiezArr=eval('(".$xiez_json.")');
var danxCount=".$danx_count."
for(var key in danxArr)
{
	danxArr[key]['content']=decodeURI(danxArr[key]['content']);
	danxArr[key]['a']=decodeURI(danxArr[key]['a']);
	danxArr[key]['b']=decodeURI(danxArr[key]['b']);
	danxArr[key]['c']=decodeURI(danxArr[key]['c']);
	danxArr[key]['d']=decodeURI(danxArr[key]['d']);
	danxArr[key]['answer']=decodeURI(danxArr[key]['answer']);
	danxArr[key]['analysis']=decodeURI(danxArr[key]['analysis']);
}
for(var key in cailArr)
{
	cailArr[key]['content']=decodeURI(cailArr[key]['content']);
	cailArr[key]['answer']=decodeURI(cailArr[key]['answer']);
}
for(var key in xiezArr)
{
	xiezArr[key]['content']=decodeURI(xiezArr[key]['content']);
	xiezArr[key]['answer']=decodeURI(xiezArr[key]['answer']);
}
var answer=new Array();
answer=danxArr;
</script>";
$page=str_replace('<!--scriptMark-->',$script1,$page);
/*
<!--scriptMark-->
<!--danxMark-->
<!--cailMark-->
<!--xiezMark-->
<!--contMark-->
*/
/////////////////////////////////////////////////////////////////////////
$danxindex="";
$cailindex="";
$xiezindex="";
for($i=1;$i<=count($danxuan);$i++){
	$danxindex.="<span class='index' hiddenid='$i' onclick='displayDanx($i)'>$i</span>";
}
for($i=1;$i<=1;$i++){
	$cailindex.="<span class='index' hiddenid='$i' onclick='displayCail($i)'>$i</span>";
}
for($i=1;$i<=1;$i++){
	$xiezindex.="<span class='index' hiddenid='$i' onclick='displayXiez($i)'>$i</span>";
}
$page=str_replace('<!--danxMark-->',$danxindex,$page);
$page=str_replace('<!--cailMark-->',$cailindex,$page);
$page=str_replace('<!--xiezMark-->',$xiezindex,$page);
echo $page;
/*

*/
?>