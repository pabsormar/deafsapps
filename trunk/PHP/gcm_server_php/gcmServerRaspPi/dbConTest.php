<?php

	include_once './dbInstance.php';
	include_once './dbConfig.php';
	
	$mDbInstance = new dbInstance;
	
	$mDbInstance->dbConnect();	
	$mDbInstance->dbGetAllUsers();	
	$mDbInstance->dbDisconnect();

?>