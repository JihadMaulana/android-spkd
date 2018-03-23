<?php
    include "../../asset/database/koneksi.php";
    if(isset($_POST['rowid'])) {
        $id = $_POST['rowid'];
        $detail = $user->getDetail($id);
        $data = $detail->fetchall();
        echo "<form method='POST' enctype='multipart/form-data' class='form-inline'>";
        echo        "<div class='rows'>";
        echo            "<div class='form-group'>";
        echo                "<label for='' class='col-sm-4 control-label'>ID Peminjaman</label>";

        echo                    "<label for='' class='col-sm-4 control-label'>".$data[0]['id_peminjaman']."</label>";                    

        echo            "<div class='form-group'>";
        echo                "<label for='' class='col-sm-4 control-label'>Tujuan Peminjaman</label>";

        echo                    "<label for='' class='col-sm-4 control-label'>".$data[0]['tujuan_peminjaman']."</label>";                    

        echo            "<div class='form-group'>";
        echo                "<label for='' class='col-sm-4 control-label'>Jumlah Kendaraan</label>";

        echo                    "<label for='' class='col-sm-4 control-label'>".$data[0]['jumlah_kendaraan']."</label>";                    

        echo            "<div class='form-group'>";
        echo                "<label for='' class='col-sm-4 control-label'>Waktu Peminjaman</label>";

        echo                    "<label for='' class='col-sm-8 control-label'>".$data[0]['waktu_pinjam']."</label>";     
        echo                "<label for='' class='col-sm-4 control-label'>Keterangan</label>";

        echo                    "<label for='' class='col-sm-8 control-label'>".$data[0]['keterangan_peminjaman']."</label>";
        echo                "<label for='' class='col-sm-4 control-label'>Status</label>";

        echo                    "<label for='' class='col-sm-8 control-label'>".$data[0]['status_peminjaman']."</label>";             
 
        echo "<table class='table table-striped table-bordered data'>";
        echo            "<thead>";
        echo  "<!--DWLayoutTable-->";
        echo                "<tr>";
        echo                "<th>No</th>";
        echo                "<th>Supir</th>";
        echo                "<th>Kendaraan</th>";
        echo                "</tr>";
        echo            "</thead>";
        echo            "<tbody>";
        if ($data[0]['status_peminjaman']=="Accepted") {
    
        for ($i=1; $i <= $data[0]['jumlah_kendaraan'] ; $i++) { 
        echo                "<tr>";
        echo                "<td>".$i."</td>";
        echo                "<td>".$data[$i-1]['nama_supir']."</td>";
        echo                "<td>".$data[$i-1]['nama_kendaraan']."</td>";
        echo                "</tr>";
        }
        echo           "</tbody>";
        echo    "</table>";
        }
        echo        "</div>";
        echo    "</form>";
    }
?>        