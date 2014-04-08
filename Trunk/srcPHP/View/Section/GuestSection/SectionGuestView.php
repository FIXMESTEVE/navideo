<?php
include_once "srcPHP/View/Player/PlayerView.php";
include_once "srcPHP/View/Section/GuestSection/Mosaic.php";
include_once "srcPHP/View/Section/InterfaceSectionView.php";

class SectionGuestView implements InterfaceSectionView{

	var $context = NULL;

	function SectionGuestView(){
		$this->setContext();
	}

	function setContext(){
		if(isset($_GET) && isset($_GET["play"]))
			$this->context = new PlayerView($_GET["play"]);
		else
			$this->context = new Mosaic();
	}

	function linkCSS(){ $this->context->linkCSS(); }

	function linkJS(){ $this->context->linkJS(); }

	function onLoadJS(){ return $this->context->onLoadJS(); }

	function draw(){ $this->context->draw(); }
}
?>
