<?php

class DatabaseManager{
	var $host = "";
	var $dbname = "";
	var $log = "";
	var $password = "";
	var $connec = "";

	function connectDatabase(){
		$this->connec = pg_connect("host=".$this->host." dbname=".$this->dbname." user=".$this->log." password=".$this->password);
		if(!$this->connec)
			throw new Exception("ERREUR - Fonction connectDatabase() - Impossible de se connecter a la base de donnees");
	}

	function deconnectDatabase(){
		pg_close($this->connec);
	}

	function DatabaseManager($host, $dbname, $log, $password){
		try {
			// Recuperation des parametres
			if(is_string($host) && is_string($dbname) && is_string($log) && is_string($password)){
				$this->host = $host;
				$this->dbname = $dbname;
				$this->log = $log;
				$this->password = $password;
			}
			else
				throw new Exception("ERREUR - Fonction DatabaseManager(...) - Verifier les types des parametres");
			// Test de la bonne connection a la base de donnees
			$this->connectDatabase();
			$this->deconnectDatabase();

		} catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function query($sql, $messageError="ERREUR - Fonction query(...) - Echec lors de l'interrogation de la base de donnees"){
		$res = NULL;
		try {
			if(is_string($sql) && is_string($messageError)){
				$this->connectDatabase();
				$res = pg_query($this->connec, $sql);
				if(!$res)
					throw new Exception($messageError);
			}
			else
				throw new Exception("ERREUR - Fonction Model(...) - Verifier les types des parametres");
		} catch(Exception $e){
			echo $e->getMessage();
		} finally {
			$this->deconnectDatabase();
			return $res;
		}
	}
}

?>
