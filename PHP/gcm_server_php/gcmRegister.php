<?php
	include_once './dbInstance.php';
	include_once './dbConfig.php';
	
	if (isset($_POST[DB_REFERID]) && isset($_POST[DB_REGID]))
	{			
		$referId = $_POST[DB_REFERID];
		$regId = $_POST[DB_REGID];
	
		$mDbInstance = new dbInstance;		
		$mDbInstance->dbConnect();		
		$mDbInstance->dbUpdate($referId, $regId);		
		$mDbInstance->dbDisconnect();
	}
	else
		echo 'No input data';
?>