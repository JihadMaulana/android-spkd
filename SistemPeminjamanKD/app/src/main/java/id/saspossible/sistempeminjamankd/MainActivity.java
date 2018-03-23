package id.saspossible.sistempeminjamankd;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
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

public class MainActivity extends AppCompatActivity {
    Button login;
    String msg;
    EditText idlogin;
    EditText passlogin;
    int status;
    int akses;
    String iduser;
    String idadmin;
    private RequestQueue requestQueue;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        idlogin = (EditText) findViewById(R.id.idlogin);
        passlogin = (EditText) findViewById(R.id.pass);
        login = (Button) findViewById(R.id.btnlogin);
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                iduser =idlogin.getText().toString();
                getData();
                Toast.makeText(MainActivity.this, msg, Toast.LENGTH_SHORT).show();
                if(status == 1){
                    if(akses == 3){
                        Intent it = new Intent(MainActivity.this,id.saspossible.sistempeminjamankd.daftarpinjaman.class);
                        Bundle bundle = new Bundle();
                        bundle.putString("iduser",iduser);
                        it.putExtras(bundle);
                        startActivity(it);
                        finish();
                    }else if (akses == 2 ) {
                        Intent in = new Intent(MainActivity.this,id.saspossible.sistempeminjamankd.menuAdmin.class);
                        Bundle bundl = new Bundle();
                        bundl.putString("idadmin",idadmin);
                        in.putExtras(bundl);
                        startActivity(in);
                        finish();
                    }else if (akses == 1){
                        Intent in = new Intent(MainActivity.this,id.saspossible.sistempeminjamankd.menuAdmin.class);
                        Bundle bundl = new Bundle();
                        bundl.putString("idadmin",idadmin);
                        in.putExtras(bundl);
                        startActivity(in);
                        finish();
                    }
                }



            }
        });



    }
    private  void getData(){
        String url = "http://192.168.137.1/SistemKendaraanDinasV3/pages/Android/signin.php?id="+idlogin.getText()+"&pass="+passlogin.getText();

        requestQueue = Volley.newRequestQueue(this);
        JsonObjectRequest objectRequest = new JsonObjectRequest(Request.Method.GET, url,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            status = response.getInt("status");
                            msg = response.getString("msg");
                            akses = response.getInt("akses");


                        } catch (JSONException e) {
                            Toast.makeText(MainActivity.this, "gagal", Toast.LENGTH_SHORT).show();
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
