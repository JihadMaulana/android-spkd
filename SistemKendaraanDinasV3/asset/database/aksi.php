<?php 

class users
{
	private $DB_con;
	
	function __construct($DB_conn)
	{
			$this->DB_con = $DB_conn;
	}
public function redirect($url)
   {
       header("Location: $url");
   }
 
	public function login($id_pengguna, $Password)
        {
            try
            {
                // Ambil data dari database
                $query = $this->DB_con->prepare("SELECT * FROM user WHERE id_pengguna = :id_pengguna AND Password = :Password");
                $query->bindParam(":id_pengguna", $id_pengguna);
                $query->bindParam(":Password", $Password);
                $query->execute();
                $data = $query->fetch();

                // Jika jumlah baris > 0
                if($query->rowCount() > 0){
                    // jika password yang dimasukkan sesuai dengan yg ada di database
                    if(($Password == $data['password'])){
                        session_start();
                        $_SESSION['user_session'] = $data['id_pengguna'];
                        $_SESSION['nama']=$data['nama'];
                        $_SESSION['id_akses'] = $data['id'];
                        $_SESSION['is_logged'] = true;
                        
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    public function isLoggedIn(){
            // Apakah user_session sudah ada di session
            if(isset($_SESSION['user_session']))
            {
                return true;
            }
        }
        public function getUser(){
            // Cek apakah sudah login
            if(!$this->isLoggedIn()){
                return false;
            }

            try {
                // Ambil data user dari database
                $query = $this->DB_con->prepare("SELECT * FROM tb_daftar WHERE id = :id");
                $query->bindParam(":id", $_SESSION['user_session']);
                $query->execute();
                return $query->fetch();
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    public function pmj($tujuan,$jumlah,$dari,$darijam,$sampai,$sampaijam,$keterangan){
        try{
            $id = $_SESSION['user_session'];
            $stmt = $this->DB_con->prepare("INSERT INTO peminjaman (id_peminjaman, id_peminjam, tujuan_peminjaman, jumlah_kendaraan, waktu_pinjam, waktu_kembali, keterangan_peminjaman, status_peminjaman) VALUES (NULL, '$id', '$tujuan','$jumlah', '$dari $darijam', '$sampai $sampaijam', '$keterangan', 'Pending')");
                $stmt->execute();
        }catch(PDOException $e){
          echo $e->getMessage("Error"); 
          return false;
        }
    }

    public function getDetail($id_peminjaman){
        try{
            $stmt = $this->DB_con->prepare("SELECT * from plot_kendaraan RIGHT JOIN peminjaman ON plot_kendaraan.id_peminjaman=peminjaman.id_peminjaman LEFT JOIN supir ON plot_kendaraan.id_supir=supir.id_supir LEFT JOIN kendaraan ON plot_kendaraan.id_kendaraan=kendaraan.id_kendaraan WHERE peminjaman.id_peminjaman = $id_peminjaman");
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage("Error"); 
          return false;
        }

    }
    public function readSelect($from){
        try{
            $stmt = $this->DB_con->prepare("SELECT * from $from");
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage("Error"); 
          return false;
        }
    }
    public function insertPlot($table, $value){
        try{
            $stmt = $this->DB_con->prepare("INSERT INTO $table VALUES $value");
            $stmt->execute();
        }catch(PDOException $e){
          echo $e->getMessage("Error"); 
          return false;
        }
    }
    public function updatePlot($table,$value){
        try{
            $stmt = $this->DB_con->prepare("UPDATE $table SET $value");
            $stmt->execute();
        }catch(PDOException $e){
          echo $e->getMessage("Error"); 
          return false;
        }
       
    }
}
?>