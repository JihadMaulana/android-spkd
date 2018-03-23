<?php

// Include confi.php
include "../../asset/database/koneksi.php";

if($_GET['key'] == 12345 && isset($_GET['iduser'])){
	// Insert data into data base
	$id_user = $_GET['iduser'];
	$stmt = $DB_con->prepare("SELECT * from user RIGHT JOIN peminjaman ON user.id_pengguna=peminjaman.id_peminjam WHERE user.id_pengguna='".$id_user."'");
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