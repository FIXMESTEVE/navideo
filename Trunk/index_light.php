<?php
/**
 *\file		index_light.php
 *\author	Antoine Laumond, Romain Fontaine, Tom Solacroup, Xavier Jouvenot
 *\version	2.0
 *\date		08 Avril 2014
 *\brief	Fichier permettant de n'avoir qu'un lecteur videoeger
 *
 *\details	Ce fichier n'integre que le lecteur video et la liste des observations
 *		liee a celle-ci. La videee et le commencement de la lecture sont
 *		fournie par l'url ($_GET).
 */


	include_once "srcPHP/View/Player/PlayerView.php";

	/* instanciation du player */
	$player = NULL;
	if(isset($_GET) && isset($_GET["play"]) && isset($_GET["start"]))
		$player = new PlayerView($_GET["play"], $_GET["start"]);
?>

<!doctype html>
<html>
<head>
<title>Projet De Programmation - Lecteur Leger</title>
<script type="text/javascript" src="js/SM2soundmanager2.js"></script>
<script type="text/javascript" src="js/utils.js"></script>
<link rel="stylesheet" type="text/css" href="css/body.css">

<?php
	/* Liaison avec les fichiers CSS et JS du player */
	if(isset($_GET) && isset($_GET["play"]) && isset($_GET["start"])){
		$player->linkCSS();
		$player->linkJS();
	}
?>

</head>

<?php
	/* Affichage du player */
	if(isset($_GET) && isset($_GET["play"]) && isset($_GET["start"])){
		echo "<body onload=".$player->onLoadJS().">";
		$player->draw();
	}
	else{
?>
		<body>
		<h1>Lien Incorrect</h1>
<?php
	}
?>

</body>
</html>
