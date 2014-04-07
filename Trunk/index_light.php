<?php
	include_once "srcPHP/View/Player/PlayerView.php";
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
	if(isset($_GET) && isset($_GET["play"]) && isset($_GET["start"])){
		$player->linkCSS();
		$player->linkJS();
	}
?>

</head>

<?php
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
