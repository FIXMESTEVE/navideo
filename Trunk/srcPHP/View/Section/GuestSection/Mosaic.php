<?php
include_once "srcPHP/View/View.php";
include_once "srcPHP/Model/ResearchModel.php";

class Mosaic implements View{

	var $model = NULL;
	var $array = NULL;

	function Mosaic(){
		$this->model = new ResearchModel("dbserver", "xjouveno", "xjouveno", "pdp");
		$this->array = $this->model->getAllVideo();
	}

	function linkCSS(){ echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mosaic.css\">"; }

	function linkJS(){ }

	function onLoadJS(){ }

	function draw(){
		echo "<section>";
		echo "<ul class=\"patients\">";
			echo $tmp = NULL;
			for($i=0; $i<count($this->array); $i++){
				// Patient suivant
				if($tmp != $this->array[$i]["IdPatient"]){
					$tmp = $this->array[$i]["IdPatient"];
					if($i != 0){
						echo "</ul>";
						echo "</li>";
					}
					echo "<li>";
					echo "<h3>".$this->array[$i]["Name"]." - ".$this->array[$i]["IdPatient"]."</h3>";
					echo "<ul class=\"videos\">";
				}
				//Video Suivante
				echo "<li class=\"video\">";
				echo "<a href=\"index.php?play=".$this->array[$i]["IdVideo"]."\" ><img src=\"data/video.png\" /></a>";
				echo "</li>";
			}
		echo "</ul>";
		echo "</section>";
	}

}

?>
