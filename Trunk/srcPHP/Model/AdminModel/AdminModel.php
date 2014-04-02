<?php
include_once "srcPHP/Model/Model.php";

class AdminModel extends Model{

	function AdminModel($host, $dbname, $log, $password){
		$this->Model($host, $dbname, $log, $password);
	}

	function addDoctor($name, $username, $password){
		try {
			if(is_string($name) && is_string($username) && is_string($password))
				$this->executeSQL("INSERT INTO \"public\".\"Doctor\" (\"name\", \"username\", \"password\") VALUES ('".$name."', '".$username."', '".$password."');");
			else
				throw new Exception("ERREUR - Fonction addDoctor - Verifier les types des parametres");
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function addVideo($idPatient, $filename, $path){
		try{
			if(is_string($filename) && is_int($idPatient)){
				/* Verification de l'existance de l'identifiant du patient */
				$res = $this->executeSQL("SELECT \"idPatient\" FROM \"public\".\"Patient\" WHERE \"idPatient\" = '".$idPatient."';");
				if($row = pg_fetch_row($res))
					$res = $this->executeSQL("INSERT INTO \"public\".\"Video\" (\"idPatient\", \"filename\") VALUES ('".$row[0]."', '".$filename."');", "ERREUR - Fonction addVideo - filename deja existant");
				else
					throw new Exception("ERREUR - Fonction addVideo - idPatient non trouve");
			}
			else
				throw new Exception("ERREUR - Fonction addVideo - Verifier les types des parametres");
		} catch(Exception $e){
			echo $e->getMessage();
		}

		/* copier le fichier video sur le serveur */
	}
}
?>
