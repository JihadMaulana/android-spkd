<?php
        $id = $_GET['rowidpermintaan'];
        $detPermintaan = $user->readSelect("peminjaman WHERE id_peminjaman=".$id);
        $detSupir = $user->readSelect("supir") ;
        $detKendaraan = $user->readSelect("kendaraan");
        
        $dataPermintaan = $detPermintaan->fetch();
        $dataSupir = $detSupir->fetchall();
        $dataKendaraan = $detKendaraan->fetchall();
        
        if (isset($_POST['terima'])) {
            if ($dataPermintaan['status_peminjaman'] == "Pending") {
                for ($i=1; $i<= $dataPermintaan['jumlah_kendaraan'] ; $i++) { 
                $varSupir = "supir".$i;
                $varKendaraan = "kendaraan".$i;
                $kendaraan = $_POST[$varKendaraan];
                $supir = $_POST[$varSupir];

                $tablePlot = "`plot_kendaraan` (`id_plot`, `id_peminjaman`, `id_kendaraan`, `id_supir`, `ket`)";
                $valuePlot = "(NULL, '".$id."', '".$kendaraan."', '".$supir."', 'ready')";
                $user->insertPlot($tablePlot, $valuePlot);

            }
            $tablePeminjaman = "peminjaman";
            $valuePeminjaman = "`status_peminjaman` = 'Accepted' WHERE `peminjaman`.`id_peminjaman` = '".$id."'";
            $user->updatePlot($tablePeminjaman, $valuePeminjaman);
            echo "
        <div class='alert alert-success fade in'>
            <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            Silahkan click kembali!
        </div> ";
            }else{
                echo "
        <div class='alert alert-success fade in'>
            <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            Silahkan click kembali!
        </div> ";
            }
            
        }
        if (isset($_POST['tolak'])) {
            if ($dataPermintaan['status_peminjaman'] == "Pending") {
                $tablePeminjaman = "peminjaman";
                $valuePeminjaman = "`status_peminjaman` = 'Rejected' WHERE `peminjaman`.`id_peminjaman` = '".$id."'";
                $user->updatePlot($tablePeminjaman, $valuePeminjaman);
                echo "<div class='alert alert-success'>Proses Berhasil Silahkan Tekan Kembali!</div> ";
            }else{
                echo "<div class='alert alert-success'>Proses Berhasil Silahkan Tekan Kembali!</div> ";
            }
             
        }
?>
 
<form id="form-data" method="POST" enctype="multipart/form-data" class="form-inline" action="#">
    <div class="header">
        <h4 class="modal-title">Detail Peminjaman</h4>
    </div>
    <div class="body">
        
            <div class="rows">
                <div class="form-group col-sm-8">
                    <label for="" class="col-sm-4 control-label">ID Peminjaman</label>
                    <label name="idPeminjaman"for="" class="col-sm-4 control-label"> <?php echo ": ".$dataPermintaan['id_peminjaman']; ?> </label>
                </div>                    
                <div class="form-group col-sm-8">
                    <label for="" class="col-sm-4 control-label">Tujuan</label>
                    <label for="" class="col-sm-4 control-label"><?php echo ": ".$dataPermintaan['tujuan_peminjaman']; ?></label>
                </div>                    
                <div class="form-group col-sm-8">
                    <label for="" class="col-sm-4 control-label">Jumlah Kendaraan</label>
                    <label name="jumlahKendaraan" for="" class="col-sm-4 control-label"><?php echo ": ".$dataPermintaan['jumlah_kendaraan']; ?></label>  
                </div>                  
                <div class="form-group col-sm-8">
                    <label for="" class="col-sm-4 control-label">Waktu Peminjaman</label>
                    <label for="" class="col-sm-8 control-label"><?php echo ": ".$dataPermintaan['waktu_pinjam']; ?></label> 
                </div>
                <div class="form-group col-sm-8">    
                    <label for="" class="col-sm-4 control-label">Keterangan</label>
                    <label for="" class="col-sm-8 control-label"><?php echo ": ".$dataPermintaan['keterangan_peminjaman']; ?></label>
                </div>
                <div class="form-group col-sm-8">
                    <label for="" class="col-sm-4 control-label">Status</label>
                    <label for="" class="col-sm-8 control-label"><?php echo ": ".$dataPermintaan['status_peminjaman']; ?></label>
                </div>            
 
                <table class="table table-striped table-bordered data">
                    <thead>
                    <!--DWLayoutTable-->
                        <tr>
                        <th>No</th>
                        <th>Supir</th>
                        <th>Kendaraan</th>
                        </tr>
                    </thead>
                    <tbody>
        <?php for ($i=1; $i <= $dataPermintaan['jumlah_kendaraan'] ; $i++) {
            $varSupir = "supir".$i;
            $varKendaraan = "kendaraan".$i;
        ?> 
                        <tr>
                        <td><?php echo "$i"; ?></td>
                <?php   echo      "<td>";
                        echo    "<select name = ".$varSupir.">";
                 for ($j=0; $j < $detSupir->rowCount() ; $j++){
                    $count = 0;
                    
                    $detCek = $user->readSelect("supir LEFT JOIN plot_kendaraan ON plot_kendaraan.id_supir=supir.id_supir LEFT JOIN peminjaman ON plot_kendaraan.id_peminjaman=peminjaman.id_peminjaman WHERE plot_kendaraan.id_supir = '".$dataSupir[$j]['id_supir']."'");
                    $dataCek = $detCek->fetchall();
                        for ($l=0; $l< $detCek->rowCount()+1 ; $l++) { 
                        if ($dataSupir[$j]['id_supir']==$dataCek[$l]['id_supir']) {
                           if ($dataPermintaan['waktu_pinjam'] <= $dataCek[$l]['waktu_kembali'] && $dataCek[$l]['waktu_pinjam'] <= $dataPermintaan['waktu_kembali']) {
                                $count = $count+1;
                            }
                        }
                        }
                            
                        if($count==0){
                            echo            "<option value='".$dataSupir[$j]['id_supir']."'>".$dataSupir[$j]['nama_supir']."</option>";
                        }
                        
                    
                    
                }
                   echo         "</select>";
                    echo    "</td>"; ?>
                        <td>
                            <select name = "<?php echo $varKendaraan; ?>">
                <?php for ($j=0; $j < $detKendaraan->rowCount() ; $j++){
                    $count = 0;
                    $detCek = $user->readSelect("kendaraan LEFT JOIN plot_kendaraan ON plot_kendaraan.id_kendaraan=kendaraan.id_kendaraan LEFT JOIN peminjaman ON plot_kendaraan.id_peminjaman=peminjaman.id_peminjaman WHERE plot_kendaraan.id_kendaraan = '".$dataKendaraan[$j]['id_kendaraan']."'");
                    $dataCek = $detCek->fetchall();
                    for ($l=0; $l< $detCek->rowCount() ; $l++) { 
                        if ($dataKendaraan[$j]['id_kendaraan']==$dataCek[$l]['id_kendaraan']) {
                            if ($dataPermintaan['waktu_pinjam'] <= $dataCek[$l]['waktu_kembali'] && $dataCek[$l]['waktu_pinjam'] <= $dataPermintaan['waktu_kembali']) {
                                $count = $count+1;
                            }
                        }
                    }
                    if ($count==0) {?>
                                <option value="<?php echo $dataKendaraan[$j]['id_kendaraan'];?>"><?php echo $dataKendaraan[$j]['nama_kendaraan']?></option>
                    <?php }
                }?>
                            </select>
                        </td>  
                        </tr>
        <?php } ?>
                    </tbody>
                </table>
            </div>
        
    </div>
    <div class="modal-footer">
    <?php
        if (isset($_POST['terima'])) {
            echo "<a href='?page=home'' class='btn btn-primary'>Kembali</a>";
        }elseif (isset($_POST['tolak'])) {
            echo "<a href='?page=home'' class='btn btn-primary'>Kembali</a>";
        }{
            echo "<button type='submit' class='btn btn btn-primary' name='terima'>Terima</button>";
            echo "<button type='submit' class='btn btn btn-danger' name='tolak'>Tolak</button>";
        }
    ?>
        
    </div>
    </form>
 <script type="text/javascript">
    $(document).ready(function(){
        $('.data').DataTable();
        
    });
    
    </script>