package id.saspossible.sistempeminjamankd;

import android.content.Intent;
import android.graphics.Color;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class plot extends AppCompatActivity {
    Intent a;
    int jml,count;
    String id;
    int status;
    int statusnext;
    String msg;
    TextView title;
    kendaraanModel[] listkendaraan;
    supirModel[] listsupir;
//    ArrayAdapter<String> adapterkendaraan, adaptersupir;
    String[] spinerkendaraan ;
    String[] spinersupir;
    Spinner spinkendaraan, spinsupir;
    Button btnnext;
    RequestQueue requestQueue;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_plot);

        a= getIntent();
        jml = Integer.parseInt(a.getStringExtra("jumlah_kendaraan"));
        id = a.getStringExtra("id_peminjaman");
        count = Integer.parseInt(a.getStringExtra("kendaraaninput"));

        title = (TextView) findViewById(R.id.title);
        spinkendaraan = (Spinner) findViewById(R.id.spinkendaraan);
        spinsupir = (Spinner) findViewById(R.id.spinsupir);
        btnnext = (Button) findViewById(R.id.btnnext);
//        spinersupir = new ArrayList<>();
//        spinerkendaraan = new ArrayList<>();
        getData();
        spinsupir.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                ((TextView) parent.getChildAt(0)).setTextColor(Color.BLACK);
                //((TextView) parent.getChildAt(0)).setTextSize(5);
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });
        spinkendaraan.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                ((TextView) parent.getChildAt(0)).setTextColor(Color.BLACK);
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {

            }
        });


        btnnext.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
               if (status == 1){
                   next();
               }else{
                   Toast.makeText(plot.this,"Tidak ada Item",Toast.LENGTH_SHORT).show();
               }

            }
        });



    }
    private  void getData(){
        String url = "http://192.168.137.1/SistemKendaraanDinasV3/pages/Android/showplot.php?key=12345&idpeminjaman="+id;

        requestQueue = Volley.newRequestQueue(this);
        JsonObjectRequest objectRequest = new JsonObjectRequest(Request.Method.GET, url,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                           status = response.getInt("status");
                            if(status == 1) {
                                JSONArray supir = response.getJSONArray("supir");
                                JSONArray kendaraan = response.getJSONArray("kendaraan");
                                spinerkendaraan = new String[kendaraan.length()];
                                listkendaraan = new kendaraanModel[kendaraan.length()];
                                spinersupir = new String[supir.length()];
                                listsupir = new supirModel[supir.length()];
                                for (int x = 0; x < supir.length(); x++) {
                                    listsupir[x] = new supirModel();
                                    listsupir[x].setNama_supir(supir.getJSONObject(x).getString("namasupir"));
                                    listsupir[x].setId_supir(supir.getJSONObject(x).getString("idsupir"));
                                    spinersupir[x] = new String();
                                    spinersupir[x] = listsupir[x].getNama_supir();

                                }
                                for (int x = 0; x < kendaraan.length(); x++) {
                                    listkendaraan[x] = new kendaraanModel();
                                    listkendaraan[x].setNama_kendaraan(kendaraan.getJSONObject(x).getString("namakendaraan"));
                                    listkendaraan[x].setId_kendaraan(kendaraan.getJSONObject(x).getString("idkendaraan"));
                                    spinerkendaraan[x] = new String();
                                    spinerkendaraan[x] = listkendaraan[x].getNama_kendaraan();
                                }

                            }else if(status == 0){
                                spinerkendaraan = new String[1];
                                spinersupir = new String[1];
                                spinersupir[0] = new String();
                                spinersupir[0] = "Supir Tidak Tersedia";
                                spinerkendaraan[0] = new String();
                                spinerkendaraan[0] = "Kendaraan Tidak Tersedia";

                            }
                            final ArrayAdapter<String> adaptersupir = new ArrayAdapter<String>(getApplicationContext(), android.R.layout.simple_spinner_dropdown_item, spinersupir);
                            final ArrayAdapter<String> adapterkendaraan = new ArrayAdapter<String>(getApplicationContext(), android.R.layout.simple_spinner_dropdown_item, spinerkendaraan);
                            spinsupir.setAdapter(adaptersupir);
                            spinkendaraan.setAdapter(adapterkendaraan);
//                            adaptersupir.notifyDataSetChanged();
//                            adapterkendaraan.notifyDataSetChanged();


                        } catch (JSONException e) {
                            Toast.makeText(plot.this, "gagal try", Toast.LENGTH_SHORT).show();
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
    private void next(){
        String idsupir = listsupir[spinsupir.getSelectedItemPosition()].getId_supir();
        String idkendaraan = listkendaraan[spinkendaraan.getSelectedItemPosition()].getId_kendaraan();
        String url = "http://192.168.137.1/SistemKendaraanDinasV3/pages/Android/requestplot.php?key=12345&acc=terima&idpeminjaman="+a.getStringExtra("id_peminjaman")+"&kendaraan="+idkendaraan+"&supir="+idsupir;

        requestQueue = Volley.newRequestQueue(this);
        JsonObjectRequest objectRequest = new JsonObjectRequest(Request.Method.GET, url,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            statusnext = response.getInt("status");
                            msg = response.getString("msg");
                            if (count<jml){

                                if (statusnext==1){
                                    Intent it = new Intent (plot.this, plot.class);
                                    Bundle bundle = new Bundle();
                                    bundle.putString("id_peminjaman",a.getStringExtra("id_peminjaman"));
                                    bundle.putString("jumlah_kendaraan",a.getStringExtra("jumlah_kendaraan"));
                                    bundle.putString("kendaraaninput", String.valueOf(count+1));
                                    it.putExtras(bundle);
                                    plot.this.startActivity(it);
                                    finish();
                                    Toast.makeText(plot.this,msg+" plot ke-"+count,Toast.LENGTH_SHORT).show();
                                }else {
                                    Toast.makeText(plot.this,msg+" plot ke-"+count,Toast.LENGTH_SHORT).show();
                                }
                            }else if (count==jml){

                                if (statusnext == 1){
                                    Intent it = new Intent(plot.this,id.saspossible.sistempeminjamankd.daftarpermintaan.class);
                                    plot.this.startActivity(it);
                                    finish();
                                    //Toast.makeText(plot.this,msg+" plot ke-"+count,Toast.LENGTH_SHORT).show();
                                }else{
                                    Toast.makeText(plot.this,msg+" plot ke-"+count,Toast.LENGTH_SHORT).show();
                                }
                            }

                        } catch (JSONException e) {
                            Toast.makeText(plot.this, "gagal", Toast.LENGTH_SHORT).show();
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
