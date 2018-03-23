<?php
    if(isset($_POST['kirim'])){
        $tujuan = $_POST['tujuan'];
        $jumlah = $_POST['jumlah'];
        $dari = $_POST['dari'];
        $darijam = $_POST['darijam'];
        $sampai = $_POST['sampai'];
        $sampaijam = $_POST['sampaijam'];
        $keterangan = $_POST['ket'];

        $user->pmj($tujuan,$jumlah,$dari,$darijam,$sampai,$sampaijam,$keterangan);
    }
?>

            <form method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="rows">
                                <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">Tujuan</label>
                                    <div class="col-sm-4">
                                    <input type="text" name="tujuan" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                     <label for="inputNim" class="col-sm-4 control-label">Jumlah Kendaraan</label>
                                <div class="col-sm-2">
                                    <input type="text" name="jumlah" class="form-control" required=""/>
                                </div>
                            </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Waktu Peminjaman</label>
                                    <div class="col-sm-3">
                                     <input  type="date" class="form-control" name="dari">   
                                    </div>
                                    <div class="col-sm-2">
                                     <input type="time" class="form-control" name="darijam">   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"></label>
                                    <div class="col-sm-3">
                                            <label class="control-label">Sampai</label>   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"></label>
                                    <div class="col-sm-3">
                                     <input  type="date" class="form-control" name="sampai">   
                                    </div>
                                    <div class="col-sm-2">
                                     <input type="time" class="form-control" name="sampaijam">   
                                    </div>
                                </div>
                            <div class="form-group">
                                    <label for="inputNim" class="col-sm-4 control-label">Keterangan</label>
                                <div class="col-sm-4">
                                    <textarea class="form-control" name="ket" rows="5"></textarea>
                                </div>
                            </div>


                        <div align="center"><button type="submit" class="btn btn-default" name="kirim">Submit</button></div>
                    </div>
                </form>