<?php
include_once "Model.php";

class UploadModel extends Model{

	function UploadModel($host, $dbname, $log, $password){
		$this->Model($host, $dbname, $log, $password);
	}

	function addDoctor($name, $username, $password){
		try {
			if(is_string($name) && is_string($username) && is_string($password)){
				$this->executeSQL("INSERT INTO \"public\".\"Doctor\" (\"name\", \"username\", \"password\") VALUES ('".$name."', '".$username."', '".$password."');");
			}
			else
				throw new Exception("ERREUR - Fonction addDoctor - Verifier les types des parametres");
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function addPatient($nomPatient, $usernameDoctor){
		$path = "data/".$nomPatient;
		try {
			if(is_string($nomPatient) && is_string($usernameDoctor)){
				$res = $this->executeSQL("SELECT \"idDoctor\" FROM \"public\".\"Doctor\" WHERE username = '".$usernameDoctor."';");
				if($row = pg_fetch_row($res)){
					$this->executeSQL("INSERT INTO \"public\".\"Patient\" (\"name\", \"idDoctor\") VALUES ('".$nomPatient."', ".$row[0].");");
					$res = $this->executeSQL("SELECT MAX(\"idPatient\") FROM \"public\".\"Patient\" WHERE name = '".$nomPatient."';");
					if($row = pg_fetch_row($res)){
						$path = $path.$row[0];
						if(!mkdir($path, 0777, true))
							throw new Exception("ERREUR - Fonction addPatient - creation du repertoire impossible");
					}
					else
						throw new Exception("ERREUR - Fonction addPatient - nouveau patient non trouve");
				}
				else
					throw new Exception("ERREUR - Fonction addPatient - usernameDoctor non trouve");
			}
			else
				throw new Exception("ERREUR - Fonction addPatient - Verifier les types des parametres");
		} catch(Exception $e){
			echo $e->getMessage();
			if(is_dir($path))
				rmdir($path);
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