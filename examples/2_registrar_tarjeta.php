<?php
	
	require(__DIR__ . "/../lib/Subscriptions.class.php");	
	$subscriptions = new Subscriptions;			
	
	$data = array(
		"customerId"  => "cus_xxxxxxxxxx",
		"callbackURL" => "https://dominio.cl/flow/examples/3_registrar_tarjeta_callback.php",
	);
	
	$registerURL = $subscriptions->customer_register($data);
	$redirect    = $registerURL['url']."?token=".$registerURL['token'];
	header("location:$redirect");
