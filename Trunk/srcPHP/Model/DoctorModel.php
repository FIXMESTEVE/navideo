<?php
//This file contains all methods executable by a doctor.

class DoctorModel extends Model{
	function getPatients($usernameDoctor){
		try {
			if(is_string($usernameDoctor)){
				$res = $this->executeSQL("SELECT \"idDoctor\" FROM \"public\".\"Doctor\" WHERE username = '".$usernameDoctor."';");
				if($row = pg_fetch_row($res)){
					$res = $this->executeSQL("SELECT \"idPatient\", \"name\" FROM \"public\".\"Patient\" WHERE \"public\".\"Patient\".\"idDoctor\" = "$row[0]";");
					if($row = pg_fetch_row($res)){
						return $row;
					}
					else
						throw new Exception("ERREUR - Fonction getPatients");
				}
				else
					throw new Exception("ERREUR - Fonction getPatients - usernameDoctor non trouve");
			}
			else
				throw new Exception("ERREUR - Fonction getPatients - Verifier les types des parametres");
		} catch(Exception $e){
			echo $e->getMessage();
		}
	}
}
?>