<?php
/**
 * TagView.php
 *
 * Long description for file (if any)...
 *
 * @author
 * @copyright  2014
 */

include_once "View.php";

/**
 * TagView
 *
 * Long description for class (if any)...
 *
 */
class TagView implements View{

	/* Identification */
	var $id;

	/* Data */
	var $title;
	var $observation;
	var $start;
	var $end;

	function TagView($id, $title, $observation, $start, $end){
		try{
			if(is_numeric($id) && is_string($title) && is_string($observation) && is_string($start) && is_string($end)){
				$this->id = $id;
				$this->title = $title;
				$this->observation = $observation;
				$this->start = $start;
				$this->end  = $end;
			}
			else
				throw new Exception("ERREUR - TagView(...) - Verifier les types des parametres");
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function linkCSS(){ }

	function draw(){
		echo "<li>".$this->observation."</li>";
	}

}
?>
