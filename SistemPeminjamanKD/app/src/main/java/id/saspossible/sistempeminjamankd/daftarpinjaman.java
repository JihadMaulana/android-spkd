package id.saspossible.sistempeminjamankd;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v4.view.MenuItemCompat;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
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

public class daftarpinjaman extends AppCompatActivity {
    String iduser;
    private RequestQueue requestQueue;
    private ArrayList<permintaanModel> arrayList;
    private RecyclerView recyclerView;
    private pegawaiAdapter pegawaiAdapter;
    Button request;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_daftarpinjaman);
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
        request = (Button) findViewById(R.id.request);
        request.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent it = new Intent(daftarpinjaman.this,id.saspossible.sistempeminjamankd.Formpeminjaman.class);
                Bundle bundle = new Bundle();
                bundle.putString("iduser",iduser);
                it.putExtras(bundle);
                startActivity(it);
            }
        });

        arrayList = new ArrayList<>();
        recyclerView = (RecyclerView) findViewById(R.id.rcvMain);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));
        Intent a = getIntent();
        iduser = a.getStringExtra("iduser");
        getData();


    }
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.spinner_toolbar, menu);

        MenuItem item = menu.findItem(R.id.spinner);
        Spinner spinner = (Spinner) MenuItemCompat.getActionView(item);


        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(this,
                R.array.spinner_array, android.R.layout.simple_spinner_item);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

        spinner.setAdapter(adapter);
        spinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                switch (position) {
                    case (1):
                        Intent i = new Intent(daftarpinjaman.this, MainActivity.class);
                        daftarpinjaman.this.startActivity(i);
                        finish();
                        break;
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });
        return true;


    }
    public class CustomOnItemSelectedListener extends Activity implements
            AdapterView.OnItemSelectedListener {
        public void onItemSelected(AdapterView<?> parent, View view, int pos,
                                   long id) {
            // **************************** below here is where I start the new activity
            switch (pos) {
                case (1):
                    Intent i = new Intent(daftarpinjaman.this, MainActivity.class);
                    daftarpinjaman.this.startActivity(i);
                    break;
            }
            // **************************** above here is where I start the new activity
        }

        @Override
        public void onNothingSelected(AdapterView<?> parent) {

        }
    }
    private  void getData(){
        String url = "http://192.168.137.1/SistemKendaraanDinasV3/pages/Android/showpermintaanuser.php?key=12345&iduser="+iduser;

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

                            pegawaiAdapter = new pegawaiAdapter(arrayList);
                            recyclerView.setAdapter(pegawaiAdapter);

                        } catch (JSONException e) {
                            Toast.makeText(daftarpinjaman.this, "gagal try", Toast.LENGTH_SHORT).show();
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
