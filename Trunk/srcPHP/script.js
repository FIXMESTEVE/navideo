function hideMenu(button){
	var stateMenuGuest = document.getElementById("menuGuest").style.display;
	//var stateMenuConnexion = document.getElementById("connexion").style.display;
	if(stateMenuGuest == "none"){
		document.getElementById("menuGuest").style.display = "block";
		//document.getElementById("connexion").style.display = "block";
		button.textContent = "Cacher les menus";
	}
	else{
		document.getElementById("menuGuest").style.display = "none";
		//document.getElementById("connexion").style.display = "none";
		button.textContent = "Afficher les menus";
	}
}
	