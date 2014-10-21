<?php
	include_once './dbInstance.php';
	include_once './dbConfig.php';
	
	if (isset($_POST[DB_REGID]))
	{			
		$regId = $_POST[DB_REGID];
	
		$mDbInstance = new dbInstance;		
		$mDbInstance->dbConnect();		
		$newReferId = $mDbInstance->dbInsert($regId);		
		$mDbInstance->dbDisconnect();		
	}
	else
		echo 'No input data';
?>