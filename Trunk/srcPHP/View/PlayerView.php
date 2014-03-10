<?php
include_once "View.php";
include_once "TagMenuView.php";
include_once "VideoView.php";

class PlayerView implements View{
	var $video;
	var $tags;

	function PlayerView(){
		$this->video = new VideoView();
		$this->tags = new TagMenuView();
	}

	function linkCSS(){ }

	function draw(){
		echo "<section id=\"player\">";
		$this->video->draw();
		$this->tags->draw();
		echo "</section>";
	}
}
?>
