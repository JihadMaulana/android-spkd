package id.saspossible.sistempeminjamankd;

import android.content.Intent;
import android.support.v4.view.MenuItemCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.Spinner;

public class menuAdmin extends AppCompatActivity {
    ImageView list,kendaraan,supir,user;
    String idadmin;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu_admin);
        Intent a = getIntent();
        idadmin = a.getStringExtra("idadmin");
        list = (ImageView) findViewById(R.id.list);
        kendaraan = (ImageView) findViewById(R.id.kendaraan);
        user = (ImageView) findViewById(R.id.user);
        supir = (ImageView) findViewById(R.id.supir);


        list.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent it = new Intent(menuAdmin.this,id.saspossible.sistempeminjamankd.daftarpermintaan.class);
                menuAdmin.this.startActivity(it);
            }
        });
        kendaraan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent it = new Intent(menuAdmin.this,id.saspossible.sistempeminjamankd.daftarKendaraan.class);
                Bundle bundl = new Bundle();
                bundl.putString("idadmin",idadmin);
                it.putExtras(bundl);
                startActivity(it);
            }
        });
        supir.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent it = new Intent(menuAdmin.this,id.saspossible.sistempeminjamankd.daftarSupir.class);
                menuAdmin.this.startActivity(it);
            }
        });
        user.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent it = new Intent(menuAdmin.this,id.saspossible.sistempeminjamankd.daftarUsers.class);
                menuAdmin.this.startActivity(it);
            }
        });
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
                        Intent i = new Intent(menuAdmin.this, MainActivity.class);
                        menuAdmin.this.startActivity(i);
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
}
