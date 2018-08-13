<?php
class MySQLCN
{
	function __construct(){
	
		$user = DB_USERNAME;
		$pass = DB_PASSWORD;
		$server = DB_SERVER;
		$dbase = DB_DATABASE;
 
		$conn = mysqli_connect($server,$user,$pass,$dbase);

		if(!$conn) {
			$this->error("Connection attempt failed");

		}
		else{
		/*	echo "connected";*/
		}
		if(!mysqli_select_db($conn,$dbase)) {
			$this->error("Dbase Select failed");
			
		}
		else{
			/*echo "db selected";*/
		}
		$this->CONN = $conn;
		return true;
	}

	function close()
	{	
		$conn = $this->CONN ;
		$close = mysqli_close($conn);
		if(!$close) {
			$this->error("Connection close failed");
		}
		return true;
	}
	function error($text)
	{
		
		$no = mysqli_errno($conn);
		$msg = mysqli_error($conn);

		exit;
	}

	function select ($sql="")
	{
		if(empty($sql)) { return false; }
		if(!preg_match('/^select+/i',$sql))
		{
			echo "Wrong Query<hr>$sql<p>";
			echo "<H2>Wrong function silly!</H2>\n";
			return false;
		}
		$data = $this->mysql_query_data($sql);
		return $data;
	}

    function affected($sql="")
	{
		if(empty($sql)) { return false; }
		if(!preg_match('/^select+/i',$sql))
		{
			echo "wrongquery<br>$sql<p>";
			echo "<H2>Wrong function silly!</H2>\n";
			return false;
		}
		if(empty($this->CONN)) { return false; }
		$conn = $this->CONN;
		$results = mysqli_query($conn,$sql);
		if( (!$results) or (empty($results)) ) {
			return false;
		}
		$tot=0;
		$tot=mysql_affected_rows();
		return $tot;
	}

	function insert ($sql="")
	{
		if(empty($sql)) { return false; }
		if(!preg_match('/^insert+/i',$sql))
		{
			return false;
		}
		if(empty($this->CONN))
		{
			return false;
		}
		$conn = $this->CONN;
		$results = mysqli_query($conn,$sql);
		if(!$results)
		{	echo "Insert Operation Failed..<hr>" . mysql_error();
			$this->error("Insert Operation Failed..");
			$this->error("<H2>No results!</H2>\n");
			return false;
		}
		$id = mysqli_insert_id($this->CONN);
		return $id;
	}

	function update($sql="")
	{
		if(empty($sql)) { return false; }
		if(!preg_match('/^update+/i',$sql))
		{
			return false;
		}
		if(empty($this->CONN))
		{
			return false;
		}
		$conn = $this->CONN;
		$results = mysqli_query($conn,$sql);
		if(!$results)
		{
			$this->error("<H2>No results!</H2>\n");
			return false;
		}
		$rows = 0;
		$rows = mysqli_affected_rows($conn);
		return $rows;
	}

	function sql_query($sql="")
	{	
		if(empty($sql)) { return false; }
		if(empty($this->CONN)) { return false; }
		$conn = $this->CONN;
		$results = mysqli_query($conn,$sql) or die("Query Failed..<hr>" . mysql_error());
		if(!$results)
		{   $message = "Query went bad!";
			$this->error($message);
			return false;
		}
		// (Martin Huba) also SHOW... commands return some results
		if(!(preg_match('/^select+/i',$sql) || preg_match('/^show+/i',$sql))){
			return true; }
		else {
			$count = 0;
			$data = array();
			while ( $row = mysqli_fetch_array($results,MYSQLI_ASSOC))	{
				$data[$count] = $row;
				$count++;
			}
			mysqli_free_result($results);
			return $data;
		}
	}
	function mysql_query_data($sql){
		if(empty($this->CONN)) { return false; }
		$conn = $this->CONN;
		$results = mysqli_query($conn,$sql);
		if( (!$results) or (empty($results)) ) {
			return false;
		}
		$count = 0;
		$data = array();
		while ( $row = mysqli_fetch_assoc($results))
		{
			$data[$count] = $row;
			$count++;
		}
		mysqli_free_result($results);
		return $data;
	}
}
?>
