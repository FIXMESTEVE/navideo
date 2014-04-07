
var srcVideo;
var boolAnchor = 0;
var posA = 0;
var posB = 0;
var memPosA = 0;
var memPosB = 0;
var player;


function anchorTag(button){
	soundClick();
	var player = document.getElementById("myvideo");
	var srcPlayer = player.currentSrc;
	
	sameVideoAnchor(srcPlayer);
	if(boolAnchor == 0){
		posA = player.currentTime;
		document.getElementById("newTagTest").innerHTML = "Ancre A = " + posA + " & Ancre B = null.";
		boolAnchor = 1;
		}
	else{
		posB = player.currentTime;
		boolAnchor = 0;
		if((posB - posA) > 0){
			memPosA = posA;
			memPosB = posB;
			printIntervalTag(memPosA,memPosB);
		}
		else{
		document.getElementById("newTagTest").innerHTML = "Ancre A = null & Ancre B = null. Erreur : Ancre A doit se situer avant Ancre B."
		}
		posA = 0;
		posB = 0;
	}
}


function sameVideoAnchor(srcPlayer){
	if(srcVideo != srcPlayer){
		srcVideo = srcPlayer;
		posA = 0;
		posB = 0;
		boolAnchor = 0;
	}
}	

function declareTag(){
	soundClick();
	var title = document.forms["modif_tag"].elements["title"].value;
	var descriptif = document.forms["modif_tag"].elements["descriptif"].value;
	var proba = document.forms["modif_tag"].elements["prob"].value;
	if((memPosB - memPosA) > 0)
		{
			if(title != ""){
				alert("Titre : " + 
					title + 
					"\n" + 
					"Descriptif : " + 
					descriptif + 
					"\n" + 
					"Probabilité : " + 
					proba + "% \n" + 
					"Ancre A : " + memPosA + 
					" sec \nAncre B : " + memPosB + " sec");
				memPosA = 0;
				memPosB = 0;
			}
		}
	else{
		alert("Il est nécessaire de déterminer le début (Ancre A) et la fin (Ancre B) de l'interval.");
	}
}

function printIntervalTag(init,end){
	document.getElementById("newTagTest").innerHTML = "Ancre A = " + init + " & Ancre B = " + end + ".";
}
	
function secToTime(intSec){
	var hour = (intSec/3600);
	hour = hour - hour % 1;
	var min = (intSec - (hour * 3600)) / 60;
	min = min - min % 1;
	var sec = intSec - (min * 60) - (hour * 3600);
	sec = sec - sec % 1;
	var timeIntSec = (""+hour+":"+min+":"+sec);
	return(timeIntSec);
}

function timeToSec(charTime){
	var secArray = charTime.split(':');
	var intSec = parseInt(secArray[0])*3600 + parseInt(secArray[1])*60 + parseInt(secArray[2]);
	return(intSec);
}