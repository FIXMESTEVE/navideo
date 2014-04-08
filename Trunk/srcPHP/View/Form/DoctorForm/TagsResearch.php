<?php
include_once('FormView.php');
include_once('srcPHP/Model/ResearchModel.php');

class TagsResearch extends FormView
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

	function linkJS() {
	?>
		<script type="text/javascript">
			var TagsResearch = { };
			TagsResearch.addRow = function(tableId) {
				if (window.jQuery)
				{
					var newRow = '<tr>';
					newRow += '<td><input type="text" name="title[]" value=""></td>';
					newRow += '<td><input type="text" name="observation[]" value=""></td>';
					newRow += '</tr>';
					jQuery('table#'+tableId+" tr:last").after(newRow);
				}
				else
					alert('Cette fonctionnalité nécessite l\'utilisation de jQuery !');
			}
		</script>
	<?php
	}

	function onLoadJS() { return ""; }

	function execute() {
		if(!isset($_GET['execute'], $_GET['form']) || $_GET['form'] !== 'research' || (boolean)$_GET['execute'] !== true)
			return;
		
		if(!isset($_POST['title'], $_POST['observation']) || (empty($_POST['title']) && empty($_POST['observation'])))
			return;
		
		$metaArgs = array();
		
		$nbrOfTitles = count($_POST['title']);
		$nbrOfObservations = count($_POST['observation']);
		
		assert($nbrOfTitles === $nbrOfObservations);
		
		for($i=0; $i<$nbrOfTitles; ++$i)
		{
		    $title = htmlspecialchars($_POST['title'][$i]);
		    $observation = htmlspecialchars($_POST['observation'][$i]);
		    
		    $arg = array();
		    
		    if($title !== '')
			$arg['title'] = $title;
		    if($observation !== '')
			$arg['observation'] = $observation;
		    
		    if(!empty($arg))
			$metaArgs[] = $arg;
		}
		
		if(empty($metaArgs))
		{
		    echo '<p class="error">Formulaire de recherche mal rempli ou vide.</p>';
		    return;
		}
		
		$allVideos = $this->model->findAllVideosMatchingMetadatasArguments($metaArgs);
		
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
		echo '<table id="metaArgs">';
		echo '<tr>';
                echo '<td><input type="text" name="title[]" value="Title..."></td>';
                echo '<td><input type="text" name="observation[]" value="Observation..."></td>';
                echo '</tr>';
                echo '</table>';
                echo '<input type="button" onclick="TagsResearch.addRow(\'metaArgs\');" value="Ajouter des arguments"><br>';
                echo '<input type="submit" value="Chercher">';
		echo '</form>';
		echo '</div>';
	}
}

?>
