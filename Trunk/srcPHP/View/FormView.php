<?php
include_once "View.php";

abstract class FormView implements View{

	var $action = "";

	function FormView($action){
		if(is_string($action))
			$this->action = $action;
		else
			throw new Exception("ERREUR - FormView(...) - Verifier les types des parametres");
	}

	abstract function draw();
}
?>
