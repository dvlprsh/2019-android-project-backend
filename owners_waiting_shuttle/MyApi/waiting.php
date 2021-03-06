<?php 
 
 /*
 * Created by Belal Khan
 * website: www.simplifiedcoding.net 
 * Retrieve Data From MySQL Database in Android
 */
 
 //database constants
 define('DB_HOST', 'localhost');
 define('DB_USER', 'seohee');
 define('DB_PASS', password);
 define('DB_NAME', 'waiting_shuttle');
 
 //connecting to database and getting the connection object
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 (int) $owner_id = $_POST["owner_id"];
 //creating a query
 $stmt = $conn->prepare("SELECT id, user_id, user_userID , phone, person_number FROM waiting where owner_id= ?;"); //고쳐야함
 
 $stmt->bind_param("i", $owner_id);
 $conn->set_charset("utf8"); 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($id,$user_id, $user_userID, $phone, $person_number);
 
 $products = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
//$temp=['id']=$id;
 $temp['id'] = $id; 

 $temp['user_id'] = $user_id;
 $temp['user_userID']=$user_userID;
 $temp['phone'] = $phone;
 $temp['person_number']=$person_number;
 array_push($products, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($products);
 ?>