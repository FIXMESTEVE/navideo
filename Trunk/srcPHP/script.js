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
	
