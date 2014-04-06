<?php
	$db = pg_connect("host=dbserver dbname=xjouveno user=xjouveno password=pdp");
	
	//cleans the database of the erased file
	$result = pg_query($db, "DELETE FROM \"Video\" WHERE filename='$_POST[filename]' RETURNING \"idVideo\";") or die(pg_last_error());
	$insert_row = pg_fetch_row($result);
	$insert_id = $insert_row[0];

	//erase its thumbnail
	$cmd = "rm ".escapeshellarg('files/video_thumbnails/'.$insert_id.'.jpg');

?>