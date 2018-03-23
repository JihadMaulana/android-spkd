<?php 
if(isset($_POST['kirim']))
  {
    $id_supir=$_POST['id_supir'];
    $nama_supir=$_POST['nama_supir'];
    $no_telepon_supir=$_POST['no_telepon_supir'];
    $alamat_supir=$_POST['alamat_supir'];
    $from = "supir WHERE id_supir= '".$id_supir."' AND ket= 'deleted'";
    $cek = $user->readSelect($from);
    $datacek = $cek->fetch();
    // if no error occured, continue ....
    if(!isset($errMSG))
    {
      if (isset($datacek['ket'])) {
       $stmt = $DB_con->prepare("UPDATE supir SET id_supir = :id_supir, nama_supir = :nama_supir, no_telepon_supir = :no_telepon_supir, alamat_supir = :alamat_supir, ket = 'active' WHERE supir.id_supir = :id");
        $stmt->bindParam(':id_supir',$id_supir);
        $stmt->bindParam(':nama_supir',$nama_supir);
        $stmt->bindParam(':no_telepon_supir',$no_telepon_supir);
        $stmt->bindParam(':alamat_supir',$alamat_supir);
        $stmt->bindParam(':id',$id_supir);
        if($stmt->execute())
        {
          $successMSG = "new record succesfully inserted ...";
        }
        else
        {
          $errMSG = "error while inserting....";
        }
      }else{
        $stmt = $DB_con->prepare("INSERT INTO supir (id_supir,nama_supir,no_telepon_supir,alamat_supir,ket) VALUES(:id_supir,:nama_supir,:no_telepon_supir,:alamat_supir,'active')");
        $stmt->bindParam(':id_supir',$id_supir);
        $stmt->bindParam(':nama_supir',$nama_supir);
        $stmt->bindParam(':no_telepon_supir',$no_telepon_supir);
        $stmt->bindParam(':alamat_supir',$alamat_supir);
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
                                    <input type="text" name="id_supir" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">Nama</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="nama_supir" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">Nomor Telp.</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="no_telepon_supir" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">Alamat Supir</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="alamat_supir" class="form-control" required=""/>
                                    </div>
                                </div>
                        <div align="center"><button type="submit" name="kirim" class="btn btn-default">Submit</button></div>
                    </div>
                </form>