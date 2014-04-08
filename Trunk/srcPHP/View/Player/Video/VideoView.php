<?php
include_once "srcPHP/View/View.php";
include_once "srcPHP/Model/ResearchModel.php";


class VideoView implements View{

	var $filename;

	function VideoView($id){
		try{
			if(is_numeric($id)){
				$tmp = new ResearchModel("dbserver", "xjouveno", "xjouveno", "pdp");
				$this->filename = $tmp->getFilenameVideo($id);
			}
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
		echo "<video id=\"myvideo\" controls=\"controls\"> <source src=\"modules/jQuery-File-Upload/server/php/files/".$this->filename."\">  </video>";
	}
}
?>
