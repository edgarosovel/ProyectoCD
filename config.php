<?php 
	date_default_timezone_set('America/Mexico_City');
	error_reporting(E_ALL|E_STRICT);
	ini_set('display_errors', 'on');

	//define( 'URL' ,"http://127.0.0.1/salud/");
	define( 'URL' ,"http://localhost:9999/newmvc/");

	define( 'CSS' , URL."public/css/");
	define( 'JS' , URL."public/js/" );
	define('IMG', URL."public/images/");

	//Constantes de la base de datos
	define( 'DB_HOST' ,'localhost');
	define( 'DB_USER' ,'root');
	define( 'DB_PASS' ,'');
	define( 'DB_NAME' ,'Empresa');
	define( 'DB_CHARSET' ,'utf-8');

	define( 'ALGOR' ,'sha512');
	define( 'KEY' ,'sac2016');
?>