<?php
include_once "srcPHP/Model/ResearchModel.php";
include_once "TagView.php";
include_once "srcPHP/View/View.php";

class TagMenuView implements View {

	var $model = NULL;
	var $tagsByTime = NULL;
	var $tagsByTitle = NULL;

	function TagMenuView($id_video=10) {
		try{
			if(!is_numeric($id_video))
				throw new Exception("TagMenuView(...) - Vérifiez le type des paramètres");

			$this->model = new ResearchModel("dbserver", "xjouveno", "xjouveno", "pdp");
			$this->tagsByTime = array();
			$this->tagsByTitle = array();

			/* Initialisation of list of tags */
			$tmp = $this->model->getListMetadataByTime($id_video);
			for($i=0; $i<count($tmp); $i++)
				array_push($this->tagsByTime, new TagView($tmp[$i]["Id"], $tmp[$i]["Title"], $tmp[$i]["Observation"], $tmp[$i]["Start"], $tmp[$i]["End"]));

			$tmp = $this->model->getListMetadataByTitle($id_video);
			for($i=0; $i<count($tmp); $i++)
				array_push($this->tagsByTitle, new TagView($tmp[$i]["Id"], $tmp[$i]["Title"], $tmp[$i]["Observation"], $tmp[$i]["Start"], $tmp[$i]["End"]));

		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function linkCSS(){
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"css/tag_menu.css\">";
		$this->tagsByTime[0]->linkCSS();
	}

	function linkJS(){
		$this->tagsByTime[0]->linkJS();
		echo "<script src=\"js/tag_menu.js\"></script>";
	}

	function onLoadJS(){ return ""; }

	function drawTagsByTime(){
		for($i=0; $i<count($this->tagsByTime); $i++)
			$this->tagsByTime[$i]->drawTemporality();
	}

	function drawTagsByTitle(){
		for($i=0; $i<count($this->tagsByTitle); $i++){
			if(!$this->tagsByTitle[$i]->isSameTag($this->tagsByTitle[$i+1]))
				$this->tagsByTitle[$i]->drawTemporality();
			else{
				$this->tagsByTitle[$i]->drawTagName();
				echo "<ul type=none>";
				$this->tagsByTitle[$i]->drawTime();
				for($j=$i+1; $this->tagsByTitle[$i]->isSameTag($this->tagsByTitle[$j]) && $j<count($this->tagsByTitle); $j++)
					$this->tagsByTitle[$j]->drawTime();
				echo "</ul>";
				$i = $j-1;
			}
		}
	}

	function draw() {
		echo "<section id=\"TagMenuView\">";
		echo "<table>";
		echo "<tr id=\"title\" >";
		echo "<th onmouseover=\"onMouseOver(this);\" onmouseout=\"onMouseOut(this);\" onclick=\"getTagsOnTime();\">Temporelle</th>";
		echo "<th onmouseover=\"onMouseOver(this);\" onmouseout=\"onMouseOut(this);\" onclick=\"getTagsOnTitle();\">Alphabetique</th>";
		echo "</tr>";
		echo "<tr><th colspan=2>";
		echo "<ul id=\"tagsByTime\">";
		$this->drawTagsByTime();
		echo "</ul>";
		echo "<ul id=\"tagsByTitle\">";
		$this->drawTagsByTitle();
		echo "</ul>";
		echo "</th></tr>";
		echo "</table>";
		echo "</section>";
	}

}
?>
