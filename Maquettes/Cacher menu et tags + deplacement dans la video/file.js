
function resizeTagsMenu(){
	var tmp = document.getElementById("vid").offsetHeight;
	document.getElementById("liste_etiquette").style.height = tmp+'px';
}

function displayLeftMenu(){
	document.getElementById("left_menu").style.display = "block";
	document.getElementById("player").style.width = "85%";
	resizeTagsMenu();
}

function hideLeftMenu(){
	document.getElementById('left_menu').style.display = "none";
	document.getElementById("player").style.width = "100%";
	resizeTagsMenu();
}

function clickButtonDisplayLeftMenu(button){
	var tmp = document.getElementById('left_menu').style.display;
	if(tmp == "none"){
		displayLeftMenu();
		button.textContent = "Cacher Menu";
	}
	else{
		hideLeftMenu();
		button.textContent = "Afficher Menu";
	}
}

function displayTagsMenu(){
	document.getElementById("liste_etiquette").style.display = "block";
	document.getElementById("vid").style.width = "80%";
	resizeTagsMenu();
}

function hideTagsMenu(){
	document.getElementById('liste_etiquette').style.display = "none";
	document.getElementById("vid").style.width = "100%";
	resizeTagsMenu();
}

function clickButtonDisplayTagsMenu(button){
  	var tmp = document.getElementById('liste_etiquette').style.display;
	if(tmp == "none"){
		displayTagsMenu();
		button.textContent = "Cacher Indexs";
	}
	else{
		hideTagsMenu();
		button.textContent = "Afficher Indexs";
	}
}