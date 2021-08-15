<?php
	
	require(__DIR__ . "/../lib/Subscriptions.class.php");	
	$subscriptions = new Subscriptions;		
	
	if(!empty($_GET['customer'])) {
		$customerId = $_GET['customer']; 
		$customer   = $subscriptions->customer_get(htmlspecialchars($customerId));	
		echo "<pre>".print_r($customer,true)."</pre>";				
	}
	
	
	