package id.saspossible.sistempeminjamankd;

/**
 * Created by ASUS on 4 Jul 2017.
 */

public class DetailModel {
    private String id_peminjaman;
    private String id_kendaraan;
    private String nama_kendaraan;
    private String id_supir;
    private String nama_supir;

    public String getId_peminjaman() {
        return id_peminjaman;
    }

    public void setId_peminjaman(String id_peminjaman) {
        this.id_peminjaman = id_peminjaman;
    }

    public String getId_kendaraan() {
        return id_kendaraan;
    }

    public void setId_kendaraan(String id_kendaraan) {
        this.id_kendaraan = id_kendaraan;
    }

    public String getNama_kendaraan() {
        return nama_kendaraan;
    }

    public void setNama_kendaraan(String nama_kendaraan) {
        this.nama_kendaraan = nama_kendaraan;
    }

    public String getId_supir() {
        return id_supir;
    }

    public void setId_supir(String id_supir) {
        this.id_supir = id_supir;
    }

    public String getNama_supir() {
        return nama_supir;
    }

    public void setNama_supir(String nama_supir) {
        this.nama_supir = nama_supir;
    }
}
