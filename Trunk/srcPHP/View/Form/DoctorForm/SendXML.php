<?php
include_once "srcPHP/View/Form/FormView.php";

class SendXML extends FormView{

	function SendXML($action){
		try{
			parent::FormView($action);
		} catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function linkCSS(){ }

	function linkJS(){ }

	function onLoadJS(){ }

	function execute(){ }

	function draw(){
		echo "<h1>En Cours</h1>";
		echo "<form id=\"sendXML\" action=\"".$this->action."?form=sendXML&execute=true\" method=\"post\">";
		echo "<input type=\"submit\" value=\"Envoyer\">";
		echo "</form>";
	}
}
?>
