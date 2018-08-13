<?
	ob_start();
	session_start();
	if(empty($_SESSION['$RecordPerPage']))
		$_SESSION['$RecordPerPage'] = 10;
		
	require_once("utils/config.php");
	require_once("utils/functions.php");
	require_once("utils/dbClass.php");


	$objDB = new MySQLCN;
	
	$p = loadVariable("p","");
	if(empty($p))
		$page = "error.php";
	else if(isset($p))
		$page = $p.".php";
	else
		$page = "error.php";
	

	if(file_exists("action/".$page)){
		
		include("action/".$page);
	}
	else{
		//echo "in else ";
		include("action/error.php");
	}


	//$objDB->close();
?>




















