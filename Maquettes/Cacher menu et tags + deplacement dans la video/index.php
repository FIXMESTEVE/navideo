<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title> Projet De Programmation </title>
		<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
		<meta name="description" lang="fr" content="">
		<meta name="keywords" lang="fr" content="">
		<meta name="date" content="2013-02-17T14:00:00">
		<meta name="robots" content="no-follow">
		<meta name="robots" content="index">
		<meta name="author" content="Xavier Jouvenot">
		<script type="text/javascript" src="file.js"></script>
	</head>
	<body>
		<button onClick="clickButtonDisplayLeftMenu(this);">Cacher Menu</button>
		<button onClick="clickButtonDisplayTagsMenu(this);">Cacher Indexs</button>
		<?php include 'left_menu.php'; ?>
		<?php include 'lecteur_light.php'; ?>
		<script>displayLeftMenu();</script>
	</body>
</html>
