<?php
include_once "Model.php";

class UploadModel extends Model{

	function UploadModel($host, $dbname, $log, $password){
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

	function addPatient($nomPatient){
		$path = "data/".$nomPatient;
		try {
			if(is_string($nomPatient)){
				$this->executeSQL("INSERT INTO \"public\".\"Patient\" (\"name\") VALUES ('".$nomPatient."');");
				$res = $this->executeSQL("SELECT MAX(\"idPatient\") FROM \"public\".\"Patient\" WHERE name = '".$nomPatient."';");
				if($row = pg_fetch_row($res)){
					$path = $path.$row[0];
					if(!mkdir($path, 0777, true))
						throw new Exception("ERREUR - Fonction addPatient(...) - creation du repertoire impossible");
				}
				else
					throw new Exception("ERREUR - Fonction addPatient(...) - nouveau patient non trouve");
			}
			else
				throw new Exception("ERREUR - Fonction addPatient(...) - Verifier les types des parametres");
		} catch(Exception $e){
			echo $e->getMessage();
			if(is_dir($path))
				rmdir($path);
		}
	}

	function deleteAllPatient($id_doctor){
		try{
			if(is_numeric($id_doctor))
				$this->executeSQL("DELETE FROM \"public\".\"Suivre\" WHERE \"idDoctor\" = ".$id_doctor." ;");
			else
				throw new Exception("ERREUR - Fonction deleteAllPatient(...) - Verifier les types des parametres");
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function linkPatient($id_doctor, $id_patient){
		try{
			if(is_numeric($id_doctor) && is_numeric($id_patient))
				$this->executeSQL("INSERT INTO \"public\".\"Suivre\" (\"idDoctor\", \"idPatient\") VALUES (".$id_doctor.", ".$id_patient.");");
			else
				throw new Exception("ERREUR - Fonction linkPatient(...) - Verifier les types des parametres");
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function updateListPatient($id_doctor, $patients){
		try{
			if(is_numeric($id_doctor) && is_array($patients)){
				$this->deleteAllPatient($id_doctor);
				for($i=0; $i<count($patients); $i++)
					$this->linkPatient($id_doctor, $patients[$i]);
			}
			else
				throw new Exception("ERREUR - Fonction updateListPatient(...) - Verifier les types des parametres");
		} catch(Exception $e){
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
