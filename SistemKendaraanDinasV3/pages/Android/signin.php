<?php

// Include confi.php
include "../../asset/database/koneksi.php";

if(isset($_GET['id'])&&isset($_GET['pass'])){
	// Get data
	$id = $_GET['id'];
	$pass = $_GET['pass'];
	// Insert data into data base
	$query = $DB_con->prepare("SELECT * FROM user WHERE id_pengguna = :id_pengguna AND Password = :Password");
	$query->bindParam(":id_pengguna", $id);
    $query->bindParam(":Password", $pass);
	$query->execute();
    $data = $query->fetch();
    if($query->rowCount() > 0){
        // jika password yang dimasukkan sesuai dengan yg ada di database
        if(($pass == $data['password'])){
            $json = array("status" => 1, "msg" => "Login berhasil", "akses" => $data['id']);
        }else{
             $json = array("status" => 0, "msg" => "Login gagal, password tidak cocok", "akses" => 0);
        }
    }else{
             $json = array("status" => 0, "msg" => "Login gagal, id tidak ditemukan", "akses" => 0);
    }
}else{
	$json = array("status" => 0, "msg" => "Request method not accepted", "akses" => 0);
}

@mysql_close($user);

/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);