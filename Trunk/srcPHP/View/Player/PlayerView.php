<?php
include_once "srcPHP/View/View.php";
include_once "srcPHP/View/Player/Tag/TagMenuView.php";
include_once "srcPHP/View/Player/Video/VideoView.php";

class PlayerView implements View{
	var $video;
	var $tags;

	function PlayerView($filename){
		$this->video = new VideoView();
		$this->tags = new TagMenuView();
	}

	function linkCSS(){
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/player.css\">";
		$this->video->linkCSS();
		$this->tags->linkCSS();
	}

	function linkJS(){
		$this->video->linkJS();
		$this->tags->linkJS();
		echo "<script src=\"js/player.js\"> </script>";
	}

	function onLoadJS(){ return "adaptCSSPlayer();"; }

	function draw(){
		echo "<section id=\"player\">";
		$this->video->draw();
		$this->tags->draw();
		echo "</section>";
	}
}
?>
