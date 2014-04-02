<?php
include_once "srcPHP/Model/Model.php";

class DoctorModel extends Model{

	function DoctorModel($host, $dbname, $log, $password){
		$this->Model($host, $dbname, $log, $password);
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

}
?>
