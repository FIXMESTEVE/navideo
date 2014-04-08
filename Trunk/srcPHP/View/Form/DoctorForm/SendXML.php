<?php
/**
 *\file		SendXML.php
 *\author	Antoine Laumond, Romain Fontaine, Tom Solacroup, Xavier Jouvenot
 *\version	2.0
 *\date		08 Avril 2014
 *\brief	Defini le Formulaire gerant l'envoi de fichier XML.
 *
 *\details	Cette classe permet de r�cup�rer un fichier XML et de faire le lien entre les observations
 *			qui y sont d�taill�s et la video.
 */
include_once "srcPHP/View/Form/FormView.php";
include_once "srcPHP/Model/DoctorModel/DoctorModel.php";


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
			if(!empty($_FILES["file"]["name"])){
				/* Suppression des Tags d�j� existant*/
				$this->model->deleteMetadataOfVideo($this->video);
				$dom = new DomDocument();
				$dom->load($_FILES["file"]["tmp_name"]);
				$i = 0;
				/* Envoie des Tages dans la base de donn�es*/
				foreach($dom->getElementsByTagName("TITLE") as $titles){
					$title = $titles->firstChild->nodeValue;
					$obser = $dom->getElementsByTagName("OBSERVATION")->item($i)->firstChild->nodeValue;
					$start =  $dom->getElementsByTagName("START")->item($i)->firstChild->nodeValue;
					$end =  $dom->getElementsByTagName("END")->item($i)->firstChild->nodeValue;
					$proba = $dom->getElementsByTagName("PROBA")->item($i)->firstChild->nodeValue;

					$this->model->uploadMetadata($this->video, $title, $obser, $start, $end, $proba);

					$i++;
				}
			}
			else
				echo "Fail";
		}
	}

	function draw(){
		echo "<form id=\"sendXML\" action=\"".$this->action."?form=sendXML&video=".$this->video."&execute=true\" method=\"post\" enctype=\"multipart/form-data\">";
		echo "<label>Fichier XML a ajouter :</label>";
		echo "<input type='file' name='file' accept='text/xml'/>";
		echo "<input type=\"submit\" name=\"submit\" value=\"Envoyer\"/>";
		echo "</form>";
	}
}
?>
