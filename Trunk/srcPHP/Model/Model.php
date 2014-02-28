<?php

include_once "DatabaseManager.php";

class Model{
	var $dbManager;

	function Model($host, $dbname, $log, $password){
		$this->dbManager = new DatabaseManager($host, $dbname, $log, $password);
	}

	function executeSQL($sql, $messageError=NULL){
		if(is_null($messageError))
			return $this->dbManager->query($sql);
		else
			return $this->dbManager->query($sql, $messageError);
	}
}
?>
