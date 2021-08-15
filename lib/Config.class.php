<?php
/**
 * Clase para Configurar el cliente
 * @Filename: Config.class.php
 * @version: 2.0
 * @Author: flow.cl
 * @Email: csepulveda@tuxpan.com
 * @Date: 28-04-2017 11:32
 * @Last Modified by: Carlos Sepulveda
 * @Last Modified time: 28-04-2017 11:32
 * @Last Modified by: Ignacio Aguirre
 * @Last Modified time: 14-08-2021 16:20
 */




/*
|--------------------------------------------------------------------------
| Base URL 
|--------------------------------------------------------------------------
|
| La URL raíz de los archivos para conectar con Flow.
| 
| Por lo general, corresponde al dominio y la carpeta donde tengas los archivos
| Ejemplo: https://midominio.cl/flowapi
|
| Sin slash al final
|
*/
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on"){ $ssl_set = "s"; } else { $ssl_set = ""; }
$COMMERCE_CONFIG['BASEURL'] = 'http'.$ssl_set.'://'.$_SERVER['HTTP_HOST'].'/flow';


/*
|--------------------------------------------------------------------------
| Entorno de Producción o Pruebas
|--------------------------------------------------------------------------
|
| Define bajo que entorno realizarás la comunicación con flow, 
| existen dos opciones:
| 
| Producción: 
| 	Proporciona acceso directo para generar transacciones reales.
|	URL: https://www.flow.cl/api
|
| Sandbox: 
| 	Permite probar la integración sin afectar los datos reales.
| 	URL: https://sandbox.flow.cl/api
|
| A continuación debes dejar una línea comentada y otra descomentada,
| según el entorno en que quieras trabajar.
| 
| IMPORTANTE:
| Deberás tener una cuenta creada en el entorno donde decidas trabajar.
| Para trabajar en ambiente de Pruebas (Sandbox) debes crear una cuenta en
| https://sandbox.flow.cl
| Las cuentas de sandbox.flow.cl y www.flow.cl son independientes entre si
| 
*/
//$COMMERCE_CONFIG['APIURL'] = "https://www.flow.cl/api"; // Descomentar para usar ambiente de producción
$COMMERCE_CONFIG['APIURL'] = "https://sandbox.flow.cl/api"; // Descomentar para usar ambiente de pruebas

 
/*
|--------------------------------------------------------------------------
| Api Key
|--------------------------------------------------------------------------
|
| Identificador único de seguridad para ser usado en la integración con Flow.
| 
| Para obtener tu Api Key:
| 1. Ingresa en tu cuenta de flow.cl o sandbox.flow.cl
| 2. Ingresa a la página "Mis Datos"
| 3. En la sección "Seguridad" (al final de la página) encontrarás el Api Key.
|
*/
$COMMERCE_CONFIG['APIKEY'] = "xxxxx";
 
 
/*
|--------------------------------------------------------------------------
| Secret Key
|--------------------------------------------------------------------------
|
| Clave para asegurar que la información viene de una fuente confiable.
| 
| Para obtener tu Secret Key:
| 1. Ingresa en tu cuenta de flow.cl o sandbox.flow.cl
| 2. Ingresa a la página "Mis Datos"
| 3. En la sección "Seguridad" (al final de la página) encontrarás el Secret Key.
|
*/
$COMMERCE_CONFIG['SECRETKEY'] = "xxxxx";
  
 
 
 
/* 
   	        TÉRMINO DE LA CONFIGURACIÓN 
	No es necesario editar el código a continuación
*/ 
 
class Config { 	
	static function get($name) {
		global $COMMERCE_CONFIG;
		if(!isset($COMMERCE_CONFIG[$name])) { throw new Exception("El elemento ".$name." no está definido en el archivo de configuración", 1); }
		return $COMMERCE_CONFIG[$name];
	}
}