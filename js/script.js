var result=new Array();
var totalIndex,score=0,finished=0;
for(var i=0;i<35;i++) result[i]=0;
console.log(danxCount);
function putResult(res,n){
	result[n]=res;
}
function putResult2(chencked,val,n){
	
	if(chencked){
		result[n]+=val;
		//console.log(result);
	}else{
		result[n]-=val;
		//console.log(result);
	}
}
function others(n){
	totalIndex=n;
	document.getElementById("nowaday").innerHTML="当前第"+n+"题";
}

function option(n){
	switch(n){
	case 1:
		return 'A';
	case 2:
		return 'B';
	case 4:
		return 'C';
	case 8:
		return 'D';
	case '1':
		return 'A';
	case '2':
		return 'B';
	case '4':
		return 'C';
	case '8':
		return 'D';
	default: return '找不到';
	}
}
function reOption2(n){
	var optionbar=document.getElementById('optionbar');
	switch(n){
		case 1:
			optionbar.childNodes.item(0).checked="checked";
			break;
		case 2:
			optionbar.childNodes.item(2).checked="checked";
			break;
	}
}
function reOption(n){
	var optionbar=document.getElementById('optionbar');
	switch(n){
		case 1:
			optionbar.childNodes.item(0).checked="checked";
			break;
		case 2:
			optionbar.childNodes.item(2).checked="checked";
			break;
		case 4:
			optionbar.childNodes.item(4).checked="checked";
			break;
		case 8: 
			optionbar.childNodes.item(6).checked="checked";
			break;
		case 3:
			optionbar.childNodes.item(0).checked="checked";
			optionbar.childNodes.item(2).checked="checked";
			break;
		case 5:
			optionbar.childNodes.item(0).checked="checked";
			optionbar.childNodes.item(4).checked="checked";
			break;
		case 9:
			optionbar.childNodes.item(0).checked="checked";
			optionbar.childNodes.item(6).checked="checked";
			break;
		case 6:
			optionbar.childNodes.item(2).checked="checked";
			optionbar.childNodes.item(4).checked="checked";
			break;
		case 10:
			optionbar.childNodes.item(2).checked="checked";
			optionbar.childNodes.item(6).checked="checked";
			break;
		case 12:
			optionbar.childNodes.item(4).checked="checked";
			optionbar.childNodes.item(6).checked="checked";
			break;
		case 7:
			optionbar.childNodes.item(0).checked="checked";
			optionbar.childNodes.item(2).checked="checked";
			optionbar.childNodes.item(4).checked="checked";
			break;
		case 11:
			optionbar.childNodes.item(0).checked="checked";
			optionbar.childNodes.item(2).checked="checked";
			optionbar.childNodes.item(6).checked="checked";
			break;
		case 13:
			optionbar.childNodes.item(0).checked="checked";
			optionbar.childNodes.item(4).checked="checked";
			optionbar.childNodes.item(6).checked="checked";
			break;
		case 14:
			optionbar.childNodes.item(2).checked="checked";
			optionbar.childNodes.item(4).checked="checked";
			optionbar.childNodes.item(6).checked="checked";
			break;
		case 15:
			optionbar.childNodes.item(0).checked="checked";
			optionbar.childNodes.item(2).checked="checked";
			optionbar.childNodes.item(4).checked="checked";
			optionbar.childNodes.item(4).checked="checked";
			break;
	}
}
function displayDanx(n){
	others(n);
	n--;
	if(finished){
		if(result[n]!=0){
			if(answer[n]['answer']!=result[n]){
				var des="这道题你选的是"+option(result[n])+"   正确答案是"+ option(answer[n]['answer']);
			}else var des="这道题你做对了";
		}else var des="这道题你没做";
		document.getElementById('des').innerHTML=des+"<br />"+answer[n]['analysis'];
	}
	cont=document.getElementById("content");
	var oprt="<div id='optionbar'><input onClick='putResult(1," + n + ")' type='radio' name='danx' value='1'>A<input onClick='putResult(2," + n + ")' type='radio' name='danx' value='2'>B<input onClick='putResult(4," + n + ")' type='radio' name='danx' value='4'>C<input onClick='putResult(8," + n + ")' type='radio' name='danx' value='8'>D</div>";
	
	//////////////////////////////////////////////////////翻页代码
	if(danxArr.length>=35)maxNext=34;
	else maxNext=danxArr.length-1;
	fanye="";
	if(n>=1) var fanye= "<button onclick='displayDanx("+n+")'>上一个</button>";
	if(n<maxNext) fanye+= "<button onclick='displayDanx("+(n+2)+")'>下一个</button>";
	else fanye+= "<button onclick='displayDuox(1)'>下一个</button>";
	//////////////////////////////////////////////////////////////////
	
	cont.innerHTML="<div id='stitle'>题目:"+danxArr[n]['content']+"</div><div id='a'>A."+danxArr[n]['a']+"</div><div id='b'>B."+danxArr[n]['b']+"</div><div id='c'>C."+danxArr[n]['c']+"</div><div id='d'>D."+danxArr[n]['d']+"</div>"+oprt+fanye;
	if(result[n]!=0){
		reOption(result[n]);
	}
	
}
function displayCail(n){
	cont=document.getElementById("content");
	cont.innerHTML="<div id='stitle'>题目:"+cailArr[n]['content']+"</div>";	
}
function displayXiez(n){
	cont=document.getElementById("content");
	cont.innerHTML="<div id='stitle'>题目:"+xiezArr[n]['content']+"</div>";	
}
function quesSubmit(){
	for(var i=0;i<danxCount;i++){
		if(answer[i]['answer']==result[i]) score+=1;
		else document.getElementById('danxindex').childNodes.item(i).style.color="red";
	}
	finished=1;
	alert("你的成绩："+score);
}
function mark(){
	var type;
	type='danxindex';
	
	//if((totalIndex%20)!=0) var t=document.getElementById(type).childNodes.item(totalIndex%20-1);
	//else var t=document.getElementById(type).childNodes.item(19);
	var t=document.getElementById(type).childNodes.item(totalIndex-1);
	if(t.style.border=="1px solid orange"){
		t.style.border="1px solid #F4F4F4";
	}else t.style.border="1px solid orange";
	//if(t.style.background=="orange"){
	//	t.style.background="";
	//}else t.style.background="orange";
}

var time=60*60;
function timer(){
	minute=Math.floor(time/60);
	second=time%60;
	document.getElementById("timer").innerHTML="剩余时间："+minute+"分钟"+second+"秒";
	time--;
	if(time<=0){
		clearInterval(itl);
		document.getElementById("timer").innerHTML="时间到！";
		alert("时间到！");
	}
}


