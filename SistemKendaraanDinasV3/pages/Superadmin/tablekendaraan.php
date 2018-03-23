<style type="text/css">
.close {
    margin-top: 7px;
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}
.close:hover, .close:focus {
    color: #999999;
    text-decoration: none;
    cursor: pointer;
}
.table {
    font-family: sans-serif;
    color: #444;
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #f2f5f7;
}

.table tr th{
    background: #3c8dbc;
    color: #fff;
    font-weight: normal;
}

.table, th, td {
    padding: 8px 20px;
    text-align: center;
}
</style>
<?php 

if (isset($_GET['hapuskendaraan'])) {
        $idkendaraan=$_GET['idkendaraan'];
        $table = "kendaraan";
        $value= "`ket` = 'deleted' WHERE `id_kendaraan` = '".$idkendaraan."'";
        $user->updatePlot($table, $value);
    }
?>
<table class="table table-striped table-bordered data">
            <thead>
  <!--DWLayoutTable-->
                <tr>
                <th>ID</th>
                <th>Nama Kendaraan</th>
                <th>Merk</th>
                <th>Status</th>
                <th>Action</th>
        <!--<td width="134" align="center" valign="middle" >Foto</td>-->
                </tr>
            </thead>
            <tbody>
            <?php
                    $stmt = $user->readSelect("kendaraan WHERE ket='active'");
                     while($hasil = $stmt->fetch()){ ?>
            <tr>
                <td><?php echo $hasil['id_kendaraan']?></td>
                <td><?php echo $hasil['nama_kendaraan']?></td>
                <td><?php echo $hasil['merk_kendaraan']?></td>
                <td><?php 
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
                        echo "Kosong";
                    }else{
                        echo "Digunakan";
                    }
                    ?></td>
                <td><a class="btn btn-primary btn-sm" href="<?php echo "?page=kendaraan&rowidkendaraan=".$hasil['id_kendaraan']; ?>">Detail</a></td>
                <?php } ?>
            </tr>
            

            </tbody>
    </table>
    <script type="text/javascript">
    $(document).ready(function(){
        $('.data').DataTable();
    });</script>