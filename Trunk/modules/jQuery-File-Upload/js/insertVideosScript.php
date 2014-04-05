<?php

public function phpScript(){
	$file = $_GET["file"];
	$phpScript = $_POST['phpScript'];

	$cmd = 'ffprobe -v quiet -print_format json -show_format -show_streams ' . escapeshellarg($file).' 2>&1';

	exec($cmd, $output, $code);
	if ($code != 0) {
	    throw new ErrorException("ffprobe returned non-zero code", $code, $output);
	}

	$joinedOutput = join(' ', $output);
	$parsedOutput = json_decode($joinedOutput);
	if (null === $parsedOutput) {
	    throw new ErrorException("Unable to parse ffprobe output", $code, $output);
	}
}
?>