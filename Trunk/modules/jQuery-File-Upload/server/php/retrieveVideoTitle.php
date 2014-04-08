<?php
	header('Content-Type: application/json');

	$db = pg_connect("host=dbserver dbname=xjouveno user=xjouveno password=pdp");
	
	//retrieve the title of the video with its filename
	$result = pg_query($db, "SELECT title FROM \"Video\" WHERE filename='$_POST[filename]';") or die(pg_last_error());
	$select_row = pg_fetch_row($result);
	$title = $select_row[0];

	//send it back
	$JSONarray = array( 'filename' => "$_POST[filename]",
						'title' => "$title" );
	echo json_encode($JSONarray);
?>