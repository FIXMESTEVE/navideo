<?php
include_once "srcPHP/View/View.php";

interface MenuInterface extends View{
	function isLogged();
	function disconnect();
}

?>
