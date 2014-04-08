function adaptCSSSection(){
	document.getElementById("player").style.width = 77+'%';
	var tmp = document.getElementsByTagName("VIDEO")[0].offsetHeight;
	document.getElementById("ListOfPatients").style.height = tmp+'px';

	document.getElementById("ListOfPatients").getElementsByTagName("UL")[0].style.height = '96%';
}

function showVideoOfPatient(id){
	window.location.href = 'index.php?patient='+id;
}

function showVideo(id_patient, id_video){
	window.location.href = 'index.php?patient='+id_patient+'&play='+id_video;
}
