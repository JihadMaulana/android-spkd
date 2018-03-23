 <form method='POST' enctype='multipart/form-data' class='form-inline'>
    <div class="header">
        <h2 class="title">Laporan Peminjaman Kendaraan</h2>
    </div>
    <div class="body">
        <table class="table table-striped table-bordered data">
            <thead>
  <!--DWLayoutTable-->
                <tr>
                <th>Id Peminjam</th>
                <th>Nama Peminjam</th>
                <th>Tujuan</th>
                <th>Jumlah Kendaran</th>
                <th>Tanggal Peminjaman</th>
                <th>Kendaraan</th>
                <th>Supir</th>
                <th>Keterangan</th>
        <!--<td width="134" align="center" valign="middle" >Foto</td>-->
                </tr>
            </thead>
            <tbody>
            <?php
                    $dari = $_GET['dari_peminjaman'];
                    $sampai = $_GET['sampai_peminjaman'];
                    $stmt = $DB_con->prepare("SELECT * from user RIGHT JOIN peminjaman ON user.id_pengguna=peminjaman.id_peminjam");
                    $stmt->execute();
                     while($hasil = $stmt->fetch()){
                        if (!empty($_POST['dari_peminjaman']) && !empty($_POST['sampai_peminjaman'])) {
                            if ($dari <= $hasil['waktu_pinjam'] && $hasil['waktu_pinjam']<=$sampai) {
                            $id_peminjaman = $hasil['id_peminjaman'];
                            $stmtlist = $DB_con->prepare("SELECT * from plot_kendaraan LEFT JOIN kendaraan ON plot_kendaraan.id_kendaraan=kendaraan.id_kendaraan LEFT JOIN supir ON plot_kendaraan.id_supir=supir.id_supir LEFT JOIN peminjaman ON plot_kendaraan.id_peminjaman=peminjaman.id_peminjaman WHERE plot_kendaraan.id_peminjaman= $id_peminjaman AND peminjaman.status_peminjaman <> 'Canceled'");
                        }
                        }else{
                            $id_peminjaman = $hasil['id_peminjaman'];
                            $stmtlist = $DB_con->prepare("SELECT * from plot_kendaraan LEFT JOIN kendaraan ON plot_kendaraan.id_kendaraan=kendaraan.id_kendaraan LEFT JOIN supir ON plot_kendaraan.id_supir=supir.id_supir LEFT JOIN peminjaman ON plot_kendaraan.id_peminjaman=peminjaman.id_peminjaman WHERE plot_kendaraan.id_peminjaman= $id_peminjaman AND peminjaman.status_peminjaman <> 'Canceled'");
                        }
                        
                        $stmtlist->execute();
                        $datalist = $stmtlist->fetchall();
            ?>
            <tr>
                <td><?php echo $hasil['id_peminjaman'];?></td>
                <td><?php echo $hasil['nama'];?></td>
                <td><?php echo $hasil['tujuan_peminjaman'];?></td>                
                <td><?php echo $hasil['jumlah_kendaraan'];?></td>
                <td><?php
                $date = strtotime($hasil['waktu_pinjam']);
                $cetakdate = date("j-M-Y",$date);
                 echo $cetakdate ?></td>
                 <td><?php for ($i=0; $i < $stmtlist->rowCount() ; $i++) { 
                     echo "<p>- ".$datalist[$i]['nama_kendaraan']."</p>";
                 } ?></td>
                 <td><?php for ($i=0; $i < $stmtlist->rowCount() ; $i++) { 
                     echo "<p>- ".$datalist[$i]['nama_supir']."</p>";
                 } ?></td>
                 <td><?php echo $hasil['keterangan_peminjaman'];?></td>

                <?php } ?>
            </tr>
            </tbody>
    </table>
                </div>
            </form>
<script type="text/javascript">
    $(document).ready(function(){
        window.print();
        
    });
    
</script>