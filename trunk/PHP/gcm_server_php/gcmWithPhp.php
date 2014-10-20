<?php
    // Replace with the real server API key from Google APIs
	define('GOOGLE_API_KEY', 'AIzaSyCoDqoODh55jMEMLFA9DU3yENLXG3LA1Xk');

    // Replace with the real client registration IDs
    $registrationIDs = array("APA91bERXBifLfDQC8jJr-Dx0oANamovURdHQXcnfj8CImA1bWsriRhm2ks89psRGsz8KCvpXNqGSyDeHcULLd2DGkbErjuHwNC6WZXbcl8nVygBlUf7De2ZTYAeKO98Yo4OIH6FuDCMXtbcWvik6tzL89xqzaOi11iFUWjPkPbcP15S8t1zg8s");
    // $registrationIDs = array("APA91bEhpgSb1ksvZpWZ0G7amew7Vb_fsaZeoxkcOxJI6oc952rEivZ2M-nneWiXKqkiGXAf_d_1u-MZoLa8VYOwazr1R_fJWkEv3vI-YWcdN5xoS5r72YDPCAFe-QoDZ2l8ipsikJPAcT_-HfQ3TcItMKcEEKNn7KRYGGeAFYl-APF8pUOcZ0c");
	
    // Message to be sent
    $message = "Hi, Swansea City fan!!";

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

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    // Execute post
    $result = curl_exec($ch);

    // Close connection
    curl_close($ch);
    echo $result;
    //print_r($result);
    //var_dump($result);
?>