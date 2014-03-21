<?php
interface View{
	function draw();
	function linkCSS();
	function linkJS();
	function onLoadJS();
}
?>
