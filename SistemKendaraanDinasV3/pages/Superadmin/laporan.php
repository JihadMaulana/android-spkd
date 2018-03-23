<?php
    if (isset($_POST['preview'])) {
        echo "<div class='alert alert-success'>Proses Berhasil Silahkan Tekan Cetak!</div> ";
    }
?>
    <div class="header">
        <!-- <h4 class="modal-title">Cetak Laporan</h4> -->
    </div>
    <form method='POST' enctype='multipart/form-data' class='form-inline'>
    <div class="body">
                <div class='rows'>
                    <div class='form-group col-sm-12'>
                    <?php
                        if (empty($_GET['cetak'])) {
                    ?>
                        <label for='' class='col-sm-4 control-label'>Tipe Laporan</label>
                        <select name="tipe_laporan">
                            <option value="detail" <?php
                            if (isset($_POST['tipe_laporan'])) {
                                 if ($_POST['tipe_laporan']=="detail") {
                                     echo "selected";
                                 }
                             } 
                         ?>>Detail</option>
                            <option value="list"<?php
                            if (isset($_POST['tipe_laporan'])) {
                                 if ($_POST['tipe_laporan']=="list") {
                                     echo "selected";
                                 }
                             } 
                         ?>>List</option>
                        </select>
                        <button type="submit">Pilih</button>
                    <?php
                        }
                    ?>
                    </div>
                        <?php
                            if (isset($_POST['tipe_laporan'])) {
                                if ($_POST['tipe_laporan']=="detail") {
                        ?>
                    <div class='form-group col-sm-12'>
                        <label for='' class='col-sm-4 control-label'>Dari</label>
                        <select name="dari">
                            <option value="peminjaman" <?php
                            if (isset($_POST['dari'])) {
                                 if ($_POST['dari']=="peminjaman") {
                                     echo "selected";
                                 }
                             } 
                         ?>>Peminjaman</option>
                            <option value="kendaraan" <?php
                            if (isset($_POST['dari'])) {
                                 if ($_POST['dari']=="kendaraan") {
                                     echo "selected";
                                 }
                             } 
                         ?>>Kendaraan</option>
                        </select>
                        <button type="submit">Pilih</button>
                    </div>
                        <?php
                                    if (isset($_POST['dari'])) {
                                        if ($_POST['dari']=="peminjaman") {
                        ?>
                    <div class='form-group col-sm-12'>
                        <label for='' class='col-sm-4 control-label'>Id Peminjaman</label>
                        <input type="text" name="id_peminjaman" required="" />
                        <button type="submit" name="preview">Check</button>
                    </div>
                        <?php
                                        }elseif ($_POST['dari']=="kendaraan") {
                        ?>
                    <div class='form-group col-sm-12'>
                        <label for='' class='col-sm-4 control-label'>Id Kendaraan</label>
                        <input type="text" name="id_kendaraan" required="" />
                    </div>
                    <div class='form-group col-sm-12'>
                        <label for='' class='col-sm-4 control-label'>Periode Servis</label>
                        <input  type="date" class="form-control" name="dari_servis" required="" />
                        <label for='' >Sampai</label>
                        <input  type="date" class="form-control" name="sampai_servis" required="" />
                        <button type="submit" name="preview">Check</button>
                    </div>
                        <?php
                                        }
                                    }
                                }elseif ($_POST['tipe_laporan']=="list") {
                        ?>
                    <div class='form-group col-sm-12'>
                        <label for='' class='col-sm-4 control-label'>Periode Peminjaman</label>
                        <input  type="date" class="form-control" name="dari_peminjaman"/>
                        <label for='' >Sampai</label>
                        <input  type="date" class="form-control" name="sampai_peminjaman"/>
                        <button type="submit" name="preview">Check</button>
                    </div>
                        <?php
                                }
                            }
                            if (isset($_GET['cetak'])) {
                                if ($_GET['tipe_laporan']=="detail") {
                                    if (isset($_GET['id_peminjaman'])) {
                                        include "cetakdetailpeminjaman.php";
                                    }elseif (isset($_GET['id_kendaraan'])) {
                                        include "cetakdetailkendaraan.php";
                                    }
                                    
                                }elseif ($_GET['tipe_laporan']=="list") {
                                    include "cetaklist.php";
                                }
                            }
                        ?>
</form>
                </div>
    <div class="modal-footer">
    <?php
        if (isset($_POST['preview'])) {
            
            if ($_POST['tipe_laporan']=="detail") {
                if ($_POST['dari']=="peminjaman") {
    ?>
    <a href="?page=laporan&cetak=1&tipe_laporan=detail&id_peminjaman=<?php echo $_POST['id_peminjaman'];?>" class="btn btn-primary">Cetak</a>
    <?php
                }elseif ($_POST['dari']=="kendaraan") {
     ?>
     <a href="?page=laporan&cetak=1&tipe_laporan=detail&id_kendaraan=<?php echo $_POST['id_kendaraan']; ?>&dari_servis=<?php echo $_POST['dari_servis']; ?>&sampai_servis=<?php echo $_POST['sampai_servis']; ?>" class="btn btn-primary">Cetak</a>
     <?php
                }
            }elseif ($_POST['tipe_laporan']=="list") {
    ?>
    <a href="?page=laporan&cetak=1&tipe_laporan=list&dari_peminjaman=<?php echo $_POST['dari_peminjaman']; ?>&sampai_peminjaman=<?php echo $_POST['sampai_peminjaman']; ?>" class="btn btn-primary">Cetak</a>
    <?php
            }
    ?>
    
    <?php
        }
    ?>
        
        
    </div> 
    </div>
