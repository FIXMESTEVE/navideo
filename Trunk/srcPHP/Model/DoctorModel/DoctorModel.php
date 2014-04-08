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

	function deleteMetadataOfVideo($id_video){
		try{
			if(is_numeric($id_video))
				$this->executeSQL("DELETE FROM \"public\".\"Tagger\" WHERE \"idVideo\" = ".$id_video." ;");
			else
				throw new Exception("ERREUR - Fonction deleteMetadataOfVideo(...) - Verifier les types des parametres");
		} catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function uploadMetadata($id_video, $title, $observation, $start, $end, $proba){
		try{
			if(is_numeric($id_video) && is_string($title) && is_string($observation)){
				$res = $this->executeSQL("SELECT \"idMetadata\" FROM \"public\".\"Metadata\" WHERE \"title\" = '".$title."'; ");
				if(pg_num_rows($res) == 0){
					$this->executeSQL("INSERT INTO \"public\".\"Metadata\" (\"title\", \"observation\", \"Probability\") VALUES ('".$title."', '".$observation."', ".$proba.");");
					$res = $this->executeSQL("SELECT \"idMetadata\" FROM \"public\".\"Metadata\" WHERE \"title\" = '".$title."'; ");
				}

				if($row = pg_fetch_row($res))
					$this->executeSQL("INSERT INTO \"public\".\"Tagger\" (\"idMetadata\", \"idVideo\", \"start\", \"end\") VALUES (".$row[0].", ".$id_video.", '".$start."', '".$end."');");
				else
					throw new Exception("ERREUR - Fonction uploadMetadata(...) - Metadonnee impossible a trouver");
			}
			else
				throw new Exception("ERREUR - Fonction uploadMetadata(...) - Verifier les types des parametres");
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

}
?>
