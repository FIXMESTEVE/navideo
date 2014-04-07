<?php

class AddTag{
	function draw(){
		echo "<script type=\"text/javascript\" src=\"js/addTag.js\"></script>";	
		echo "<div id=\"newTagTest\">";
		echo "Ancre A = null & Ancre B = null";
		echo "</div>";
		echo "<button onClick=\"hideMenu(this);\">Cacher les menus</button>";
		echo "<button onClick=\"anchorTag(this);\">Etiquettage A->B</button>";
	}
}
?>