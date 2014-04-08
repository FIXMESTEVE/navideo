<?php
	$db = pg_connect("host=dbserver dbname=xjouveno user=xjouveno password=pdp");
	
	//cleans the database of the erased file
	$result = pg_query($db, "DELETE FROM \"Video\" WHERE filename='$_POST[filename]' RETURNING \"idVideo\";") or die(pg_last_error());
	$delete_row = pg_fetch_row($result);
	$delete_id = $delete_row[0];

	//erase its thumbnail
	$cmd = "rm ".escapeshellarg('files/video_thumbnails/'.$delete_id.'.jpg');
	exec($cmd, $output, $code);
	if ($code != 0) {
	    throw new Exception("rm failed. Check the apache error log.");
	}
?>