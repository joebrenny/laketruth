<?php
//define database related variables
$serverName = 'localhost';
$userName = 'root';
$password = '';
$dbname = 'laketruth';

//try to connect to databse
try{
	$db = new PDO("mysql:host=$serverName;dbname=$dbname",$userName, $password);

	$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){
		echo"Error in connection " . $e->getMessage();
}
echo "Connection Susscessfull";
?>
