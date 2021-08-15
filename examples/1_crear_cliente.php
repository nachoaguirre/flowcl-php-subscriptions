<?php
	
	require(__DIR__ . "/../lib/Subscriptions.class.php");	
	$subscriptions = new Subscriptions;		
	
	$data = array(
		"name"       => "Nombre",
		"email"      => "email@cliente.com",
		"externalId" => 10
	);
	
	$newCustomer = $subscriptions->customer_create($data);
	echo "<pre>".print_r($newCustomer,true)."</pre>";	
