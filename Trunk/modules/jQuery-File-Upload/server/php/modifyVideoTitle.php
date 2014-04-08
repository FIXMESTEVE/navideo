<?php
	$db = pg_connect("host=dbserver dbname=xjouveno user=xjouveno password=pdp");
	
	//retrieve the title of the video with its filename
	$result = pg_query($db, "UPDATE \"Video\" SET title = '$_POST[title]' WHERE filename='$_POST[filename]';") or die(pg_last_error());
?>