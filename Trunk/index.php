<?php

/**
 *\file		index.php
 *\author	Antoine Laumond, Romain Fontaine, Tom Solacroup, Xavier Jouvenot
 *\version	2.0
 *\date		08 Avril 2014
 *\brief	Fichier initial lancant le programme.
 *
 *\details 	Ce fichier contient d'abord les pametres de detections d'erreurs.
 *		Ensuite, l'inclusion des fichiers en cascade.
 *		Puis l'instanciation des divers objets en cascade.
 *		Et enfin, leur affichage.
 */

/* Paramtre de la dectection d'erreur PHP */
error_reporting(1);
ini_set('display_errors', 1);

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);

/* inclusion des fichiers en cascade */
include "srcPHP/main.php";

/* instanciation des objets en cascade */
$m = new Main();

/* affichage */
$m->run();


?>
