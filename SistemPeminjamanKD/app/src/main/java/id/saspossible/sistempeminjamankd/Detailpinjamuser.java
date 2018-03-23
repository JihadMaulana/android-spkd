package id.saspossible.sistempeminjamankd;

import android.content.Intent;
import android.support.v7.app.ActionBarActivity;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.widget.TextView;

public class Detailpinjamuser extends AppCompatActivity {
    TextView id,nama,tujuan,waktu,stat;
    Intent a;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detailpinjamuser);

        id = (TextView) findViewById(R.id.id_peminjaman);
        nama = (TextView) findViewById(R.id.nama_peminjam);
        tujuan = (TextView) findViewById(R.id.tujuan);
        waktu = (TextView) findViewById(R.id.waktu_pinjam);
        stat = (TextView) findViewById(R.id.status);
        a = getIntent();
        id.setText(a.getStringExtra("id_peminjaman"));
        nama.setText(a.getStringExtra("nama"));
        tujuan.setText(a.getStringExtra("tujuan_peminjaman"));
        waktu.setText(a.getStringExtra("waktu_pinjam"));
        stat.setText(a.getStringExtra("status"));

    }
    public boolean onOptionsItemSelected(MenuItem item) {
        // handle arrow click here
        if (item.getItemId() == android.R.id.home) {
            finish(); // close this activity and return to preview activity (if there is any)
        }

        return super.onOptionsItemSelected(item);
    }
}
