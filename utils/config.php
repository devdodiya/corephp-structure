<?php

	define ("DB_SERVER","");
	define ("DB_DATABASE","");
	define ("DB_USERNAME","");
	define ("DB_PASSWORD","");
	
	define ("HOST_URL",(isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER[HTTP_HOST]."/old_site/");

	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
?>


