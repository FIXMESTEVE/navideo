<?php
/**
 *\file		AddDoctor.php
 *\author	Antoine Laumond, Romain Fontaine, Tom Solacroup, Xavier Jouvenot
 *\version	2.0
 *\date		08 Avril 2014
 *\brief	Defini le Formulaire gerant l'ajout d'un nouveau docteur
 *
 *\details	Cette classe permet à un utilisateur de creer un nouveau compte de Medecin,
 *			qu'il pourra par la suite le réutiliser
 */
include_once "srcPHP/View/Form/FormView.php";
include_once "srcPHP/Model/AdminModel/AdminModel.php";


class AddDoctor extends FormView{
	/* Variable */
	var $model = NULL;

	function AddDoctor($action){
		parent::FormView($action);
		$this->model = new AdminModel("dbserver", "xjouveno", "xjouveno", "pdp");
		$this->execute();
	}

	function linkCSS(){ echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/add_doctor.css\">"; }

	function linkJS(){ }

	function onLoadJS(){ return ""; }

	function execute(){
		if(isset($_GET) && isset($_GET["execute"]) && $_GET["execute"] === "true")
			if(isset($_POST) && isset($_POST["NameDoctor"]) && !empty($_POST["NameDoctor"]) && isset($_POST["LoginDoctor"]) && !empty($_POST["LoginDoctor"]) && isset($_POST["PasswordDoctor"]) && !empty($_POST["PasswordDoctor"]))
				$this->model->addDoctor($_POST["NameDoctor"], $_POST["LoginDoctor"], $_POST["PasswordDoctor"]);
	}

	function draw(){
		echo "<form id=\"add_doctor\" action=\"".$this->action."?form=add_doctor&execute=true\" method=\"post\">";
		echo "<label>Nom : </label><input type=\"text\" name=\"NameDoctor\"/>";
		echo "<label>Identifiant : </label><input type=\"text\" name=\"LoginDoctor\"/>";
		echo "<label>Mot de passe : </label><input type=\"password\" name=\"PasswordDoctor\"/>";
		echo "<input type=\"submit\" value=\"Ajouter\">";
		echo "</form>";
	}
}

?>
