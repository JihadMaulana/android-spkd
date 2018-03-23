<?php
    if($_GET['rowidpermintaan']) {
        $id = $_GET['rowidpermintaan'];
        $detail = $user->getDetail($id);
        $data = $detail->fetchall();
        
    }
?>        
 <form method='POST' enctype='multipart/form-data' class='form-inline'>
    <div class="header">
        <h4 class="modal-title">Detail Peminjaman</h4>
    </div>
    <div class="body">
                <div class='rows'>
                    <div class='form-group col-sm-8'>
                        <label for='' class='col-sm-4 control-label'>ID Peminjaman</label>
                        <label for='' class='col-sm-4 control-label'><?php echo ": ".$data[0]['id_peminjaman']; ?></label>
                    </div>
                    <div class='form-group col-sm-8'>
                        <label for='' class='col-sm-4 control-label'>Tujuan</label>
                        <label for='' class='col-sm-4 control-label'><?php echo ": ".$data[0]['tujuan_peminjaman']; ?></label>
                    </div>

                    <div class='form-group col-sm-8'>
                        <label for='' class='col-sm-4 control-label'>Jumlah Kendaraan</label>
                        <label for='' class='col-sm-4 control-label'><?php echo ": ".$data[0]['jumlah_kendaraan'] ?></label>
                    </div>                    

                    <div class='form-group col-sm-8'>
                        <label for='' class='col-sm-4 control-label'>Waktu Peminjaman</label>
                        <label for='' class='col-sm-4 control-label'><?php echo ": ".$data[0]['waktu_pinjam']; ?></label>
                    </div>

                    <div class='form-group col-sm-8'>    
                        <label for='' class='col-sm-4 control-label'>Keterangan</label>
                        <label for='' class='col-sm-4 control-label'><?php echo ": ".$data[0]['keterangan_peminjaman']; ?></label>
                    </div>

                    <div class='form-group col-sm-8'>
                        <label for='' class='col-sm-4 control-label'>Status</label>
                        <label for='' class='col-sm-4 control-label'><?php echo ": ".$data[0]['status_peminjaman']; ?></label>
                    </div>           
 
         <table class='table table-striped table-bordered data'>
                    <thead>
          <!--DWLayoutTable-->
                        <tr>
                        <th>No</th>
                        <th>Supir</th>
                        <th>Kendaraan</th>
                        </tr>
                    </thead>
                    <tbody>
        <?php 
    
        for ($i=1; $i <= $detail->rowCount() ; $i++) { ?>
                        <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data[$i-1]['nama_supir']; ?></td>
                        <td><?php echo $data[$i-1]['nama_kendaraan']; ?></td>
                        </tr>
        <?php } ?>
                   </tbody>
            </table>
                </div>
    </div>
    <div class="modal-footer">
        <a href="?page=home" class="btn btn-primary">Kembali</a>
    </div>
            </form>
<script type="text/javascript">
    $(document).ready(function(){
        $('.data').DataTable(); 
    });
    
</script>