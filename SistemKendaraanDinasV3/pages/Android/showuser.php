<?php

// Include confi.php
include "../../asset/database/koneksi.php";

if($_GET['key'] == 12345){
	// Insert data into data base
	$stmt = $DB_con->prepare("SELECT * from user");
	$stmt->execute();
	while($hasil = $stmt->fetch()){
		$result[] = $hasil; 
 	}
 	if (isset($result)) {
 		$json =array("status" => 1, "data" => $result);
 	}else{
 		$json =array("status" => 0, "msg" => "no data");
 	}
		
}else{
	$json = array("status" => 0, "msg" => "Access Denied");
}

@mysql_close($DB_con);

/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);