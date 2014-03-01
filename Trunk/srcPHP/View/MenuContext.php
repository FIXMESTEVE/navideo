<?php
include_once "View.php";

interface MenuContext extends View{
	function isLogged();
	function disconnect();
}

?>
