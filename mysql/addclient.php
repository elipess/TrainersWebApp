<?php

if (is_ajax()) {
  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
    $action = $_POST["action"];
    switch($action) { //Switch case for value of action
      case "addnewclient": 
             {
		insert_to_db();
		break;
             }
    }
  }
}

//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function insert_to_db(){
	
  $name = $_POST['full_name'];
  $email = $_POST['email'];
  $telephone = $_POST['telephone'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $date = date("Y-m-d ");
  $weight = $_POST['weight'];
  $height = $_POST['height'];
  $level = $_POST['level'];
  $type = $_POST['client_type'];
  $client_active = 1;
    
	
	// Create connection
	$conn = new mysqli("localhost", "", "", "");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

  $sql = "INSERT  INTO EDIT_CLIENTS_DETAILS  ( CLIENTS_NAME, EMAIL, TELEPHONE, AGE, GENDER, REGISTERED_DATE, TYPE, LEVEL,  WEIGHT, HEIGHT, CLIENT_ACTIVE)
	VALUES ( '$name', '$email', '$telephone', '$age', '$gender', '$date', '$type', '$level', '$weight', '$height', '$client_active' )";
	

	if ($conn->query($sql) === TRUE) {
		$return = $_POST;
    
                $return["json"] = json_encode($return);

                echo json_encode($return);
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();	
}
?>