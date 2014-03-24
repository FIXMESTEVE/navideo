<?php
include_once "srcPHP/Model/ResearchModel.php";
include_once "TagView.php";
include_once "srcPHP/View/View.php";

class TagMenuView implements View {

	var $model = NULL;
	var $tags = NULL;

	function TagMenuView($id_video=10) {
		try{
			if(!is_numeric($id_video))
				throw new Exception("TagMenuView(...) - Vérifiez le type des paramètres");

			$this->model = new ResearchModel("dbserver", "xjouveno", "xjouveno", "pdp");
			$this->tags  = array();

			/* Initialisation of list of tags */
			$tmp = $this->model->getListMetadata($id_video);
			for($i=0; $i<count($tmp); $i++)
				array_push($this->tags, new TagView($tmp[$i]["Id"], $tmp[$i]["Title"], $tmp[$i]["Observation"], $tmp[$i]["Start"], $tmp[$i]["End"]));
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function linkCSS(){
		echo "<link rel=\"stylesheet\" type=\"test/css\" href=\"css/tag_menu.css\">";
		$this->tags[0]->linkCSS();
	}

	function linkJS(){ $this->tags[0]->linkJS(); }

	function onLoadJS(){ return ""; }

	function draw() {
		echo "<section id=\"TagMenuView\">";
		echo "<ul type=none>";
		for($i=0; $i<count($this->tags); $i++)
			$this->tags[$i]->draw();
		echo "</ul>";
		echo "</section>";
	}

}
?>
