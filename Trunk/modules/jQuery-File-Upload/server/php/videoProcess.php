<?php
	$db = pg_connect("host=dbserver dbname=xjouveno user=xjouveno password=pdp");
	$w = 128; //thumbnail width
	$h = 72;  //tumbnail height

	//check if file exists
	$filepath = 'files/'.$_POST["filename"];
	if(!file_exists($filepath))
		throw new Exception("$filepath not found. Check the apache error log.");

	//file exists, let's fill the database
	$result = pg_query($db, "INSERT INTO \"Video\"(filename, title) VALUES('$_POST[filename]', '$_POST[title]') RETURNING \"idVideo\";") or die(pg_last_error());
	$insert_row = pg_fetch_row($result);
	$insert_id = $insert_row[0];

	//extract thumbnail from video file
	$cmd = "ffmpeg -y -ss 0.5 -i ".escapeshellarg($filepath)." -f mjpeg -vframes 1 -s {$w}x{$h} ".escapeshellarg('files/video_thumbnails/'.$insert_id.'.jpg');
	exec($cmd, $output, $code);
	if ($code != 0) {
	    throw new Exception("ffmpeg failed. Check the apache error log.");
	}

	//TODO: codec checking
	/*
	$cmd = 'ffprobe -v quiet -print_format json -show_format -show_streams ' . escapeshellargs($filepath) . ' 2>&1';

	exec($cmd, $output, $code);
	
	if ($code != 0) {
	    throw new Exception("ffprobe returned non-zero code");
	}

	$joinedOutput = join(' ', $output);
	$parsedOutput = json_decode($joinedOutput);
	if (null === $parsedOutput) {
	    throw new Exception("Unable to parse ffprobe output");
	}
	

	echo json_encode($parsedOutput);
	*/
?>