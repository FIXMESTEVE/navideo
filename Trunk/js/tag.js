function onMouseOver(button){
	button.style.background = 'white';
}

function onMouseOut(button){
	button.style.background = 'none';
}

function onClickTag(time){
	document.getElementsByTagName("VIDEO")[0].currentTime = time;
}
