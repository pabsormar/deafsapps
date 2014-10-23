<?php

	include_once './dbInstance.php';
	include_once './gcmInstance.php';
	
	// If there is only one input argument, it would be a message to notify to every user
	if ($argc == 2)
	{
		$message = $argv[1];
		//echo 'Message: ' . $message . PHP_EOL;
		
		$mDbInstance = new dbInstance;
		$mDbInstance->dbConnect();
		
		$users = $mDbInstance->dbGetAllUsers();
		
		$mGcmInstance = new gcmInstance;
		
		for ($i = 0; $i < mysqli_num_rows($users); $i++)
		{
			$usersArray = mysqli_fetch_row($users);
			$mGcmInstance->sendNotification($usersArray, $message);
		}
		
		mysqli_free_result($users);
				
		$mDbInstance->dbDisconnect();		
	}
	// If there are two input arguments, they would be the message and a group name of users
	elseif ($argc == 3)
	{
	
	}
	else
		echo 'One or two input arguments must be passed to the script!!' . PHP_EOL;
	
	
	
	//$mDbInstance = new dbInstance;
	
	//$mDbInstance->dbConnect();
	
	//$mDbInstance->dbUpdate(19, 'mariajo');
	//$mDbInstance->dbDelete(15);
	
	//$mDbInstance->dbDisconnect();

?>