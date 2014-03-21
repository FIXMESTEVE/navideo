<?php
include_once "InterfaceSectionView.php";
include_once "PlayerView.php";

class SectionGuestView implements InterfaceSectionView{

	var $context = NULL;

	function SectionGuestView(){
		$this->setContext();
	}

	function setContext(){
		$this->context = new PlayerView();
	}

	function linkCSS(){ $this->context->linkCSS(); }

	function linkJS(){ $this->context->linkJS(); }

	function onLoadJS(){ return $this->context->onLoadJS(); }

	function draw(){ $this->context->draw(); }
}
?>
