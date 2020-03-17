function show(keyword){

	var request=new XMLHttpRequest();

	request.onreadystatechange=function()
	{
		if(request.readyState==4 && request.status == 200)
		{
			document.getElementById("resultSearch").innerHTML=request.responseText;
		}
	}
		request.open("GET","searchAjax.php?search="+keyword);
		request.send();

}