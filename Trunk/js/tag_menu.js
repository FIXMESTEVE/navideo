function getTagsOnTime(){
	document.getElementById("tagsByTitle").style.display = 'none';
	document.getElementById("tagsByTime").style.display = 'block';
}

function getTagsOnTitle(){
	var tmp = document.getElementById("TagMenuView").offsetWidth;
	document.getElementById("tagsByTime").style.display = 'none';
	document.getElementById("tagsByTitle").style.display = 'block';
	document.getElementById("TagMenuView").getElementsByTagName("TABLE")[0].style.width = tmp+'px';
}
