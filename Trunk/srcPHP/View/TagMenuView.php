<?php
/**
 * TagMenuView.php
 *
 * Long description for file (if any)...
 *
 * @author
 * @copyright  2014
 */

include_once "srcPHP/Model/ResearchModel.php";
include_once "TagView.php";
include_once "View.php";

/**
 * TagMenuView
 *
 * Long description for class (if any)...
 *
 */
class TagMenuView implements View {

	var $model = NULL;
	var $tags = NULL;

	function TagMenuView($id_video=8) {
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

	function linkCSS(){ }

	function draw() {
		echo "<div class=\"TagMenuView\">";
		echo "<ul type=none>";
		for($i=0; $i<count($this->tags); $i++)
			$this->tags[$i]->draw();
		echo "</ul>";
		echo "</div>";
	}

}
?>
