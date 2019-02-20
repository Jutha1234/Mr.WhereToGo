<?php
 
	header('Content-Type: text/html; charset=utf-8');
	header("Content-type: application/json; charset=utf-8");
 	
	$conn = new PDO('mysql:host=103.70.5.65;dbname=haaohcom_nsd;charset=utf8', 'haaohcom_nsd', 'netkaquartz');
 
   	if(!$conn){
   	   echo "Error : Unable to open database\n";
   	}
	
   	
   	

?>