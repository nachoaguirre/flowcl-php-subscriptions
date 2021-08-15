<?php
	
	require(__DIR__ . "/../lib/Subscriptions.class.php");	
	$subscriptions = new Subscriptions;		
	
	$data   = array();	
	$planes = $subscriptions->planes_listar();

	echo "<pre>".print_r($planes,true)."</pre>";	
