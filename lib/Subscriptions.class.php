<?php
require(__DIR__ . "/FlowApi.class.php");

class Subscriptions extends FlowApi  {

	public function __construct() {
		parent::__construct();
	}

	
	/*
	 * (1). Crear cliente en flow.cl -> CUSTOMER/CREATE
	 * Se obtiene: su customerId (token) como respuesta
	 *
	 * Pasar: name, email, externalId
	 *
	 */
	public function customer_create($data){								
		$params = array(
			'name'       => $data['name'],
			'email'      => $data['email'],
			'externalId' => $data['externalId']
		);		
		try {
			$flow     = $this->send('customer/create', $params, 'POST');	
			$response = array(
				'customerId'      => $flow['customerId'],      // (string) | Identificador del cliente
				'created'         => $flow['created'],         // (string) | <yyyy-mm-dd hh:mm:ss> | La fecha de creación
				'email'           => $flow['email'],           // (string) | email del cliente
				'name'            => $flow['name'],            // (string) | nombre del cliente
				'pay_mode'        => $flow['pay_mode'],        // (string) | "auto" (cargo automático) || "manual" (cobro manual)
				'creditCardType'  => $flow['creditCardType'],  // (string) | La marca de la tarjeta de crédito registrada
				'last4CardDigits' => $flow['last4CardDigits'], // (string) | Los últimos 4 dígitos de la tarjeta de crédito registrada
				'externalId'      => $flow['externalId'],      // (string) | El identificador del cliente en su negocio
				'status'          => $flow['status'],          // (string) | "0" (eliminado) || "1" (activo)
				'registerDate'    => $flow['registerDate'],    // (string) | <yyyy-mm-dd hh:mm:ss> | La fecha en que el cliente registro su tarjeta de crédito.
			);			
			return $response;
		} catch (Exception $e) { return $e->getCode()." - ".$e->getMessage(); }
	}
	
	
	/*
	 * Obtener cliente desde flow.cl -> CUSTOMER/GET
	 *
	 */
	public function customer_get($customerId){								
		$params = array('customerId' => $customerId);		
		try {
			$flow     = $this->send('customer/get', $params, 'GET');	         			
			return $flow;
		} catch (Exception $e) { return $e->getCode()." - ".$e->getMessage(); }
	}
	
	
	
	
	
	
	/*
	 * (2). Generar URL para registrar tarjeta -> CUSTOMER/REGISTER
	 * Se obtiene: url y token para formar: {url}+"?token="+{token}
	 *
	 * Pasar: customerId, url_return (callback URL)
	 *
	 */
	public function customer_register($data){
		$params = array(
			'customerId' => $data['customerId'],
			'url_return' => $data['callbackURL']
		);		
		$flow = $this->send('customer/register', $params, 'POST');		
		$response = array(
			'url'   => $flow['url'],
			'token' => $flow['token'],
		);		
		return $response;		
	}

	
	
	
	/*
	 * (3). Listen response from (2). CUSTOMER/REGISTER
	 * Se obtiene: token
	 *
	 * Luego: usar el token recibido para consultar estado con customer/getRegisterStatus
	 *
	 */
	public function customer_register_callback(){
		$token = $_POST['token'];
		$this->customer_getregisterstatus($token);
	}

	
	
	/*
	 * (4). Get Register CC Status -> CUSTOMER/GETREGISTERSTATUS
	 * Se obtiene: token
	 *
	 * Pasar: token
	 * Response: status (1: registrado - 0 no registrado), customerId, creditCardType, last4CardDigits
	 * Then: usar el token recibido para consultar estado con customer/getRegisterStatus
	 *
	 */
	public function customer_getregisterstatus($token){
		$params = array(
			'token' => $token
		);
		
		$flow = $this->send('customer/getRegisterStatus', $params, 'GET');		
		$response = array(
			'status'          => $flow['status'],
			'customerId'      => $flow['customerId'],
			'creditCardType'  => $flow['creditCardType'],
			'last4CardDigits' => $flow['last4CardDigits'],
		);

		return array('customerId' => $response['status'], 'status' => $response['customerId']);
	}

	

	
	
	/*
	 * (5). Subscribir a un plan -> SUBSCRIPTION/CREATE
	 *
	 * Pasar: customerId y planId
	 *
	 */

	public function subscription_create($customerId, $planId){
		$params = array(
			'planId'     => $planId,
			'customerId' => $customerId,
		);
		
		$flow = $this->send('subscription/create', $params, 'POST');		
		$response = array(
			'subscriptionId'       => $flow['subscriptionId'],
			'planId'               => $flow['planId'],
			'plan_name'            => $flow['plan_name'],
			'customerId'           => $flow['customerId'],
			'created'              => $flow['created'],
			'subscription_start'   => $flow['subscription_start'],
			'subscription_end'     => $flow['subscription_end'],
			'period_start'         => $flow['period_start'],
			'period_end'           => $flow['period_end'],
			'next_invoice_date'    => $flow['next_invoice_date'],
			'trial_period_days'    => $flow['trial_period_days'],
			'trial_start'          => $flow['trial_start'],
			'trial_end'            => $flow['trial_end'],
			'cancel_at_period_end' => $flow['cancel_at_period_end'],
			'cancel_at'            => $flow['cancel_at'],
			'periods_number'       => $flow['periods_number'],
			'days_until_due'       => $flow['days_until_due'],
			'status'               => $flow['status'],
			'morose'               => $flow['morose'],
			'discount'             => $flow['discount'],
			'invoices'             => $flow['invoices']
		);
		return $response['customerId'];
	}

	
	
	
	/*
	 * Planes -> Listar Planes
	 *
	 *
	 */
	public function planes_listar(){
		$params = array();
		try {
			$flow = $this->send('plans/list', $params, 'GET');	         			
			return $flow;
		} catch (Exception $e) { return $e->getCode()." - ".$e->getMessage(); }
	}
	
	
	
}
