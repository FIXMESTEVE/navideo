<?php
include_once('FormView.php');
include_once('srcPHP/Model/ResearchModel.php');

class FormViewResearch extends FormView
{
	private $model;
	
	function __construct($action) {
		parent::FormView($action);
		$this->model = new ResearchModel("dbserver", "xjouveno", "xjouveno", "pdp");
	}

	function linkCSS() {
		$webroot = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
		$webroot = str_replace(basename($webroot).'/', '', $webroot);
		$webroot = str_replace(basename($webroot).'/', '', $webroot);
		
		echo '<link rel="stylesheet" type="text/css" href="'.$webroot.'css/form_research.css">';
	}

	function linkJS() { }

	function onLoadJS() { return ""; }

	function execute() {
		if(!isset($_GET['execute'], $_GET['form']) || $_GET['form'] !== 'research' || (boolean)$_GET['execute'] !== true)
			return;
		
		if(!isset($_POST['titles'], $_POST['observations']) || ($_POST['titles'] === '' && $_POST['observations'] === ''))
		{
			echo '<p class="error">Formulaire de recherche mal rempli ou vide.</p>';
			return;
		}
		
		$regexp = '#&quot;([^&quot;]*)&quot;#U';
		
		$titles       = htmlspecialchars($_POST['titles']);
		$observations = htmlspecialchars($_POST['observations']);
		
		$titlesArray       = array();
		$observationsArray = array();
		
		preg_match_all($regexp, $titles, $titlesArray);
		preg_match_all($regexp, $observations, $observationsArray);
		
		$titlesArray       = $titlesArray[1];
		$observationsArray = $observationsArray[1];
		
		$nbrTitles       = count($titlesArray);
		$nbrObservations = count($observationsArray);
		
		$argsArray = array();
		
		for($i = 0; $i < $nbrTitles && $i < $nbrObservations; ++$i)
			$argsArray[] = array(
				'title' => $titlesArray[$i],
				'observation' => $observationsArray[$i]
			);
		for(; $i < $nbrTitles; ++$i)
			$argsArray[] = array('title' => $titlesArray[$i]);
		for(; $i < $nbrObservations; ++$i)
			$argsArray[] = array('observation' => $observationsArray[$i]);
		
		$allVideos = $this->model->findAllVideosMatchingMetadatasArguments($argsArray);
		
		if(!isset($_SESSION))
		{
			echo '<p class="error">Aucune session utilisateur n\'est ouverte.</p>';
			return;
		}
		
		$_SESSION['research']['videos'] = $allVideos;
	}

	function draw(){
		echo '<div class="frame2">';
		echo '<form id="research" method="post" action="'.$this->action.'?form=research&execute=true">';
		echo '<ul>';
		echo '<p class="info"><em><u>Note :</u></em> mettre les critères de recherche entre " ... " et les séparer par des virgules.</p>';
		echo '<li><label for="titles">Titre(s) :</label><input type="search" name="titles"></li>';
		echo '<li><label for="observations">Observation(s) :</label><input type="search" name="observations"></li>';
		echo '</ul>';
		echo '<input type="submit" value="Chercher">';
		echo '</form>';
		echo '</div>';
	}
}

?>
