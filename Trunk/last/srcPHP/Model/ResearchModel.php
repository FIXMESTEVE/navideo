<?php
include_once "Model.php";

class ResearchModel extends Model{

	static function getDoctor($login, $pwd){
		try{
			if(is_string($login) && is_string($pwd)){
				$res = $this->executeSQL("SELECT \"$name\" FROM \"public\".\"Doctor\" WHERE \"username\" = ".$login." AND \"password\" = ".$pwd.";");
				if($row = pg_fetch_row($res))
					return $row[0];
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
}

?>
