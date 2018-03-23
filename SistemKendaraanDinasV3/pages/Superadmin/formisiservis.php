<?php 
if(isset($_POST['kirim']))
  {
    $id_kendaraan=$_GET['idkendaraan'];
    $tanggal_servis=$_POST['tanggal_servis'];
    $keterangan=$_POST['keterangan'];
               // if no error occured, continue ....
                if(!isset($errMSG))
                {
                        $stmt = $DB_con->prepare("INSERT INTO servis_kendaraan (id_servis, id_kendaraan, tanggal_servis, keterangan, ket) VALUES (NULL, :id_kendaraan, :tanggal_servis, :keterangan, 'active')");
                        $stmt->bindParam(':id_kendaraan',$id_kendaraan);
                        $stmt->bindParam(':tanggal_servis',$tanggal_servis);
                        $stmt->bindParam(':keterangan',$keterangan);
                       
                        if($stmt->execute())
                          {
                            $successMSG = "new record succesfully inserted ...";
                            
                          }
                        else
                          {
                            $errMSG = "error while inserting....";
                          }
                   
                      
                    }
                  
                }
?>

            <form method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <div class="rows">
                                <div class="form-group col">
                                    <label for="" class="col-sm-4 control-label">Tanggal Servis</label>
                                    <div class="col-sm-4">
                                    <input type="date" name="tanggal_servis" class="form-control" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Keterangan</label>
                                    <div class="col-sm-4">
                                    <textarea class="form-control" name="keterangan" rows="5"></textarea>
                                    </div>
                                </div>
                        <div align="right"><button type="submit" name="kirim" class="btn btn-primary">Submit</button></div>
                    </div>
                </form>