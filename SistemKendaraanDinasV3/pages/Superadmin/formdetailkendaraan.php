<?php
    $id = $_GET['rowidkendaraan'];
    $detkendaraan = $user->readSelect("kendaraan WHERE id_kendaraan='".$id."'");
    $detservis = $user->readSelect("servis_kendaraan WHERE id_kendaraan= '".$id."'");
    $datakendaraan = $detkendaraan->fetch();
    $dataservis = $detservis->fetchall(); 
?>        
 <form method='POST' enctype='multipart/form-data' class='form-inline'>
     <div class="header">
        <h4 class="modal-title">Detail Kendaraan</h4>
    </div>
    <div class="body">
                <div class='rows'>
                    <div class='form-group col-sm-8'>
                        <label for='' class='col-sm-4 control-label'>ID Kendaraan</label>
                        <label for='' class='col-sm-4 control-label'><?php echo ": ".$datakendaraan['id_kendaraan']; ?></label>
                    </div>

                    <div class='form-group col-sm-8'>
                        <label for='' class='col-sm-4 control-label'>Nama Kendaraann</label>
                        <label for='' class='col-sm-4 control-label'><?php echo ": ".$datakendaraan['nama_kendaraan']; ?></label>
                    </div>

                    <div class='form-group col-sm-8'>
                        <label for='' class='col-sm-4 control-label'>Merk</label>
                        <label for='' class='col-sm-4 control-label'><?php echo ": ".$datakendaraan['merk_kendaraan'] ?></label> 
                    </div> 

                    <div class='form-group col-sm-8'>
                        <label for='' class='col-sm-4 control-label'>Tahun Produksi</label>
                        <label for='' class='col-sm-4 control-label'><?php echo ": ".$datakendaraan['tahun_produksi']; ?></label> 
                    </div>

                    <div class='form-group col-sm-8'>    
                        <label for='' class='col-sm-4 control-label'>No. BPKB</label>
                        <label for='' class='col-sm-4 control-label'><?php echo ": ".$datakendaraan['bpkb_kendaraan']; ?></label>
                    </div>
                    <div class="form-group col-sm-8">
                        <label for='' class='col-sm-4 control-label'>No. Polisi Merah</label>
                        <label for='' class='col-sm-8 control-label'><?php echo ": ".$datakendaraan['nomor_polisi_merah']; ?></label>
                    </div>
                    <div class="form-group col-sm-8">
                        <label for='' class='col-sm-4 control-label'>No. Polisi Hitam</label>
                        <label for='' class='col-sm-8 control-label'><?php echo ": ".$datakendaraan['nomor_polisi_hitam']; ?></label>
                    </div>
                    <div class="form-group col-sm-8">
                        <label for='' class='col-sm-4 control-label'>Status</label>
                        <label for='' class='col-sm-8 control-label'><?php 
                    $cekstatus = $user->readSelect("plot_kendaraan LEFT JOIN kendaraan ON plot_kendaraan.id_kendaraan=kendaraan.id_kendaraan LEFT JOIN peminjaman ON plot_kendaraan.id_peminjaman=peminjaman.id_peminjaman WHERE kendaraan.id_kendaraan='".$datakendaraan['id_kendaraan']."' AND peminjaman.status_peminjaman <> 'Canceled'");
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
                        echo ": Kosong";
                    }else{
                        echo ": Digunakan";
                    }
                    ?></label>
                    </div>
 
         <table class='table table-striped table-bordered data'>
                    <thead>
          <!--DWLayoutTable-->
                        <tr>
                        <th>No</th>
                        <th>Id Servis</th>
                        <th>Tanggal Servis</th>
                        <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
        <?php
        for ($i=1; $i <= $detservis->rowCount() ; $i++) { 
        ?>
                        <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $dataservis[$i-1]['id_servis']; ?></td>
                        <td><?php
                            $d = new DateTime($dataservis[$i-1]['tanggal_servis']);
                            echo $d->format('d-M-Y');
                        ?></td>
                        <td><?php echo $dataservis[$i-1]['keterangan']; ?></td>
                        </tr>
        <?php
        } 
        ?>
                   </tbody>
            </table>
                </div>
    </div>
    <div class="modal-footer">
    <?php
        if ($_SESSION['id_akses']=="1") {
            echo "<a href=adminpanel.php?page=kendaraan&hapuskendaraan=1&idkendaraan=".$id." class='btn btn-danger'>Hapus Kendaraan</a>";

        }
    ?>
        <a href= <?php echo "adminpanel.php?page=kendaraan&tambahservis=1&idkendaraan=".$id;?> class='btn btn-info'>Tambah Servis</a>
        <a href="?page=kendaraan" class="btn btn-primary">Kembali</a>
    </div>
            </form>

<script type="text/javascript">

    $(document).ready(function(){
        $('.data').DataTable(); 
    });
    
</script>