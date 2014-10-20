<?php

	class dbInstance
	{
		private $con;
		
		function __construct() {}
		
		function __destruct() { $this->con = null; }
		
		function dbConnect() 
		{
			// Include dbConfig.php
			include_once './dbConfig.php';

			// Create connection or abort in case of error
			$this->con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die('Failed to connect to MySQL: ' . mysqli_connect_errno());		
			echo 'Connection successful, value: ' . mysqli_connect_errno() . '<br />';

			// Query the database to check whether it already exists; if not, it is created.
			$queryResult = mysqli_query($this->con, "SELECT * FROM " . DB_TABLE);	
			if (!$queryResult)     // '$queryResult' is FALSE if 'mysqli_query()' was not successful 
			{
				$queryResult = mysqli_query($this->con, "CREATE TABLE IF NOT EXISTS " . DB_TABLE . " 
												(" . DB_ID . " int(11) NOT NULL AUTO_INCREMENT,
												 " . DB_REFERID . " int(11) NOT NULL UNIQUE,
												 " . DB_REGID . " text, " . DB_TIMESTAMP . " timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, 
												 PRIMARY KEY (" . DB_ID . ")
												) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;") or die('Failed to create table: ' . mysqli_connect_errno()); 
												
			}
			//else echo 'Number of rows: ' . mysqli_num_rows($queryResult) . '<br />';
		}
		
		function dbQuery($dbColumns = '*', $dbWhereClause = '', $orderBy = DB_ID)
		{
			$queryResult = mysqli_query($this->con, "SELECT " . $dbColumns . " FROM " . DB_TABLE . " WHERE " . $dbWhereClause . " ORDER BY " . DB_ID) or die('Failed to query: ' . mysqli_error($this->con));		
		}
		
		// This function accepts an '_id' and a 'gcm_regid' so the latter is updated. If the '_id' is empty, a new register is inserted.
		function dbUpdate($referId, $regId)
		{			
			// Query the database. If no row is retrieved, an insertion is carried whereas if there is any, an update is performed
			$queryResult = mysqli_query($this->con, "SELECT * FROM " . DB_TABLE . " WHERE " . DB_REFERID . " = '$referId'") or die('Failed to query: ' . mysqli_error($this->con));			
			echo 'Number of matches: ' . mysqli_num_rows($queryResult) . '<br />';
			if (!mysqli_num_rows($queryResult))
			{
				echo 'INSERT... <br />';
				$queryResult = mysqli_query($this->con, "INSERT INTO " . DB_TABLE . " (" . DB_REFERID . "," . DB_REGID . "," . DB_TIMESTAMP . ") VALUES ('$referId', '$regId', CURRENT_TIMESTAMP)") or die('Failed to insert: ' . mysqli_error($this->con));
				mysqli_query($this->con, "UPDATE " . DB_TABLE . " SET " . DB_REFERID . " = " .  DB_ID . " WHERE " . DB_REGID . " = '$regId'") or die('Failed to update: ' . mysqli_error($this->con));
				$queryResult = mysqli_query($this->con, "SELECT " . DB_REFERID . " FROM " . DB_TABLE . " WHERE " . DB_REGID . " = '$regId'") or die('Failed to query: ' . mysqli_error($this->con)); 
				echo $queryResult;
			}
			else
			{
				echo 'UPDATE... <br />';
				$queryResult = mysqli_query($this->con, "UPDATE " . DB_TABLE . " SET " . DB_REGID . " = '$regId', " . DB_TIMESTAMP . " = CURRENT_TIMESTAMP WHERE " . DB_REFERID . " = '$referId'") or die('Failed to update: ' . mysqli_error($this->con));		
			}
		}
		
		function dbDelete($referId)
		{
			$queryResult = mysqli_query($this->con, "DELETE FROM " . DB_TABLE . " WHERE ". DB_REFERID . " = '$referId'") or die('Failed to delete: ' . mysqli_error($this->con));		
		}		
		
		function dbDisconnect()
		{
			// Close connection when finish
			mysqli_close($this->con);
		}
	}
	
?>