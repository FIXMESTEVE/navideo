

// ---------- GLOBAL VARIABLES ----------

soundManager.url = 'swf/';
var sonClic;

// ---------- METHODS ----------

soundManager.onload = function() {
	sonClic = soundManager.createSound(
	{
		id : "sonClic",
		url : "data/son.mp3"
	});
}

function soundClick(){
	sonClic.play();
}

function hideMenu(button){
	soundClick();
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
	



	



