<!--<!DOCTYPE html>
<html>

  <head></head>

  <body>
  
      <p>Name: <input type="text" id="inp_1"></p>*/-->
	  <?php
		  echo "Hello folks!!";
		  
		  // Create an array to be JSON-encoded
		  $mArray = array("Pablo" => "Sordo", "Marta" => "Sordo", "Miquel" => "Aguirre");
		  header("Content-type: application/json");
		  echo json_encode(array("mArray" => $mArray));
	  ?>
  <!--</body>

</html>-->
