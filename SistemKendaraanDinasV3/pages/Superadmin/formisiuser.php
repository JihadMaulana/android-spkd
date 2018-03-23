<?php 
include ('../../asset/database/koneksi.php');
if(isset($_POST['kirim']))
  {
    $id_pengguna=$_POST['id_pengguna'];
    $nama=$_POST['nama'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $no_telepon=$_POST['no_telepon'];
    $from = "user WHERE id_pengguna= '".$id_pengguna."' AND ket= 'deleted'";
    $cek = $user->readSelect($from);
    $datacek = $cek->fetch();
    // if no error occured, continue ....
    if(!isset($errMSG))
    {
        if (isset($datacek['ket'])) {
            $stmt = $DB_con->prepare("UPDATE user SET id_pengguna = :id_pengguna, nama = :nama, password = :password, email = :email, no_telepon = :no_telepon, id = '3', ket = 'active' WHERE user.id_pengguna = :id");
          $stmt->bindParam(':id_pengguna',$id_pengguna);
          $stmt->bindParam(':nama',$nama);
          $stmt->bindParam(':password',$password);
          $stmt->bindParam(':email',$email);
          $stmt->bindParam(':no_telepon',$no_telepon);
          $stmt->bindParam(':id',$id_pengguna);
            if($stmt->execute())
          {
            $successMSG = "new record succesfully inserted ...";
          }
          else
          {
            $errMSG = "error while inserting....";
          }
        }else{
          $stmt = $DB_con->prepare("INSERT INTO user (id_pengguna,nama,email,password,no_telepon,id) VALUES(:id_pengguna,:nama,:email,:password,:no_telepon,'3')");
          $stmt->bindParam(':id_pengguna',$id_pengguna);
          $stmt->bindParam(':nama',$nama);
          $stmt->bindParam(':email',$email);
          $stmt->bindParam(':password',$password);
          $stmt->bindParam(':no_telepon',$no_telepon);
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
                                    <input type="text" name="id_pengguna" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">Nama</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="nama" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="email" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">Password</label>
                                    <div class="col-sm-4">
                                    <input type="password" name="password" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">Nomor Telp.</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="no_telepon" class="form-control" required=""/>
                                    </div>
                                </div>
                        <div align="center"><button type="submit" name="kirim" class="btn btn-default">Submit</button></div>
                    </div>
                </form>