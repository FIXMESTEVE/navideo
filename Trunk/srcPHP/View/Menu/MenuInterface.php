<?php
/**
 *\file		MenuInterface.php
 *\author	Antoine Laumond, Romain Fontaine, Tom Solacroup, Xavier Jouvenot
 *\version	2.0
 *\date		08 Avril 2014
 *\brief	Defini l'interface principale de la vue des menus de cette application.
 *
 *\details	Cette interface defini les fontions de tous les elements de la vue des menus
 *			les fonctions de l'interface View
 *			isLogged permet de savoir si l'utilisateur est logg�
 *			disconnect permet � l'utilisateur de se d�connecter
 */
include_once "srcPHP/View/View.php";

interface MenuInterface extends View{
	function isLogged();
	function disconnect();
}

?>
