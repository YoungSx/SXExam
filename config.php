<?php
$taoti=$_GET['taoti'];
$tips="";
$ysx_db="zonghe".$taoti;

$ysx_user="root";
$ysx_pass="usbw";
$ysx_host="localhost";
$con=mysql_connect($ysx_host,$ysx_user,$ysx_pass);

$sql_createdb="CREATE DATABASE  `".$ysx_db."` DEFAULT CHARACTER SET gb2312 COLLATE gb2312_chinese_ci;";
$result=mysql_query($sql_createdb);
if($result) $tips.="Database zonghe".$taoti."创建成功<br />";
else  $tips.="Database zonghe".$taoti."创建失败<br />";

mysql_select_db($ysx_db);
mysql_query("set names GB2312");
