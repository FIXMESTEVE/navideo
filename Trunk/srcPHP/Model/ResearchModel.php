<?php
include_once "srcPHP/Model/Model.php";

class ResearchModel extends Model{

	function ResearchModel($host, $dbname, $log, $password){
		$this->Model($host, $dbname, $log, $password);
	}

	function getDoctor($login, $pwd){
		try{
			if(is_string($login) && is_string($pwd)){
				$res = $this->executeSQL("SELECT \"idDoctor\", \"name\" FROM \"public\".\"Doctor\" WHERE \"username\" = '".$login."' AND \"password\" = '".$pwd."';");
				if($row = pg_fetch_row($res))
					return array("id" => $row[0], "name" => $row[1]);
				else
					throw new Exception ("ERREUR - Fonction getDoctor(...) - Aucun Docteur avec cette Identifiant/Mot de passe");
			}
			else
				throw new Exception("ERREUR - Fonction getDoctor(...) - Verifier les types des parametres");
		} catch(Exception $e){
			echo $e->getMessage();
			return NULL;
		}
	}

	function getListOfPatients($id_doctor){
		try{
			if(is_numeric($id_doctor)){
				$res = $this->executeSQL("SELECT \"idPatient\", \"name\" FROM \"public\".\"Patient\" WHERE \"idDoctor\" = ".$id_doctor.";");
				if(pg_num_rows($res) > 0){
					$tmp = array();
					while($row = pg_fetch_row($res))
						array_push($tmp, $row[0]);
					return $tmp;
				}
				else
					throw new Exception ("ERREUR - Fonction getDoctor(...) - Aucun Patient lies a ce Docteur");
			}
			else
				throw new Exception("ERREUR - Fonction getListOfPatient(...) - Verifier les types des parametres");
		} catch(Exception $e){
			echo $e->getMessage();
			return NULL;
		}
	}
}

?>
