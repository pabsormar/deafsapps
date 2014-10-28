<?php

	// Replace with the real server API key from Google APIs
	define('GOOGLE_API_KEY', 'AIzaSyCoDqoODh55jMEMLFA9DU3yENLXG3LA1Xk');

	class gcmInstance
	{		
		function __construct() {}
		
		// Sending Push Notification to one or several devices
		public function sendNotification($registrationIDs, $message)
		{				
			// Set POST variables
			$url = 'https://android.googleapis.com/gcm/send';
			$fields = array('registration_ids' => $registrationIDs, 'data' => array("message" => $message));
			$headers = array('Authorization: key=' . GOOGLE_API_KEY, 'Content-Type: application/json');
			
			// Open connection
			$ch = curl_init();

			// Set the URL, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			// Disabling SSL Certificate support temporarly
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

			// Execute post
			$result = curl_exec($ch);
			if ($result === FALSE) { die('Curl failed: ' . curl_error($ch)); }

			// Close connection
			curl_close($ch);
			echo $result . PHP_EOL;

			// If the GCM server has changed the "registration id", 'canonical_ids' is equal to 1
			$dResult = json_decode($result);
			if ($dResult->canonical_ids)
			{
				$retNewId = $dResult->results[0]->registration_id;
				echo 'New Registration Id: ' . $retNewId . PHP_EOL;
				return $retNewId;
				//echo 'New Registration Id: ' . var_dump($dResult) . PHP_EOL;
			}	
		}	
	}
	
?>
