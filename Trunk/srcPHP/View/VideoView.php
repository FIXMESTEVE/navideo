<?php


class VideoView implements View
{
	function VideoView(){
	}

	public function linkCSS(){ echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/video.css\">"; }

	public function draw(){
		echo "<video controls=\"controls\" id=\"myvideo\"> <source src=\"test.ogv\">  </video>";
	}
}
?>
