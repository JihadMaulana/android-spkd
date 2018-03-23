<?php
	//session_start();
	$db_host ='localhost';
	$db_usn = 'root';
	$db_pwd = '';
	$db_name = 'sistemkendaraan';

	try {
 		$DB_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_usn,$db_pwd);
 		$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 	} catch (PDOException $e) {
 		echo $e->getMessage();
 	}

 	include_once 'aksi.php';
 	$user = new users($DB_con);
?>	