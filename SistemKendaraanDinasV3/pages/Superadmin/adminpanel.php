<?php
include "../../asset/database/koneksi.php";
session_start();
if (!isset($_SESSION['user_session'])){
    header('Location:../Users/loginpage.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
<?php include ('headeradmin.php');?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="adminpanel.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>BI</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Bank</b>Indonesia</span>

    </a>

   

    <!-- Header Navbar: style can be found in header.less -->
  <?php
    include ('navbaradmin.php') 
  ?>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../asset/pict/logobi.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Superadmin</p>
          <a href="#">Sistem Peminjaman Kendaraan</a>
        </div>
      </div>
      <!-- search form -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php if(empty($_GET['page']) || $_GET['page']=="home"){
          echo "active";
    }else {
          echo "";
    }    ?> treeview">
          <a href="?page=home">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="<?php if($_GET['page']=="kendaraan"){
          echo "active";
    }else {
          echo "";
    }    ?> treeview">
          <a name="kendaraan" href="?page=kendaraan">
            <i class="fa fa-car"></i>
            <span>Kendaraan</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li class="<?php if($_GET['page']=="admin"){
          echo "active";
    }else {
          echo "";
    }    ?> treeview">
          <a href="?page=admin">
            <i class="fa fa-user-secret"></i> <span>Admin</span>
          </a>
        </li>
        <li class="<?php if($_GET['page']=="user"){
          echo "active";
    }else {
          echo "";
    }    ?> treeview">
          <a href="?page=user">
            <i class="fa fa-users"></i> <span>Users</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class=" <?php if($_GET['page']=="supir"){
          echo "active";
    }else {
          echo "";
    }    ?> treeview">
          <a href="?page=supir">
            <i class="fa fa-user"></i>
            <span>Supir</span>
          </a>
        </li>
        <li class="<?php if($_GET['page']=="laporan"){
          echo "active";
    }else {
          echo "";
    }    ?> treeview">
          <a name="laporan" href="?page=laporan">
            <i class="fa fa-files-o"></i>
            <span>Cetak Laporan</span>
          </a>
        </li

>
              
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Permintaan Peminjaman Kendaraan</small>
      </h1>
      <ol class="breadcrumb">
      <li>
      <?php if(empty($_GET['page']) || $_GET['page']=="home"){
          echo " 
        <form method='post' enctype='multipart/form-data' class='form-inline'>
      <div class='form-group'>
       <input  type='date' class='form-control' name='daritampil'> 
      </div>
      <div class='form-group'>
        <label class='control-label'>Sampai</label>   
      </div>
      <div class='form-group'>
       <input  type='date' class='form-control' name='sampaitampil'> 
      </div>
      <div class='form-group'>
       <button class='btn btn-primary' type= 'submit'>Cari Tanggal</button>
      </div>
      </form>";
    }else {
          include "popup.php";
    } ?>
      </li>
      </ol>
    </section>
    <br>
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
    <?php
    if(empty($_GET['page']) || $_GET['page']=="home"){
          if (empty($_GET['rowidpermintaan'])) {
            include "tablepermintaan.php";
          }else{
            if($_GET['status']=="Pending"){
              include "formacc.php";
            }else{
              include "formdetail.php";
            }
            
          }
    }else if($_GET['page']=="kendaraan"){
        if (empty($_GET['rowidkendaraan'])) {
          if (isset($_GET['tambahservis'])) {
            include "formisiservis.php";
          }else{
            include "tablekendaraan.php";
          }
          
        }else{
            include "formdetailkendaraan.php";
          
          
        }
          
    }else if($_GET['page']=="user"){
          include "tableuser.php";
    }else if ($_GET['page']=="admin") {
          include "tableadmin.php"; 
    }else if ($_GET['page']=="supir") {
          include "tablesupir.php"; 
    }else if ($_GET['page']=="laporan") {
          include "laporan.php"; 
    }
?>
        </div>
    <!-- Modal -->
        </div>
     </section>
  </div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    </footer>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>


<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<!-- Bootstrap 3.3.6 -->
<script src="../../asset/css/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../asset/css/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../asset/css/dist/js/app.min.js"></script>
<!-- Sparkline -->
<!-- jvectormap -->
<script src="../../asset/css/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../../asset/css/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="../../asset/css/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="../../asset/css/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../asset/css/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../asset/css/dist/js/demo.js"></script>
</body>
</html>
