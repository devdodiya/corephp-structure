<?php
ob_start();
session_start();
if(empty($_SESSION['$RecordPerPage']))
	$_SESSION['$RecordPerPage'] = 10;

require_once("utils/config.php");	

// require_once("utils/dbClass.php");
// $objDB = new MySQLCN;

require_once("utils/functions.php");

$p = loadVariable("p","home");	
$a = loadVariable("a","");

require_once 'include/header.php';
require_once 'include/sidebar.php';
include_once 'include/'.$p.'.php';
require_once 'include/footer.php';