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
//			echo $e->getMessage();
			return false;
		}
	}

	function getAdministrator($login, $pwd){
		try{
			if(is_string($login) && is_string($pwd)){
				$res = $this->executeSQL("SELECT \"idAdmin\" FROM \"public\".\"Admin\" WHERE \"username\" = '".$login."' AND \"password\" = '".$pwd."';");
				if($row = pg_fetch_row($res))
					return $row[0];
				else
					throw new Exception ("ERREUR - Fonction getAdmin(...) - Aucun Docteur avec cette Identifiant/Mot de passe");
			}
			else
				throw new Exception("ERREUR - Fonction getAdmin(...) - Verifier les types des parametres");
		} catch(Exception $e){
//			echo $e->getMessage();
			return false;
		}
	}

	function getListOfPatients($id_doctor){
		try{
			if(is_numeric($id_doctor)){
				$res = $this->executeSQL("SELECT \"Patient\".\"idPatient\", \"name\" FROM \"public\".\"Suivre\" INNER JOIN \"Patient\" ON \"Suivre\".\"idPatient\" = \"Patient\".\"idPatient\" WHERE \"Suivre\".\"idDoctor\" = ".$id_doctor.";");
				if(pg_num_rows($res) > 0){
					$tmp = array();
					while($row = pg_fetch_row($res))
						array_push($tmp, array("Id" => $row[0], "Name" => $row[1]));
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

	function getListOfNotPatients($id_doctor){
		try{
			if(is_numeric($id_doctor)){
				$res = $this->executeSQL("SELECT \"idPatient\", \"name\" FROM \"public\".\"Patient\" WHERE \"idPatient\" NOT IN (SELECT \"idPatient\" FROM \"public\".\"Suivre\" WHERE \"idDoctor\" = ".$id_doctor.");");
				if(pg_num_rows($res) > 0){
					$tmp = array();
					while($row = pg_fetch_row($res))
						array_push($tmp, array("Id" => $row[0], "Name" => $row[1]));
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

	/**
	 * Find all metadatas matching with video id.
	 * @param $videoId this is the id of the video
	 * @return an array of metadatas (sorted by ids) or NULL no metadata found
	 */
	function getListMetadata($videoId) {
		assert(is_numeric($videoId), get_class($this).'::'.__FUNCTION__.'($videoId) - Le paramètre doit être un entier.');
		
		$queryMetadata = "SELECT * FROM \"public\".\"Metadata\" WHERE \"idVideo\" = ".$videoId." ORDER BY \"idVideo\";";
		
		try
		{
			$resultQuery       = $this->executeSQL($queryMetadata);
			$matchingMetadatas = pg_fetch_all($resultQuery);
			
			if($matchingMetadatas === false)
				return null;
			
			$allMetadatas = array();
			
			foreach($matchingMetadatas as $metadata)
			{
				$queryTagger    = "SELECT \"start\", \"end\" FROM \"public\".\"Tagger\" WHERE \"idMetadata\" = ".$metadata['idMetadata']." AND \"idVideo\" = ".$metadata['idVideo'].";";
				$resultQuery    = $this->executeSQL($queryTagger);
				$matchingTagger = pg_fetch_assoc($resultQuery);
				
				$start = "00:00:00";
				$end   = "00:00:00";
				
				if($matchingTagger !== false)
				{
					$start = $matchingTagger['start'];
					$end   = $matchingTagger['end'];
				}
				
				$metadata['start'] = $start;
				$metadata['end']   = $end;
				
				$allMetadatas[] = $metadata;
			}
			
			return $allMetadatas;
		}
		catch(Exception $ex)
		{
			echo $ex->getMessage();
		}
		
		return null;
	}

	function getVideosPatient($id_patient){
		try{
			if(is_numeric($id_patient)){
				$res = $this->executeSQL("SELECT \"idVideo\", \"filename\", \"title\" FROM \"public\".\"Video\" WHERE \"idPatient\" = ".$id_patient.";");
				if(pg_num_rows($res) > 0){
					$tmp = array();
					while($row = pg_fetch_row($res))
						array_push($tmp, array("Id" => $row[0], "Filename" => $row[1], "Title" => $row[2]));
					return $tmp;
				}
				else{
					return array();
//					throw new Exception("ERREUR - Fonction getVideosPatient(...) - Aucune video liee a ce Patient");
				}
			}
			else
				throw new Exception("ERREUR - Fonction getVideosPatient(...) - Verifier les types des parametres");
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	
	/**
	 * Find all videos matching with metadatas depending on arguments.
	 * @param $argumentsArray this is an array of all arguments
	 *      example of an argument : array( "title" => "a title", "observation" => "an observation" )
	 * @return an array of videos (sorted by ids) or NULL no video found
	 *	example of a video : array( "idVideo" => 0, "idPatient" => 0, "filename" => "path", "title" => "a title" )
	 */
	function findAllVideosMatchingMetadatasArguments($argumentsArray) {
		assert(is_array($argumentsArray), get_class($this).'::'.__FUNCTION__.'($argumentsArray) - Le paramètre n\'est pas correct.');
		
		// Step 1 : find the metadatas
		$allMetadataVideoIds = array();
		
		foreach($argumentsArray as $argument)
		{
			$metadataTitle       = isset($argument['title']) ? addslashes($argument['title']) : null;
			$metadataObservation = isset($argument['observation']) ? addslashes($argument['observation']) : null;
			
			assert(!is_null($metadataTitle) || !is_null($metadataObservation), ResearchModel::class.'::'.__FUNCTION__.'($argumentsArray) - Un argument n\'est pas correct.');
			
			$query = "SELECT \"idVideo\" FROM \"public\".\"Metadata\" JOIN \"Tagger\" ON \"Tagger\".\"idMetadata\" = \"Metadata\".\"idMetadata\" WHERE \"title\" = '".$metadataTitle."' OR \"observation\" = '".$metadataObservation."' ORDER BY \"idVideo\";";

			try
			{
				$resultQuery    = $this->executeSQL($query);
				$allMatchingIds = pg_fetch_all_columns($resultQuery);
				
				if($allMatchingIds !== false)
				{
					foreach($allMatchingIds as $matchingId)
						if(!in_array((int) $matchingId, $allMetadataVideoIds))
							$allMetadataVideoIds[] = (int) $matchingId;
				}
			}
			catch(Exception $ex)
			{
				echo $ex->getMessage();
			}
		}
		
		// Step 2 : find the videos
		if(empty($allMetadataVideoIds))
			return null;
		
		$allVideos = array();
		
		foreach($allMetadataVideoIds as $videoId)
		{
			$query = "SELECT \"idVideo\",\"idPatient\",\"filename\",\"title\" FROM \"public\".\"Video\" WHERE \"idVideo\" = ".$videoId.";";
			
			try
			{
				$resultQuery   = $this->executeSQL($query);
				$matchingVideo = pg_fetch_assoc($resultQuery);
				
				if($matchingVideo === false)
					throw new Exception(ResearchModel::class.'::'.__FUNCTION__.'($argumentsArray) - Aucune vidéo ne correspond à l\'identifiant '.$videoId.'.');
				
				$allVideos[] = $matchingVideo;
			}
			catch(Exception $ex)
			{
				echo $ex->getMessage();
			}
		}
		
		if(empty($allVideos))
			return null;
		
		return $allVideos;
	}
	
	function getAllVideo(){
		try
		{
			$res = $this->executeSQL("SELECT \"Video\".\"title\", \"Video\".\"idVideo\", \"Patient\".\"idPatient\", \"Patient\".\"name\" FROM \"public\".\"Video\" JOIN \"Patient\" ON \"Patient\".\"idPatient\" = \"Video\".\"idPatient\" ORDER BY \"Patient\".\"idPatient\", \"Patient\".\"name\", \"Video\".\"title\" ;");
			$tmp = array();
			while($row = pg_fetch_row($res))
				array_push($tmp, array("Title" => $row[0], "IdVideo" => $row[1], "IdPatient" => $row[2], "Name" => $row[3]));
			return $tmp;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function getListMetadataByTime($id_video){
		try
		{
			if(is_numeric($id_video))
			{
				$res = $this->executeSQL("SELECT \"Tagger\".\"idMetadata\", \"Metadata\".\"title\", \"Metadata\".\"observation\", \"Tagger\".\"start\", \"Tagger\".\"end\" FROM \"public\".\"Metadata\" INNER JOIN \"Tagger\" ON \"Tagger\".\"idMetadata\" = \"Metadata\".\"idMetadata\" WHERE \"Tagger\".\"idVideo\" = ".$id_video." ORDER BY \"Tagger\".\"start\" ;");
				if(pg_num_rows($res) > 0)
				{
					$tmp = array();
					while($row = pg_fetch_row($res))
						array_push($tmp, array("Id" => $row[0], "Title" => $row[1], "Observation" => $row[2], "Start" => $row[3], "End" => $row[4]));
					return $tmp;
				}
				else
					throw new Exception("ERREUR - Fonction getListMetadata(...) - Aucune donnees liees a cette Video");
			}
			else
				throw new Exception("ERREUR - Fonction getListMetadata(...) - Verifier les types des parametres");
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
		
	function getListMetadataByTitle($id_video){
		try
		{
			if(is_numeric($id_video))
			{
				$res = $this->executeSQL("SELECT \"Tagger\".\"idMetadata\", \"Metadata\".\"title\", \"Metadata\".\"observation\", \"Tagger\".\"start\", \"Tagger\".\"end\" FROM \"public\".\"Metadata\" INNER JOIN \"Tagger\" ON \"Tagger\".\"idMetadata\" = \"Metadata\".\"idMetadata\" WHERE \"Tagger\".\"idVideo\" = ".$id_video." ORDER BY \"Metadata\".\"title\" ;");
				if(pg_num_rows($res) > 0)
				{
					$tmp = array();
					while($row = pg_fetch_row($res))
						array_push($tmp, array("Id" => $row[0], "Title" => $row[1], "Observation" => $row[2], "Start" => $row[3], "End" => $row[4]));
					return $tmp;
				}
				else
					throw new Exception("ERREUR - Fonction getListMetadata(...) - Aucune donnees liees a cette Video");
			}
			else
				throw new Exception("ERREUR - Fonction getListMetadata(...) - Verifier les types des parametres");
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
}

?>
