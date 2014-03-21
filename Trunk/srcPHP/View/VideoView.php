<?php

class VideoView implements View{

	var $filename;

	function VideoView($filename="res/video.mp4"){
		try{
			if(is_string($filename))
				$this->filename = $filename;
			else
				throw new Exception("ERREUR - Fonction VideoView(...) - Verifier les types des parametres");
		} catch(Exception $e){
			$e->getMessage();
		}
	}

	function linkCSS(){ echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/video.css\">"; }

	function linkJS(){ }

	function onLoadJS(){ return ""; }

	function draw(){
		echo "<video controls=\"controls\"> <source src=\"".$this->filename."\">  </video>";
	}
}
?>
