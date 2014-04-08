<?php
	header('Content-Type: application/json');

	$db = pg_connect("host=dbserver dbname=xjouveno user=xjouveno password=pdp");
	$result = pg_query($db, "UPDATE \"public\".\"Video\" SET \"idPatient\" = '".$_POST["idPatient"]."' WHERE \"idVideo\" = '".$_POST["idVideo"]."' ;") or die(pg_last_error());
	
	echo 1;
?>