<?php
include_once("srcPHP/View/View.php");
include_once("srcPHP/View/Player/Tag/TagView.php");
include_once("srcPHP/Model/ResearchModel.php");

class TagMenuView implements View
{
	private $model = null;
	private $tags  = null;

	function TagMenuView($videoId=-1) {
		assert(is_numeric($videoId), get_class($this).'::'.__FUNCTION__.'($videoId) - Le paramètre doit être un entier.');
		
		$this->model = new ResearchModel("dbserver", "xjouveno", "xjouveno", "pdp");
		$this->tags  = array();
		
		// Initialize the array of tags
		if($videoId < 0)
			return;
		
		$allMetadatas = $this->model->getListMetadata($videoId);
		
		if(is_null($allMetadatas))
			return;
		
		foreach($allMetadatas as $metadata)
		{
			$id           = $metadata['idMetadata'];
			$title        = $metadata['title'];
			$observation  = $metadata['observation'];
			$start        = $metadata['start'];
			$end          = $metadata['end'];
			
			$this->tags[] = new TagView($id, $title, $observation, $start, $end);
		}
	}

	function linkCSS(){
		$webroot = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
		$webroot = str_replace(basename($webroot).'/', '', $webroot);
		$webroot = str_replace(basename($webroot).'/', '', $webroot);
		
		echo '<link rel="stylesheet" type="text/css" href="'.$webroot.'css/tag_menu.css">';
		if(!empty($this->tags)) $this->tags[0]->linkCSS();
	}

	function linkJS(){
		$webroot = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
		$webroot = str_replace(basename($webroot).'/', '', $webroot);
		$webroot = str_replace(basename($webroot).'/', '', $webroot);
		
		echo '<script type="text/javascript" src="'.$webroot.'js/tag_menu_sorting_script.js"></script>';
		if(!empty($this->tags)) $this->tags[0]->linkJS();
	}

	function onLoadJS(){ return ""; }
	
	function countNumberOfTags() { return count($this->tags); }

	function draw() {
		echo '<section id="TagMenuView">';
		echo '<table class="buttons">';
		echo '<tr>';
		echo '<td><input type="button" name="by_id" value="Défaut" disabled="true"></td>';
		echo '<td><input type="button" name="by_title" value="Titres"></td>';
		echo '<td><input type="button" name="by_observation" value="Observation"></td>';
		echo '</tr>';
		echo '</table>';
		echo '<table class="tags">';//'<ul type="none">';
		foreach($this->tags as $tag)
			$tag->draw();
		echo '</table>';//'</ul>';
		echo '</section>';
	}

}
?>
