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

<table class="table table-striped table-bordered data">
            <thead>
  <!--DWLayoutTable-->
                <tr>
                <th>Id Peminjam</th>
                <th>Nama Peminjam</th>
                <th>Tujuan</th>
                <th>Berangkat</th>
                <th>Pulang</th>
                <th>Status</th>
                <th>Action</th>
        <!--<td width="134" align="center" valign="middle" >Foto</td>-->
                </tr>
            </thead>
            <tbody>
            <?php
                    if (!empty($_POST['daritampil'])&&!empty($_POST['sampaitampil'])) {
                        $daritampil = $_POST['daritampil']." 00:00:00";
                        $sampaitampil = $_POST['sampaitampil']." 00:00:00";
                        $stmt = $DB_con->prepare("SELECT id_peminjaman, nama, tujuan_peminjaman, waktu_pinjam, waktu_kembali, status_peminjaman from user RIGHT JOIN peminjaman ON user.id_pengguna=peminjaman.id_peminjam WHERE '$daritampil' <= peminjaman.waktu_pinjam AND peminjaman.waktu_pinjam <= '$sampaitampil'");
                    }else{
                        $stmt = $DB_con->prepare("SELECT id_peminjaman, nama, tujuan_peminjaman, waktu_pinjam, waktu_kembali, status_peminjaman from user RIGHT JOIN peminjaman ON user.id_pengguna=peminjaman.id_peminjam");
                    }                   
                    $stmt->execute();
                     while($hasil = $stmt->fetch()){
            ?>
            <tr>
                <td><?php echo $hasil['id_peminjaman'];?></td>
                <td><?php echo $hasil['nama'];?></td>
                <td><?php echo $hasil['tujuan_peminjaman'];?></td>
                <td><?php
                    $d = new DateTime($hasil['waktu_pinjam']);
                    echo $d->format('d-M-Y\ H:i:s');
                 ?></td>
                <td><?php
                    $d = new DateTime($hasil['waktu_kembali']);
                    echo $d->format('d-M-Y\ H:i:s');
                ?></td>
                <td><?php echo $hasil['status_peminjaman'];?></td>
                <td><a class="btn btn-sm btn-primary" href="<?php echo "?page=home&rowidpermintaan=".$hasil['id_peminjaman']."&status=".$hasil['status_peminjaman']; ?>"> Detail </a></td>
                </tr>
                <?php } ?>
            </tr>
            </tbody>
    </table>
    <script type="text/javascript">
    $(document).ready(function(){
        $('.data').DataTable();
        
    });
    
    </script>