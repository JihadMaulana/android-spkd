<?php

// Include confi.php
include "../../asset/database/koneksi.php";

if($_GET['key'] == 12345){
	$stmt = $user->readSelect("kendaraan WHERE ket='active'");
	while($hasil = $stmt->fetch()){
		$cekstatus = $user->readSelect("plot_kendaraan LEFT JOIN kendaraan ON plot_kendaraan.id_kendaraan=kendaraan.id_kendaraan LEFT JOIN peminjaman ON plot_kendaraan.id_peminjaman=peminjaman.id_peminjaman WHERE kendaraan.id_kendaraan='".$hasil['id_kendaraan']."' AND peminjaman.status_peminjaman <> 'Canceled'");
     	$datacek = $cekstatus->fetchall();
     	$now = new DateTime();
        $count =0;
        for ($i=0; $i < $cekstatus->rowCount() ; $i++) {
            $before = new DateTime($datacek[$i]['waktu_pinjam']);
            $after = new DateTime($datacek[$i]['waktu_kembali']);
            if ( $before <= $now && $now <= $after) {
                $count = $count + 1;
            }
        }
        if ($count==0) {
            $result[] = array($hasil, "status" => "Kosong");
        }else{
           $result[] = array($hasil, "status" => "Digunakan");
        }
 	}
	if (isset($result)) {
 		$json =array("status" => 1, "data" => $result);
 	}else{
 		$json =array("status" => 0, "msg" => "no data");
 	}
}else{
	$json = array("status" => 0, "msg" => "Access Denied");
}

@mysql_close($user);

/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);