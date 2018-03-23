<?php

// Include confi.php
include "../../asset/database/koneksi.php";

if($_GET['key'] == 12345){
	$stmt = $DB_con->prepare("SELECT id_peminjaman, nama, tujuan_peminjaman, waktu_pinjam, waktu_kembali, status_peminjaman from user RIGHT JOIN peminjaman ON user.id_pengguna=peminjaman.id_peminjam");
	$stmt->execute();
	while($hasil = $stmt->fetch()){
		$result[] = array("id_peminjaman" => $hasil['id_peminjaman'], "nama" => $hasil['nama'], "tujuan_peminjaman" => $hasil['tujuan_peminjaman'], "waktu_pinjam" => $hasil['waktu_pinjam'], "waktu_kembali" => $hasil['waktu_pinjam'], "status_peminjaman" => $hasil['status_peminjaman']); 
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