<?php

class AddTag{
	function draw(){
		echo "<script type=\"text/javascript\" src=\"js/addTag.js\"></script>";	
		
		echo "<div id=\"modifTag\">";
		
		echo "<div id=\"newTagTest\">";
		echo "Ancre A = null & Ancre B = null";
		echo "</div>";
		echo "<button onClick=\"anchorTag(this);\">Etiquettage A->B</button>";
		echo "<br>";
		
		echo "<form name=\"modif_tag\">";
		echo "<fieldset>";
		echo "<legend>Ajout d'étiquette</legend>";
		
		echo "<label for=\"title\">Titre de l'étiquette</label> :"; 
		echo "<input type=\"text\" name=\"title\" id=\"title\" required />";
		echo "<br>";

		echo "<label for=\"descriptif\">Descriptif de l'étiquette</label> : <br />";
		echo "<textarea name=\"descriptif\" id=\"descriptif\"></textarea>";
		echo "<br>";

		echo "<label for=\"prob\">Probabilité (0%-100%)</label> :";
		echo "<input type=\"range\" min=0 max=100 step=1 name=\"prob\" id=\"prob\"/>";
		echo "<br>";

		echo "<button onClick=\"declareTag();\">Valider</button>";

		echo "</fieldset>";
		echo "</form>";
		echo "</div>";
	
	
	}
}
?>