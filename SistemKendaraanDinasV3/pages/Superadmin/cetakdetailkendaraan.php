<?php
    $id = $_GET['id_kendaraan'];
    $detkendaraan = $user->readSelect("Kendaraan WHERE id_kendaraan='".$id."'");
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
                <table>
                    <tr>
                        <td><label for='' class='col-sm-4 control-label'>ID Kendaraan</label><td>
                        <td><label for='' class='col-sm-4 control-label'><?php echo ": ".$datakendaraan['id_kendaraan']; ?></label><td>
                    </tr>

                    <tr>
                        <td><label for='' class='col-sm-12 control-label'>Nama Kendaraann</label><td>
                       <td> <label for='' class='col-sm-12 control-label'><?php echo ": ".$datakendaraan['nama_kendaraan']; ?></label><td>
                    </tr>

                    <tr>
                       <td> <label for='' class='col-sm-12 control-label'>Merk</label><td>
                      <td>  <label for='' class='col-sm-12 control-label'><?php echo ": ".$datakendaraan['merk_kendaraan'] ?></label> <td>
                    </tr> 

                    <tr>
                       <td> <label for='' class='col-sm-12 control-label'>Tahun Produksi</label><td>
                       <td> <label for='' class='col-sm-12 control-label'><?php echo ": ".$datakendaraan['tahun_produksi']; ?></label> <td>
                    </tr>

                    <tr>    
                       <td> <label for='' class='col-sm-12 control-label'>No. BPKB</label><td>
                       <td> <label for='' class='col-sm-12 control-label'><?php echo ": ".$datakendaraan['bpkb_kendaraan']; ?></label><td>
                    </tr>
                    <tr>
                       <td> <label for='' class='col-sm-12 control-label'>No. Polisi Merah</label><td>
                       <td> <label for='' class='col-sm-12 control-label'><?php echo ": ".$datakendaraan['nomor_polisi_merah']; ?></label><td>
                    </tr>
                    <tr>
                       <td> <label for='' class='col-sm-12 control-label'>No. Polisi Hitam</label><td>
                      <td>  <label for='' class='col-sm-12 control-label'><?php echo ": ".$datakendaraan['nomor_polisi_hitam']; ?></label><td>
                    </tr>
                </table>
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
            $servis = strtotime($dataservis[$i-1]['tanggal_servis']);
            $awal = strtotime($_GET['dari_servis']);
            $akhir = strtotime($_GET['sampai_servis']);
            if ($awal <= $servis && $servis <= $akhir) { 
        ?>
                        <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo$dataservis[$i-1]['id_servis']; ?></td>
                        <td><?php
                            $d = new DateTime($dataservis[$i-1]['tanggal_servis']);
                            echo $d->format('d-M-Y');
                        ?></td>
                        <td><?php echo $dataservis[$i-1]['keterangan']; ?></td>
                        </tr>
        <?php
            }
        } 
        ?>
                   </tbody>
            </table>
                </div>
    </div>
            </form>
<script type="text/javascript">
    $(document).ready(function(){
        window.print();
        
    });
    
</script>