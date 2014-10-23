<?php

	class dbInstance
	{
		private $con;
		
		function __construct() {}
		
		function __destruct() { $this->con = null; }
		
		public function dbConnect() 
		{
			// Include dbConfig.php
			include_once './dbConfig.php';

			// Create connection or abort in case of error
			$this->con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die('Failed to connect to MySQL: ' . mysqli_connect_errno());		
			echo 'Connection successful, value: ' . mysqli_connect_errno() . PHP_EOL;

			// Query the database to check whether it already exists; if not, it is created.
			$queryResult = mysqli_query($this->con, "SELECT * FROM " . DB_TABLE);	
			if (!$queryResult)     // '$queryResult' is FALSE if 'mysqli_query()' was not successful 
			{ 
				$queryResult = mysqli_query($this->con, "CREATE TABLE IF NOT EXISTS " . DB_TABLE . " 
												(" . DB_ID . " int(11) NOT NULL AUTO_INCREMENT,
												 " . DB_REGID . " text NOT NULL,
												 " . DB_GROUP . " varchar(50),
												 " . DB_TIMESTAMP . " timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, 
												 PRIMARY KEY (" . DB_ID . ")
												) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;") or die('Failed to create table: ' . mysqli_connect_errno()); 												
			}
			//else echo 'Number of rows: ' . mysqli_num_rows($queryResult) . PHP_EOL;
		}
		
		// Generic MySQL query in case it is required
		public function dbQuery($dbColumns = '*', $dbWhereClause = '', $orderBy = DB_ID)
		{
			$queryResult = mysqli_query($this->con, "SELECT " . $dbColumns . " FROM " . DB_TABLE . " WHERE " . $dbWhereClause . " ORDER BY " . DB_ID) or die('Failed to query: ' . mysqli_error($this->con));		
			return $queryResult;
		}
		
		// This function accepts a 'gcm_regid' to be inserted into the database
		public function dbInsert($regId, $group)
		{			
			// Query the database. If no row is retrieved, an insertion is carried out
			$queryResult = mysqli_query($this->con, "SELECT * FROM " . DB_TABLE . " WHERE " . DB_REGID . " = '$regId'") or die('Failed to query: ' . mysqli_error($this->con));			
			echo 'Number of matches: ' . mysqli_num_rows($queryResult) . PHP_EOL;
			if (!mysqli_num_rows($queryResult))
			{
				echo 'INSERT...' . PHP_EOL;
				$queryResult = mysqli_query($this->con, "INSERT INTO " . DB_TABLE . " (" . DB_REGID . "," . DB_GROUP . "," . DB_TIMESTAMP . ") VALUES ('$regId', '$group', CURRENT_TIMESTAMP)") or die('Failed to insert: ' . mysqli_error($this->con));
			}			
		}
		
		public function dbDelete($regId)
		{
			$queryResult = mysqli_query($this->con, "DELETE FROM " . DB_TABLE . " WHERE ". DB_REGID . " = '$regId'") or die('Failed to delete: ' . mysqli_error($this->con));		
		}	
		
		public function dbGetOneUser($regId)
		{
			$queryResult = mysqli_query($this->con, "SELECT " . DB_REGID ." FROM " . DB_TABLE . " WHERE " . DB_REGID . " = '$regId'") or die('Failed to query: ' . mysqli_error($this->con));
			return $queryResult;
		}
		
		public function dbGetOneGroup($group)
		{
			$queryResult = mysqli_query($this->con, "SELECT " . DB_REGID ." FROM " . DB_TABLE . " WHERE " . DB_GROUP . " = '$group'") or die('Failed to query: ' . mysqli_error($this->con));
			return $queryResult;
		}

		public function dbGetAllUsers()
		{
			$queryResult = mysqli_query($this->con, "SELECT " . DB_REGID ." FROM " . DB_TABLE) or die('Failed to query: ' . mysqli_error($this->con));
			return $queryResult;
		}		
		
		public function dbDisconnect()
		{
			// Close connection when finish
			mysqli_close($this->con);
		}
	}
	
?>
