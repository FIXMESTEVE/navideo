
// ---------- GLOBAL VARIABLES ----------

var srcVideo;
var boolAnchor = 0;
var posA = 0;
var posB = 0;
var player;

// ---------- METHODS ----------

function hideMenu(button){
	var stateMenu = document.getElementsByTagName("HEADER")[0].style.display;
	if(stateMenu == "none"){
		document.getElementsByTagName("HEADER")[0].style.display = "block";
		button.textContent = "Cacher les menus";
	}
	else{
		document.getElementsByTagName("HEADER")[0].style.display = "none";
		button.textContent = "Afficher les menus";
	}
}
	
function anchorTag(button){
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
			newIntervalTag(posA,posB);
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
		posA = null;
		posB = null;
		boolAnchor = 0;
	}
}

function newIntervalTag(init,end){
	document.getElementById("newTagTest").innerHTML = "Ancre A = " + init + " & Ancre B = " + end + ".";
	//Mettre la vrai fonction de création du tag ultérieurement 
}


/*
function anchorTag(button){
	posA = 5;
	posB = 10;
	document.getElementById("newTagTest").innerHTML = "Ancre A et Ancre B sont dans une maison ouverte.";
}
*/




