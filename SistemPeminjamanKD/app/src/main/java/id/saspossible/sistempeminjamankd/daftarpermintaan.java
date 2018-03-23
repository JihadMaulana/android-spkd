package id.saspossible.sistempeminjamankd;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
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

public class daftarpermintaan extends AppCompatActivity {
    String idadmin;
    private RequestQueue requestQueue;
    private ArrayList<permintaanModel> arrayList;
    private RecyclerView recyclerView;
    private permintaanAdminAdapter permintaanAdminAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_daftarpermintaan);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
                        .setAction("Action", null).show();
            }
        });
        fab.setVisibility(View.GONE);

        arrayList = new ArrayList<>();
        recyclerView = (RecyclerView) findViewById(R.id.rcvMain2);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));
        //Intent a = getIntent();
        //idadmin = a.getStringExtra("idadmin");
        getData();
    }
    private  void getData(){
        String url = "http://192.168.137.1/SistemKendaraanDinasV3/pages/Android/showpermintaanadmin.php?key=12345";

        requestQueue = Volley.newRequestQueue(this);
        JsonObjectRequest objectRequest = new JsonObjectRequest(Request.Method.GET, url,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            int status = response.getInt("status");
                            JSONArray data= response.getJSONArray("data");
                            for (int x=0;x<data.length();x++){
                                permintaanModel daftar = new permintaanModel();
                                daftar.setTujuan_peminjaman(data.getJSONObject(x).getString("tujuan_peminjaman"));
                                daftar.setWaktu_pinjam(data.getJSONObject(x).getString("waktu_pinjam"));
                                daftar.setStatus_peminjaman(data.getJSONObject(x).getString("status_peminjaman"));
                                daftar.setId_peminjaman(data.getJSONObject(x).getString("id_peminjaman"));
                                daftar.setNama(data.getJSONObject(x).getString("nama"));
                                daftar.setJumlah_kendaraan(data.getJSONObject(x).getString("jumlah_kendaraan"));
                                arrayList.add(daftar);
                            }

                            permintaanAdminAdapter = new permintaanAdminAdapter(arrayList);
                            recyclerView.setAdapter(permintaanAdminAdapter);

                        } catch (JSONException e) {
                            Toast.makeText(daftarpermintaan.this, "gagal try", Toast.LENGTH_SHORT).show();
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
