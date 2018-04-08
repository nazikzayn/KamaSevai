<?php
	require_once("config.php");
	class MysqlDatabase {
		private $connection = " ";
		
		function openConnection() {
			$this -> connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
			if (mysqli_connect_errno()) {
				die("Database connection failed: ". mysqli_connect_error . " (". mysqli_connect_errno . ")"); 
			}
		} 
		                   
		function __construct() {
			$this -> openConnection();
		}
		
		function closeConnection() {
			if (isset($this->connection)) {
				mysqli_close($this -> connection);
				unset ($this -> connection); 
			}
		}
		
		function query($sql) { 
			$result = mysqli_query($this -> connection, $sql);
			if(!$result) {
				die("Database query failed".mysqli_error($this -> connection));
			} 
			return $result; 
		}  
		
		function __destruct() {
			$this->closeConnection(); 
		}
	}
	$db = new MysqlDatabase(); 
?>