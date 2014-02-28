<?php
	class VideoView implements View
	{
		public function draw(){
			echo "<div class=\"frame1\">";
			echo "<video width=\"640\" height=\"480\" controls=\"controls\">
				 <source src=\"test.ogv\">
				 </video>";
			echo "</div>";
		}
	}
?>