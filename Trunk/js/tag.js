function onMouseOver(button){
	button.style.background = 'white';
}

function onMouseOut(button){
	button.style.background = 'none';
}

function onClickTag(time){
	document.getElementsByTagName("VIDEO")[0].currentTime = time;
}

function onClickTagName(classname){
	var tags = document.getElementsByClassName(classname);
	for(var i = 0; i < tags.length; i++){
		var e = tags[i];
		if(e.style.display == 'none')
			e.style.display = 'block';
		else
			e.style.display = 'none';
	}
}
