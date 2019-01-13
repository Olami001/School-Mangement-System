
function selectproductA(value){
	
 
   // var dpt_v=(document.getElementById("dpt").value);
		
	   
		if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}else{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");  // for old brow.
	}

	xmlhttp.onreadystatechange = function(){
		
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			
			//result = xmlhttp.responseText;
			result=document.getElementById("country1").innerHTML =xmlhttp.responseText;
		}
		else{
			document.getElementById("country1").innerHTML = "";
		
		}
	}
	
	var url="displaydept.php";
url=url+"?value="+value;
alert(url);
//url=url+"&dpt_v="+dpt_v;


xmlhttp.open("GET",url,true);
	xmlhttp.send();
}



//end of disdept

