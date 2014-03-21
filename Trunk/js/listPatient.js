function adaptCSSSection(){
	document.getElementById("player").style.width = 77+'%';
	var tmp = document.getElementsByTagName("VIDEO")[0].offsetHeight;
	document.getElementById("ListOfPatients").style.height = tmp+'px';

//	var tmp = document.getElementsByTagName("VIDEO")[0].bottom;
	document.getElementById("ListOfPatients").getElementsByTagName("UL")[0].style.height = '96%';
}

function showVideoOfPatient(id){
	window.location.href = 'index.php?patient='+id;
}

function showVideo(id, filename){
	window.location.href = 'index.php?patient='+id+'&filname='+filename;
}
