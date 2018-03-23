package id.saspossible.sistempeminjamankd;

import android.content.Intent;
import android.graphics.Color;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutCompat;
import android.util.Log;
import android.view.Gravity;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class DetailPeminjaman extends AppCompatActivity {
    TextView id,nama,tujuan,waktu,status2,jumlah;
    private RequestQueue requestQueue;
    int jml,status;
    Intent a;
    String msg;
    Button acc,rjt;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_peminjaman);
        a = getIntent();

        id = (TextView) findViewById(R.id.id_peminjaman);
        nama = (TextView) findViewById(R.id.nama_peminjam);
        tujuan = (TextView) findViewById(R.id.tujuan);
        waktu = (TextView) findViewById(R.id.waktu_pinjam);
        status2 = (TextView) findViewById(R.id.status);
        jumlah = (TextView) findViewById(R.id.jml);
        acc = (Button) findViewById(R.id.terima);
        rjt = (Button) findViewById(R.id.tolak);
        //Toast.makeText(DetailPeminjaman.this, "http://192.168.137.1/SistemKendaraanDinasV3/pages/Android/showplot.php?key=12345&idpeminjaman="+a.getStringExtra("id_peminjaman"), Toast.LENGTH_SHORT).show();

        id.setText(a.getStringExtra("id_peminjaman"));
        nama.setText(a.getStringExtra("nama"));
        tujuan.setText(a.getStringExtra("tujuan_peminjaman"));
        waktu.setText(a.getStringExtra("waktu_pinjam"));
        status2.setText(a.getStringExtra("status"));
        jumlah.setText(a.getStringExtra("jumlah_kendaraan"));
        jml = Integer.parseInt(a.getStringExtra("jumlah_kendaraan"));
        acc.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent it = new Intent (v.getContext(), plot.class);
                Bundle bundle = new Bundle();
                bundle.putString("id_peminjaman",a.getStringExtra("id_peminjaman"));
                bundle.putString("jumlah_kendaraan",a.getStringExtra("jumlah_kendaraan"));
                bundle.putString("kendaraaninput","1");
                it.putExtras(bundle);
                v.getContext().startActivity(it);
                finish();
            }
        });
        rjt.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                tolakpermintaan();
                Toast.makeText(DetailPeminjaman.this,msg,Toast.LENGTH_SHORT).show();
                if (status==1){
                    Intent it = new Intent(DetailPeminjaman.this,id.saspossible.sistempeminjamankd.daftarpermintaan.class);
                    DetailPeminjaman.this.startActivity(it);
                    finish();
                }

            }
        });






    }
    private  void tolakpermintaan(){
        String url = "http://192.168.137.1/SistemKendaraanDinasV3/pages/Android/requestplot.php?key=12345&acc=tolak&idpeminjaman="+a.getStringExtra("id_peminjaman");

        requestQueue = Volley.newRequestQueue(this);
        JsonObjectRequest objectRequest = new JsonObjectRequest(Request.Method.GET, url,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            status = response.getInt("status");
                            msg = response.getString("msg");

                        } catch (JSONException e) {
                            Toast.makeText(DetailPeminjaman.this, "gagal", Toast.LENGTH_SHORT).show();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Log.e("volleyError",error.toString());
                    }
                }
        );
        requestQueue.add(objectRequest);
    }
}
