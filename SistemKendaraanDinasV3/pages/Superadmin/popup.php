<!-- jwpopup box -->
                <?php 
                    if ($_GET['page']=="kendaraan") {
                        echo "<button class='btn btn-primary' href='javascript:void(0);'' id='jwpopupLink'><span class='fa fa-plus-square'>&nbspTambah Kendaraan</span></button>";
                    }elseif ($_GET['page']=="user") {
                        echo "<button class='btn btn-primary' href='javascript:void(0);'' id='jwpopupLink'><span class='fa  fa-user-plus'>&nbspTambah User</span></button>";
                    }elseif ($_GET['page']=="admin") {
                        echo "<button class='btn btn-primary' href='javascript:void(0);'' id='jwpopupLink'><span class='fa  fa-user-plus'>&nbspTambah Admin</span></button>";
                    }elseif ($_GET['page']=="supir") {
                        echo "<button class='btn btn-primary' href='javascript:void(0);'' id='jwpopupLink'><span class='fa  fa-user-plus'>&nbspTambah Supir</span></button>";
                    }
                ?>
                    
                        <div id="jwpopupBox" class="jwpopup">
                            <!-- jwpopup content -->
                            <div class="jwpopup-content">
                                <div class="jwpopup-head">
                                    <span class="close">×</span>
                                    <h2>Form Isi Data</h2>
                                </div>
                            <div class="jwpopup-main">
                        <?php
                        if ($_GET['page']=="kendaraan") {
                            include 'formisikendaraan.php';
                        }elseif ($_GET['page']=="user") {
                            include 'formisiuser.php';
                        }elseif ($_GET['page']=="admin") {
                            include 'formisiadmin.php';
                        }elseif ($_GET['page']=="supir") {
                            include 'formisisupir.php';
                        }  
                        ?>
<!-- /form -->
                                </div>
                                <div class="jwpopup-foot">
                                    <p>Sistem Peminjaman Kendaraan Bank Indonesia</p>
                                </div>
                        </div>
                            </div>
<script>
    
// untuk mendapatkan jwpopup
var jwpopup = document.getElementById('jwpopupBox');

// untuk mendapatkan link untuk membuka jwpopup
var mpLink = document.getElementById("jwpopupLink");

// untuk mendapatkan aksi elemen close
var close = document.getElementsByClassName("close")[0];

// membuka jwpopup ketika link di klik
mpLink.onclick = function() {
    jwpopup.style.display = "block";
}

// membuka jwpopup ketika elemen di klik
close.onclick = function() {
    jwpopup.style.display = "none";
}

// membuka jwpopup ketika user melakukan klik diluar area popup
window.onclick = function(event) {
    if (event.target == jwpopup) {
        jwpopup.style.display = "none";
    }
}

</script>