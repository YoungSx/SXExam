<?php
include("..//config.php");
echo <<<EOD
<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
	</head>
	<body>
EOD;
//analysis
$sql_createtab="create table `".$ysx_db."`.`danxuan`(
id int(3) not null auto_increment primary key,
content varchar(255) not null default '',
a varchar(255) not null default '',
b varchar(255) not null default '',
c varchar(255) not null default '',
d varchar(255) not null default '',
answer int(3) not null ,
analysis varchar(1000) not null default ''
)ENGINE = MYISAM CHARACTER SET gb2312 COLLATE gb2312_chinese_ci;
";
$result=mysql_query($sql_createtab);
if($result)$tips.='��ѡ�����ɹ�<br />';
else $tips.='��ѡ����ʧ��<br />';


$sql_createtab="CREATE TABLE  `".$ysx_db."`.`cailiao` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`content` VARCHAR( 2000 ) CHARACTER SET gb2312 COLLATE gb2312_chinese_ci NOT NULL ,
`answer` VARCHAR( 2000 ) CHARACTER SET gb2312 COLLATE gb2312_chinese_ci NOT NULL
) ENGINE = MYISAM ;";
$result=mysql_query($sql_createtab);
if($result)$tips.='���ϱ����ɹ�<br />';
else $tips.='���ϱ���ʧ��<br />';

$sql_createtab="CREATE TABLE  `".$ysx_db."`.`xiezuo` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`content` VARCHAR( 2000 ) CHARACTER SET gb2312 COLLATE gb2312_chinese_ci NOT NULL ,
`answer` VARCHAR( 2000 ) CHARACTER SET gb2312 COLLATE gb2312_chinese_ci NOT NULL
) ENGINE = MYISAM ;";
$result=mysql_query($sql_createtab);
if($result)$tips.='д�������ɹ�<br />';
else $tips.='д������ʧ��<br />';

$file_name="ti".$taoti.".txt";
$data1=file_get_contents($file_name);
$e=mb_detect_encoding($data1, array('UTF-8', 'GB2312'));
if($e=='UTF-8') $data1=iconv("utf-8","gb2312//IGNORE",$data1);
$data=$data1;

/*
$data1=explode("--answer--",$data1);
$data=$data1[0];
$data2=$data1[1];
$data2=explode("--type--",$data2);
$t=trim($data2[0]);
$danx_ans=explode("\n",trim($t));

$t=trim($data2[1]);
$t=explode("--stype--",$t);
$cail_ans[1]=$t[0];
$cail_ans[2]=$t[1];
$xiez_ans=trim($data2[2]);
*/

//$a=explode("һ������ѡ����",$data);
$danx1=trim(mb_substr($data,strpos($data,"һ������ѡ����")+strlen("һ������ѡ����"),strpos($data,"�������Ϸ�����")-strpos($data,"һ������ѡ����")-strlen("һ������ѡ����")));
$data=mb_substr($data,strpos($data,"�������Ϸ�����"));
$cail=trim(mb_substr($data,strpos($data,"�������Ϸ�����")+strlen("�������Ϸ�����"),strpos($data,"����д����")-strpos($data,"�������Ϸ�����")-strlen("�������Ϸ�����")));
$data=mb_substr($data,strpos($data,"����д����"));
$xiez=trim(mb_substr($data,strpos($data,"����д����")+strlen("����д����"),strpos($data,"һ������ѡ����")-strpos($data,"����д����")-strlen("����д����")));
$data=mb_substr($data,strpos($data,"һ������ѡ����"));
$danx_ans1=trim(mb_substr($data,strpos($data,"һ������ѡ����")+strlen("һ������ѡ����"),strpos($data,"�������Ϸ�����")-strpos($data,"һ������ѡ����")-strlen("һ������ѡ����")));
$data=mb_substr($data,strpos($data,"�������Ϸ�����"));
$cail_ans=trim(mb_substr($data,strpos($data,"�������Ϸ�����")+strlen("�������Ϸ�����"),strpos($data,"����д����")-strpos($data,"�������Ϸ�����")-strlen("�������Ϸ�����")));
$data=mb_substr($data,strpos($data,"����д����"));
$xiez_ans=trim(mb_substr($data,strpos($data,"����д����")+strlen("����д����")));

$danx_ans1=explode("\n",$danx_ans1);
$i=1;
foreach($danx_ans1 as $val){
	$val=mb_substr($val,strpos($val,'��')+strlen('��'));
	$ans1=explode('��������',$val);
	$danx_ans[$i][0]=trim($ans1[0]);
	$danx_ans[$i][1]=trim($ans1[1]);
	$i++;
}
/*
$xiez
$xiez_ans
$cail
$cail_ans
$danx[1..35]
danx_ans[][0]
		  [1]
*/


////////////////////////////////

function option($c){
	switch($c){
	case 'A':
		return 1;
	case 'B':
		return 2;
	case 'C':
		return 4;
	case 'D':
		return 8;
	case 'AB':
		return 3;
	case 'AC':
		return 5;
	case 'AD':
		return 9;
	case 'BC':
		return 6;
	case 'BD':
		return 10;
	case 'CD':
		return 12;
	case 'ABC':
		return 7;
	case 'ABD':
		return 11;
	case 'ACD':
		return 13;
	case 'BCD':
		return 14;
	case 'ABCD':
		return 15;
	default: return 0;
	}
}

//��ʼ����
////////////////////////////////danxuan
$danx_count=count($danx_ans);//30;//35
$a=$danx1;
$a=trim(mb_substr($a,5 ));
$last_pos=0;
for($i=1;$i<=$danx_count;$i++){
	$index_len=strlen($i+1 ."��");//����ַ����ĳ���
	$pos=strpos($a,$i+1 ."��")-1;//��һ������ַ������ֵ�λ��
	$ti=trim(mb_substr($a,$last_pos,$pos-$last_pos));//ȡ������
	if($i==$danx_count) $ti=trim(mb_substr($a,$last_pos));//���һ���������
	$last_pos=$pos-$index_len+1;
	$danx2[$i]=$ti;//ѹ������
	$a=mb_substr($a,$index_len+$index_len);
}
for($i=1;$i<=$danx_count;$i++){
	$b=$danx2[$i];
	$index_len=3;//ѡ����ַ����ĳ���
	$last_pos=strpos($b,"A��")+$index_len;
	$content=trim(mb_substr($b,0,$last_pos-$index_len));
	/////////////////////////////////////////////////////////////
	$pos=strpos($b,"B��");
	$xxA=trim(mb_substr($b,$last_pos,$pos-$last_pos));//ȡ������
	$last_pos=$pos-$index_len+3;
	$b=mb_substr($b,$last_pos+$index_len);
	/////////////////////////////////////////////////////////////
	$pos=strpos($b,"C��");
	$xxB=trim(mb_substr($b,0,$pos));//ȡ������
	$last_pos=$pos-$index_len+3;
	$b=mb_substr($b,$last_pos+$index_len);
	/////////////////////////////////////////////////////////////
	$pos=strpos($b,"D��");
	$xxC=trim(mb_substr($b,0,$pos));//ȡ������
	$last_pos=$pos-$index_len+3;
	$b=mb_substr($b,$last_pos+$index_len);
	/////////////////////////////////////////////////////////////
	$xxD=trim(mb_substr($b,0));//ȡ������
	$danx[$i]['content']=$content;
	$danx[$i]['A']=$xxA;
	$danx[$i]['B']=$xxB;
	$danx[$i]['C']=$xxC;
	$danx[$i]['D']=$xxD;
	$danx[$i]['answer']=option(trim($danx_ans[$i][0]));
	$danx[$i]['analysis']=$danx_ans[$i][1];
}
$ysx_tab="danxuan";
$count=mysql_fetch_array(mysql_query("select count(*) from `".$ysx_tab."`"));////////////////////
$count=$count[0];
echo "����ǰ��$count ����ѡ�� ��";
////////////////////////////////
$i=1;
while(isset($danx[$i])){
	$content = $danx[$i]['content'];
	$a=$danx[$i]['A'];
	$b=$danx[$i]['B'];
	$c=$danx[$i]['C'];
	$d=$danx[$i]['D'];
	$answer=$danx[$i]['answer'];
	$analysis=$danx[$i]['analysis'];
	$sql="INSERT INTO  `".$ysx_db."`.`".$ysx_tab."` (
`id` ,
`content` ,
`a` ,
`b` ,
`c` ,
`d` ,
`answer`,
`analysis`
)
VALUES (
NULL ,  '$content',  '$a',  '$b',  '$c',  '$d',  '$answer',  '$analysis'
);";
	$result=mysql_query($sql);

	$count=$i;
	if($result) $tips.="�ɹ������$count ����ѡ�� <br />";
	else $tips.="��$count ����ѡ�� ����ʧ�ܣ�<br />";
	$i++;
}
$count=mysql_fetch_array(mysql_query("select count(*) from `".$ysx_tab."`"));////////////////////
$count=$count[0];
echo "�������$count ����ѡ�� <br />";
$ysx_tab="cailiao";

$sql2="INSERT INTO  `".$ysx_db."`.`".$ysx_tab."` (
`id` ,
`content` ,
`answer`
)
VALUES (
NULL ,  '".$cail."',  '".$cail_ans."'
);";
$result=mysql_query($sql2);
if($result) $tips.="�����⵼��ɹ�<br />";
else $tips.="�����⵼��ʧ��<br />";

/////////////////////////////////////////////////////////////
$ysx_tab="xiezuo";
$sql3="INSERT INTO  `".$ysx_db."`.`".$ysx_tab."` (
`id` ,
`content` ,
`answer`
)
VALUES (
NULL ,  '".$xiez."',  '".$xiez_ans."'
);";
$result=mysql_query($sql3);
if($result) $tips.="д���⵼��ɹ�<br />";
else $tips.="д���⵼��ʧ��<br />";

echo <<<EOD
	$tips
	</body>
</html>
EOD;
?>