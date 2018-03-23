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
    if (isset($_GET['cancel'])) {
        $id_peminjaman = $_GET['idpeminjaman'];
        $table = "peminjaman";
        $value = "status_peminjaman = 'Canceled' WHERE peminjaman.id_peminjaman = '".$id_peminjaman."' AND status_peminjaman <> 'Rejected'";
        $user->updatePlot($table,$value);
    }
?>
<table class="table table-striped table-bordered data">
            <thead>
  <!--DWLayoutTable-->
                <tr>
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
                        $idsession = $_SESSION['user_session'];
                        $stmt = $DB_con->prepare("SELECT id_peminjaman, nama, tujuan_peminjaman, waktu_pinjam, waktu_kembali, status_peminjaman from user RIGHT JOIN peminjaman ON user.id_pengguna=peminjaman.id_peminjam WHERE user.id_pengguna= '$idsession' AND '$daritampil' <= peminjaman.waktu_pinjam AND peminjaman.waktu_pinjam <= '$sampaitampil'");
                    }else{
                        $stmt = $DB_con->prepare("SELECT id_peminjaman, nama, tujuan_peminjaman, waktu_pinjam, waktu_kembali, status_peminjaman from user RIGHT JOIN peminjaman ON user.id_pengguna=peminjaman.id_peminjam WHERE user.id_pengguna='".$_SESSION['user_session']."'");
                    }
                    $stmt->execute();
                     while($hasil = $stmt->fetch()){
            ?>
            <tr>
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
                <td>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-id = "<?php echo $hasil['id_peminjaman'];?>">Detail </a>
                    <a class="btn btn-danger" href="<?php echo "?hall=home&cancel=1&idpeminjaman=".$hasil['id_peminjaman'] ?>">Cancel</a>
                </td>
                <?php } ?>

            </tr>
            

            </tbody>
    </table>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detail Peminjaman</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
        $('.data').DataTable();
        $('#myModal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'formdetail.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database
            }
        });
     });
    });
    
    </script>
