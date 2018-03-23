<?php 
include ('../../asset/database/koneksi.php');
if(isset($_POST['kirim']))
  {
    $id_kendaraan=$_POST['id_kendaraan'];
    $nama_kendaraan=$_POST['nama_kendaraan'];
    $merk_kendaraan=$_POST['merk_kendaraan'];
    $tahun_produksi=$_POST['tahun_produksi'];
    $bpkb_kendaraan=$_POST['bpkb_kendaraan'];
    $nomor_polisi_merah=$_POST['nomor_polisi_merah'];
    $nomor_polisi_hitam=$_POST['nomor_polisi_hitam'];
    $nomor_mesin=$_POST['nomor_mesin'];
    $from = "kendaraan WHERE id_kendaraan= '".$id_kendaraan."' AND ket= 'deleted'";
    $cek = $user->readSelect($from);
    $datacek = $cek->fetch();
    // if no error occured, continue ....
    if(!isset($errMSG))
    {
        if (isset($datacek['ket'])) {
            $stmt = $DB_con->prepare("UPDATE kendaraan SET id_kendaraan = :id_kendaraan, nama_kendaraan = :nama_kendaraan, merk_kendaraan = :merk_kendaraan, tahun_produksi = :tahun_produksi, bpkb_kendaraan = :bpkb_kendaraan, nomor_polisi_merah = :nomor_polisi_merah, nomor_polisi_hitam = :nomor_polisi_hitam, nomor_mesin = :nomor_mesin, ket = 'active' WHERE kendaraan.id_kendaraan = :id");
              $stmt->bindParam(':id_kendaraan',$id_kendaraan);
              $stmt->bindParam(':nama_kendaraan',$nama_kendaraan);
              $stmt->bindParam(':merk_kendaraan',$merk_kendaraan);
              $stmt->bindParam(':tahun_produksi',$tahun_produksi);
              $stmt->bindParam(':bpkb_kendaraan',$bpkb_kendaraan);
              $stmt->bindParam(':nomor_polisi_merah',$nomor_polisi_merah);
              $stmt->bindParam(':nomor_polisi_hitam',$nomor_polisi_hitam);
              $stmt->bindParam(':nomor_mesin',$nomor_mesin);
              $stmt->bindParam(':id',$id_kendaraan);
              if($stmt->execute())
              {
                $successMSG = "new record succesfully inserted ...";
              }
              else
              {
                $errMSG = "error while inserting....";
              }
        }else{
              $stmt = $DB_con->prepare("INSERT INTO Kendaraan (id_kendaraan,nama_kendaraan,merk_kendaraan,tahun_produksi,bpkb_kendaraan,nomor_polisi_merah,nomor_polisi_hitam,nomor_mesin,status_kendaraan,ket) VALUES(:id_kendaraan,:nama_kendaraan,:merk_kendaraan,:tahun_produksi,:bpkb_kendaraan,:nomor_polisi_merah,:nomor_polisi_hitam,:nomor_mesin,'Stand By','active')");
              $stmt->bindParam(':id_kendaraan',$id_kendaraan);
              $stmt->bindParam(':nama_kendaraan',$nama_kendaraan);
              $stmt->bindParam(':merk_kendaraan',$merk_kendaraan);
              $stmt->bindParam(':tahun_produksi',$tahun_produksi);
              $stmt->bindParam(':bpkb_kendaraan',$bpkb_kendaraan);
              $stmt->bindParam(':nomor_polisi_merah',$nomor_polisi_merah);
              $stmt->bindParam(':nomor_polisi_hitam',$nomor_polisi_hitam);
              $stmt->bindParam(':nomor_mesin',$nomor_mesin);
              if($stmt->execute())
              {
                $successMSG = "new record succesfully inserted ...";
              }
              else
              {
                $errMSG = "error while inserting....";
              }
    }
    }
  }
?>

            <form method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <div class="rows">
                                <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">ID</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="id_kendaraan" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">Nama Kendaraan</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="nama_kendaraan" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">Merk</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="merk_kendaraan" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">Tahun Produksi</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="tahun_produksi" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">BPKB</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="bpkb_kendaraan" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">NoPol Merah</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="nomor_polisi_merah" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">NoPol Hitam</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="nomor_polisi_hitam" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">Nomor Mesin</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="nomor_mesin" class="form-control" required=""/>
                                    </div>
                                </div>
                        <div align="center"><button type="submit" name="kirim" class="btn btn-default">Submit</button></div>
                    </div>
                </form>