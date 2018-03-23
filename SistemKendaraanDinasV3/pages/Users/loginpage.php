<?php 
require_once "../../asset/database/koneksi.php";

if($user->isLoggedIn()){
        if ($_SESSION['id_akses'] == 1) {
                $user->redirect("../SuperAdmin/adminpanel.php");
            }elseif ($_SESSION['id_akses'] == 2) {
                $user->redirect("../Admin/homepage.php");
            }elseif ($_SESSION['id_akses'] == 3) {
                $user->redirect("../Users/homepage.php");
            }
    }

    //jika ada data yg dikirim
    if(isset($_POST['kirim'])){
        $id_pengguna = $_POST['id_pengguna'];
        $Password = $_POST['Password'];

        // Proses login user
        if($user->login($id_pengguna, $Password)){
          echo "<script type='text/javascript'>alert('Login Berhasil , Silahkan Masuk')</script>";
            if ($_SESSION['id_akses'] == 1) {
                $user->redirect("../SuperAdmin/adminpanel.php");
            }elseif ($_SESSION['id_akses'] == 2) {
                $user->redirect("../Admin/homepageadmin.php");
            }elseif ($_SESSION['id_akses'] == 3) {
                $user->redirect("../Users/homepage.php");
            }
        }else{
            // Jika login gagal, ambil pesan error
            echo "<script type='text/javascript'>alert('Login Gagal , Salah Password')</script>";
        }
    }
    else if(isset($_GET['logout']))
    {
      if($_GET['logout']==true)
      {
      session_start();
      session_destroy();
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<?php include "head.php" ?>
</head> 
<body class="bgedit">
<div class="container">
<br>
        <div class="card card-container">
        <div class="tittle">
            Sistem Peminjaman Kendaraan Dinas
        </div>
        <br>    
            <img id="profile-img" class="profile-img-card" src="../../asset/pict/logobi.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" name="id_pengguna" id="inputEmail" class="form-control" placeholder="Id" required autofocus>
                <input type="password" name="Password" id="inputPassword" class="form-control" placeholder="Password" required>
                <button name="kirim" class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
  
</div>
</body>
</html>