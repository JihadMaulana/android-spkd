<?php
if (!isset($_SESSION['id_akses'])){
    header('Location:../Users/loginpage.php');
    }
?>
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
    if (isset($_GET['deluser'])) {
        $iduser=$_GET['iduser'];
        $table = "user";
        $value= "`ket` = 'deleted' WHERE `id_pengguna` = '".$iduser."'";
        $user->updatePlot($table, $value);
    }
?>
<table class="table table-striped table-bordered data">
            <thead>
  <!--DWLayoutTable-->
                <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No Telp.</th>
                <?php
                    if ($_SESSION['id_akses']=="1") {
                        echo "<th>Action</th>";
                    }
                ?>
        <!--<td width="134" align="center" valign="middle" >Foto</td>-->
                </tr>
            </thead>
            <tbody>
            <?php
                    $stmt = $user->readSelect("user WHERE id = '3' AND ket = 'active'");
                     while($hasil = $stmt->fetch()){ ?>
            <tr>
                <td><?php echo $hasil['id_pengguna']?></td>
                <td><?php echo $hasil['nama']?></td>
                <td><?php echo $hasil['email']?></td>
                <td><?php echo $hasil['no_telepon']?></td>
                <?php
                    if ($_SESSION['id_akses']=="1") {
                        echo "<td><a class='btn btn-danger' href='?page=user&deluser=1&iduser=".$hasil['id_pengguna']."'>Hapus</a></td>";
                    }
                ?>
                
            </tr>
                <?php } ?>
            </tbody>
    </table>
    <script type="text/javascript">
    $(document).ready(function(){
        $('.data').DataTable();
    });</script>