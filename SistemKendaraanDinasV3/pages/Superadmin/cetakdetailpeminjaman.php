 <?php
    if (isset($_GET['id_peminjaman'])) {
        $id = $_GET['id_peminjaman'];
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
                <table>
                    <tr>
                        <td><label for='' class='col-sm-12 control-label'>ID Peminjaman</label></td>
                        <td><label for='' class='col-sm-12 control-label'><?php echo ": ".$data[0]['id_peminjaman']; ?></label></td>
                    </tr>
                    <tr>
                    <td><label for='' class='col-sm-12 control-label'>Tujuan</label></td>
                        <td><label for='' class='col-sm-12 control-label'><?php echo ": ".$data[0]['tujuan_peminjaman']; ?></label></td>
                    </tr>

                    <tr>
                        <td><label for='' class='col-sm-12 control-label'>Jumlah Kendaraan</label></td>
                        <td><label for='' class='col-sm-12 control-label'><?php echo ": ".$data[0]['jumlah_kendaraan'] ?></label></td>
                    </tr>                    

                    <tr>
                        <td><label for='' class='col-sm-12 control-label'>Waktu Peminjaman</label></td>
                        <td><label for='' class='col-sm-12 control-label'><?php echo ": ".$data[0]['waktu_pinjam']; ?></label></td>
                    </tr>

                    <tr>    
                        <td><label for='' class='col-sm-12 control-label'>Keterangan</label></td>
                        <td><label for='' class='col-sm-12 control-label'><?php echo ": ".$data[0]['keterangan_peminjaman']; ?></label></td>
                    </tr>

                    <tr>
                        <td><label for='' class='col-sm-12 control-label'>Status</label></td>
                        <td><label for='' class='col-sm-12 control-label'><?php echo ": ".$data[0]['status_peminjaman']; ?></label></td>
                    </tr>           
                </table>
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
            </form>
<script type="text/javascript">
    $(document).ready(function(){
        window.print();
        
    });
    
</script>