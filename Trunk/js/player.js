function adaptCSSPlayer(){
	var tmp = document.getElementsByTagName("VIDEO")[0].offsetHeight;
	document.getElementById("TagMenuView").style.height = tmp+'px';
	document.getElementById("player").style.margin = '0px';	
}
