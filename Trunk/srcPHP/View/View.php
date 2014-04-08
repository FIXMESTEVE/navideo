<?php
/**
 *\file		View.php
 *\author	Antoine Laumond, Romain Fontaine, Tom Solacroup, Xavier Jouvenot
 *\version	2.0
 *\date		08 Avril 2014
 *\brief	Defini l'interface principale de la vue cette application.
 *
 *\details	Cette interface defini les fontions de tous les elements de la vue
 *			draw pour l'afficher
 *			linkCSS pour relier la ou les feuilles de style de l'objet
 *			linkJS pour relier le ou les scripts nécessaire à l'objet
 *			onLoadJS pour appeler les fonctions nécessaires, lors du chargement de la page
 */
interface View{
	function draw();
	function linkCSS();
	function linkJS();
	function onLoadJS();
}
?>
