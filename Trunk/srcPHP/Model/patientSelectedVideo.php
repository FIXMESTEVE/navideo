<?php
	header('Content-Type: application/json');

	$db = pg_connect("host=dbserver dbname=xjouveno user=xjouveno password=pdp");
	
	//retrieve the videos associated
	$result = pg_query($db, "SELECT \"idVideo\" FROM \"public\".\"Video\" WHERE \"idPatient\" = $_POST[id];") or die(pg_last_error());
	$myarray = array();
	while ($row = pg_fetch_row($result)) {
	  $myarray[] = $row;
	}

	//send it back
	echo json_encode($myarray);
?>