<?php
// This file is used to send PUSH notification requests to the GCM server

	class GCM
	{
		// Constructor
		function __construct() {}
		
		// Sending PUSH notification
		public function send_notification($registration_ids, $message)
		{
			// Include 'config.php' to get access to the 'GOOGLE_API_KEY' value
			include_once './config.php';
			
			// Set POST variables
			$url = 'https://android.googleapis.com/gcm/send'
			
			$fields = array('registration_ids' => $registration_ids, 
							'data' => $message);
			
			$headers = array('Authorization: key=' . GOOGLE_API_KEY, 
							'Content-Type: application/json');
			
			// Open connection
			$ch = curl_init();   // Initializes a new session and return a cURL handle for use with the 'curl_setopt()', 'curl_exec()', and 'curl_close()' functions
			
			// Set the url, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, $url);   // The URL to fetch. This can also be set when initializing a session with 'curl_init()'
			
			curl_setopt($ch, CURLOPT_POST, true);   // 'true' to do a regular HTTP POST, most commonly used by HTML forms
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);   // An array of HTTP header fields to set, in the format "array('Content-type: text/plain', 'Content-length: 100')"  
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));   // The full data to post in a HTTP 'POST' operation. To post a file, prepend a filename with '@' and use the full path
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   // 'true' to return the transfer as a string of the return value of 'curl_exec()' instead of outputting it out directly
			
			// Disabling SSL Certificate support temporarly
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   // 'false' to stop cURL from verifying the peer's certificate		
			
			// Execute POST
			$result = curl_exec($ch);
			if ($result == false) { die('Curl failed: ' . curl_error($ch)); }
			
			// Close connection
			curl_close($ch);
			echo $result;	
		}
	}

?>