<?php
include_once "srcPHP/View/Form/FormView.php";

class SendXML extends FormView{

	var $video = NULL;
	var $model = NULL;

	function SendXML($action){
		try{
			parent::FormView($action);
			if(isset($_GET) && isset($_GET["form"]) && $_GET["form"] === "sendXML" && isset($_GET["video"])){
				$this->video = $_GET["video"];
				$this->model = new DoctorModel("dbserver", "xjouveno", "xjouveno", "pdp");
				$this->execute();
			}
			else
				throw new Exception("ERREUR - SendXML(...) - Verifier les parametres dans l'url");
		} catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function linkCSS(){ }

	function linkJS(){ }

	function onLoadJS(){ }

	function execute(){
			if(isset($_GET) && isset($_GET["form"]) && $_GET["form"] === "sendXML" && isset($_GET["video"]) && isset($_GET["execute"]) && $_GET["execute"] === "true"){
				if(isset($_POST) && isset($_POST["xml_file"]) && !empty($_POST["xml_file"])){

				}
			}
	}

	function draw(){
		echo "<form id=\"sendXML\" action=\"".$this->action."?form=sendXML&video=".$this->video."&execute=true\" method=\"post\">";
		echo "<label>Fichier XML a ajouter :</label><input type=\"file\" name=\"xml_file\"/>";
		echo "<input type=\"submit\" value=\"Envoyer\">";
		echo "</form>";
	}
}
?>
