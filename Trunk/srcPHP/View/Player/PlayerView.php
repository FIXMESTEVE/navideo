<?php
include_once "srcPHP/View/View.php";
include_once "srcPHP/View/Player/Tag/TagMenuView.php";
include_once "srcPHP/View/Player/Video/VideoView.php";

class PlayerView implements View{
	var $video = NULL;
	var $tags = NULL;
	var $start = NULL;
	var $id = NULL;

	function PlayerView($id=8, $start=0){
		try{
			if(is_numeric($id) && is_numeric($start)){
				$this->video = new VideoView($id);
				$this->tags = new TagMenuView($id);
				$this->start = $start;
				$this->id = $id;
			}
			else
				throw new Exception("ERREUR - Fonction PlayerView(...) - Verifier les types des parametres");
		}catch(Exception $e){
			echo $e->getMessage();
		}
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

	function onLoadJS(){ return "adaptCSSPlayer();onClickTag(".$this->start.");"; }

	function draw(){
		echo "<section id=\"player\">";
		$this->video->draw();
		$this->tags->draw();
		echo "</section>";
		echo "<button onclick=\"window.location.href='index.php?form=sendXML&video=".$this->id."';\">edit XML</button>";
	}
}
?>
