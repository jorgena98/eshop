<?php
$dsn = 'mysql:dbname=shop;host=localhost';
$user = 'root';
$password = '';

try
{
	$db = new PDO($dsn,$user,$password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "PDO error".$e->getMessage();
	die();
}


?>