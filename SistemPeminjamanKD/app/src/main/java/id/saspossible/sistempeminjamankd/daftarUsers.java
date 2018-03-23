package id.saspossible.sistempeminjamankd;

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

public class daftarUsers extends AppCompatActivity {
    private RequestQueue requestQueue;
    private ArrayList<userModel> arrayList;
    private RecyclerView recyclerView;
    private userAdapter userAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_daftar_users);
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
        recyclerView = (RecyclerView) findViewById(R.id.rcvMain5);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));
        getData();
    }
    private  void getData(){
        String url = "http://192.168.137.1/SistemKendaraanDinasV3/pages/Android/showuser.php?key=12345";

        requestQueue = Volley.newRequestQueue(this);
        JsonObjectRequest objectRequest = new JsonObjectRequest(Request.Method.GET, url,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            int status = response.getInt("status");
                            JSONArray data= response.getJSONArray("data");
                            for (int x=0;x<data.length();x++){
                                userModel daftar = new userModel();
                                daftar.setNama(data.getJSONObject(x).getString("nama"));
                                daftar.setEmail(data.getJSONObject(x).getString("email"));
                                daftar.setKet(data.getJSONObject(x).getString("ket"));
                                arrayList.add(daftar);
                            }

                            userAdapter = new userAdapter(arrayList);
                            recyclerView.setAdapter(userAdapter);

                        } catch (JSONException e) {
                            Toast.makeText(daftarUsers.this, "gagal try", Toast.LENGTH_SHORT).show();
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
