package id.saspossible.sistempeminjamankd;

import android.content.Intent;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.widget.ArrayAdapter;
import android.widget.LinearLayout;
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

import static id.saspossible.sistempeminjamankd.R.id.center;
import static id.saspossible.sistempeminjamankd.R.id.kendaraan;
import static id.saspossible.sistempeminjamankd.R.id.text;

public class DetailPeminjaman2 extends AppCompatActivity {
    TextView id,nama,tujuan,waktu,status2,jumlah;
    LinearLayout ploting , ploting2;
    int jml;
    Intent a;
    RequestQueue requestQueue;
    int status;
    JSONArray data;
    TextView textkend;
    TextView textsup;
    private ArrayList<kendaraanModel> arrayListk;
    private RecyclerView recyclerViewk;
    private kendaraanAdapter kendaraanAdapter;
    private ArrayList<supirModel> arrayLists;
    private RecyclerView recyclerViews;
    private supirAdapter supirAdapter;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_peminjaman2);
        a = getIntent();

        id = (TextView) findViewById(R.id.id_peminjaman);
        nama = (TextView) findViewById(R.id.nama_peminjam);
        tujuan = (TextView) findViewById(R.id.tujuan);
        waktu = (TextView) findViewById(R.id.waktu_pinjam);
        status2 = (TextView) findViewById(R.id.status);
        jumlah = (TextView) findViewById(R.id.jml);
        textkend = (TextView) findViewById(R.id.textkend);
        textsup = (TextView) findViewById(R.id.textsup);
        id.setText(a.getStringExtra("id_peminjaman"));
        nama.setText(a.getStringExtra("nama"));
        tujuan.setText(a.getStringExtra("tujuan_peminjaman"));
        waktu.setText(a.getStringExtra("waktu_pinjam"));
        status2.setText(a.getStringExtra("status"));
        jumlah.setText(a.getStringExtra("jumlah_kendaraan"));
        jml = Integer.parseInt(a.getStringExtra("jumlah_kendaraan"));
        if (a.getStringExtra("status").equals("Accepted")){

            arrayListk = new ArrayList<>();
            recyclerViewk = (RecyclerView) findViewById(R.id.rcvMain3);
            recyclerViewk.setLayoutManager(new LinearLayoutManager(this));
            arrayLists = new ArrayList<>();
            recyclerViews = (RecyclerView) findViewById(R.id.rcvMain4);
            recyclerViews.setLayoutManager(new LinearLayoutManager(this));
            getData();
        }else{
            textkend.setText("");
            textsup.setText("");
        }





    }
    private  void getData(){
        String url = "http://192.168.137.1/SistemKendaraanDinasV3/pages/Android/showdetailpermintaan.php?key=12345&idpeminjaman="+getIntent().getStringExtra("id_peminjaman");

        requestQueue = Volley.newRequestQueue(this);
        JsonObjectRequest objectRequest = new JsonObjectRequest(Request.Method.GET, url,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            status = response.getInt("status");

                            data = response.getJSONArray("data");
                            for (int x=0;x<data.length();x++){
                                kendaraanModel daftar = new kendaraanModel();
                                daftar.setNama_kendaraan(data.getJSONObject(x).getString("nama_kendaraan"));
                                daftar.setId_kendaraan(data.getJSONObject(x).getString("id_kendaraan"));
                                daftar.setKet(data.getJSONObject(x).getString("ket"));
                                arrayListk.add(daftar);

                                supirModel daftars = new supirModel();
                                daftars.setNama_supir(data.getJSONObject(x).getString("nama_supir"));
                                daftars.setId_supir(data.getJSONObject(x).getString("id_supir"));
                                daftars.setKet(data.getJSONObject(x).getString("ket"));
                                arrayLists.add(daftars);
                            }

                            kendaraanAdapter = new kendaraanAdapter(arrayListk);
                            recyclerViewk.setAdapter(kendaraanAdapter);

                            supirAdapter = new supirAdapter(arrayLists);
                            recyclerViews.setAdapter(supirAdapter);





                        } catch (JSONException e) {
                            Toast.makeText(DetailPeminjaman2.this, "gagal try", Toast.LENGTH_SHORT).show();
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
