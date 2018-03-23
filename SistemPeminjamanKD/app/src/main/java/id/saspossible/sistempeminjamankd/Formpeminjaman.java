package id.saspossible.sistempeminjamankd;

import android.app.DatePickerDialog;
import android.app.Dialog;
import android.app.TimePickerDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.text.format.DateFormat;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.TimePicker;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.Locale;

import static id.saspossible.sistempeminjamankd.R.id.bkirim;
import static id.saspossible.sistempeminjamankd.R.id.idlogin;
import static id.saspossible.sistempeminjamankd.R.id.tglpinjam;
import static id.saspossible.sistempeminjamankd.R.id.wktpinjam;

public class Formpeminjaman extends AppCompatActivity {
    private RequestQueue requestQueue;
    private String msg;
    private int status;
    private int akses;
    private String iduser;
    private EditText formtujuan;
    private EditText jmlkend;
    private EditText keterangan;
    private EditText tvTimeResult;
    private EditText btTimePicker;
    private EditText tvTimeResult2;
    private EditText btTimePicker2;
    private DatePickerDialog datePickerDialog;
    private SimpleDateFormat dateFormatter;
    private EditText tvDateResult;
    private EditText btDatePicker;
    private EditText tvDateResult2;
    private EditText btDatePicker2;
    private Button kirim;
    private int myear, month, day,year2, month2, day2;
    private TimePickerDialog timePickerDialog;
    private Date date1,date2;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_formpeminjaman);
        formtujuan = (EditText) findViewById(R.id.formtujuan);
        jmlkend = (EditText) findViewById(R.id.formjmlkend);
        keterangan = (EditText) findViewById(R.id.keterangan);
        dateFormatter = new SimpleDateFormat("yyyy-MM-dd", Locale.US);
        tvDateResult = (EditText) findViewById(R.id.tglpinjam);
        btDatePicker = (EditText) findViewById(R.id.tglpinjam);
        tvDateResult2 = (EditText) findViewById(R.id.tglpinjam2);
        btDatePicker2 = (EditText) findViewById(R.id.tglpinjam2);
        btDatePicker.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog();
            }
        });
        btDatePicker2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDateDialog2();
            }
        });

        tvTimeResult = (EditText) findViewById(R.id.wktpinjam);
        btTimePicker = (EditText) findViewById(R.id.wktpinjam);
        tvTimeResult2 = (EditText) findViewById(R.id.wktpinjam2);
        btTimePicker2 = (EditText) findViewById(R.id.wktpinjam2);
        btTimePicker.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showTimeDialog();
            }
        });
        btTimePicker2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                showTimeDialog2();
            }
        });
        Intent a = getIntent();
        iduser = a.getStringExtra("iduser");

        kirim = (Button) findViewById(R.id.bkirim);
        kirim.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //String url = "http://192.168.137.1/SistemKendaraanDinasV3/pages/Android/request.php?iduser="+iduser+"&tujuan="+formtujuan.getText()+"&jumlah="+jmlkend.getText()+"&dari="+tvDateResult.getText()+"&darijam="+tvTimeResult.getText()+"&sampai="+tvDateResult2.getText()+"&sampaijam="+tvTimeResult2.getText()+"&keterangan="+keterangan.getText();
                try {

                    date1 = dateFormatter.parse(tvDateResult.getText().toString());
                    date2 = dateFormatter.parse(tvDateResult2.getText().toString());

                if(formtujuan.getText().toString().trim().length()==0||jmlkend.getText().toString().trim().length()==0||tvDateResult.getText().toString().trim().length()==0||tvTimeResult.getText().toString().trim().length()==0||tvDateResult2.getText().toString().trim().length()==0||tvTimeResult2.getText().toString().trim().length()==0||keterangan.getText().toString().trim().length()==0){
                    Toast.makeText(Formpeminjaman.this,"Terjadi Kesalahan Input",Toast.LENGTH_SHORT).show();
                }else if(date2.compareTo(date1)<0){
                    Toast.makeText(Formpeminjaman.this,"Tanggal Eror!",Toast.LENGTH_SHORT).show();
                }else if(date2.compareTo(date1)==0 && TimeValidator(tvTimeResult2.getText().toString(),tvTimeResult.getText().toString())){
                    Toast.makeText(Formpeminjaman.this,"Time Eror!",Toast.LENGTH_SHORT).show();
                }else{
                    getData();
                }
                } catch (ParseException e) {
                    e.printStackTrace();
                }


            }
        });


    }
    private void showDateDialog(){

        /**
         * Calendar untuk mendapatkan tanggal sekarang
         */
        Calendar newCalendar = Calendar.getInstance();

        /**
         * Initiate DatePicker dialog
         */
        datePickerDialog = new DatePickerDialog(this, new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {

                /**
                 * Method ini dipanggil saat kita selesai memilih tanggal di DatePicker
                 */

                /**
                 * Set Calendar untuk menampung tanggal yang dipilih
                 */
                Calendar newDate = Calendar.getInstance();
//                year = years;
//                monthOfYear = months;
//                dayOfMonth = days;
                if(year > myear)
                newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult.setText(""+dateFormatter.format(newDate.getTime()));
                if(monthOfYear > month && year == myear)
                    newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult.setText(""+dateFormatter.format(newDate.getTime()));
                if (dayOfMonth > day && year == myear && monthOfYear == month)
                    newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult.setText(""+dateFormatter.format(newDate.getTime()));


                if(year < myear)
                    Toast.makeText(Formpeminjaman.this,"Tanggal Eror!",Toast.LENGTH_SHORT).show();
                if(monthOfYear < month && year == myear)
                    Toast.makeText(Formpeminjaman.this,"Tanggal Eror",Toast.LENGTH_SHORT).show();
                if (dayOfMonth < day && year == myear && monthOfYear == month)
                    Toast.makeText(Formpeminjaman.this,"Tanggal Eror",Toast.LENGTH_SHORT).show();

                /**
                 * Update TextView dengan tanggal yang kita pilih
                 */



            }

        },myear = newCalendar.get(Calendar.YEAR), month = newCalendar.get(Calendar.MONTH), day = newCalendar.get(Calendar.DAY_OF_MONTH));

        /**
         * Tampilkan DatePicker dialog
         */
        datePickerDialog.show();
    }
    private void showDateDialog2(){

        /**
         * Calendar untuk mendapatkan tanggal sekarang
         */
        Calendar newCalendar = Calendar.getInstance();

        /**
         * Initiate DatePicker dialog
         */
        datePickerDialog = new DatePickerDialog(this,   new DatePickerDialog.OnDateSetListener() {

            @Override
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {

                /**
                 * Method ini dipanggil saat kita selesai memilih tanggal di DatePicker
                 */

                /**
                 * Set Calendar untuk menampung tanggal yang dipilih
                 */

                Calendar newDate = Calendar.getInstance();
                if(year > year2)
                    newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult2.setText(""+dateFormatter.format(newDate.getTime()));
                if(monthOfYear > month2 && year == year2)
                    newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult2.setText(""+dateFormatter.format(newDate.getTime()));
                if (dayOfMonth > day2 && year == year2 && monthOfYear == month2)
                    newDate.set(year, monthOfYear, dayOfMonth);
                tvDateResult2.setText(""+dateFormatter.format(newDate.getTime()));
                if(year < year2)
                    Toast.makeText(Formpeminjaman.this,"Tanggal Eror!",Toast.LENGTH_SHORT).show();
                if(monthOfYear < month2 && year == year2)
                    Toast.makeText(Formpeminjaman.this,"Tanggal Eror",Toast.LENGTH_SHORT).show();
                if (dayOfMonth < day2 && year == year2 && monthOfYear == month2)
                    Toast.makeText(Formpeminjaman.this,"Tanggal Eror",Toast.LENGTH_SHORT).show();

                /**
                 * Update TextView dengan tanggal yang kita pilih
                 */


            }

        },year2=newCalendar.get(Calendar.YEAR), month2=newCalendar.get(Calendar.MONTH), day2=newCalendar.get(Calendar.DAY_OF_MONTH));
//            tvDateResult2.setText(new StringBuilder().append(month2+1).append("-").append(day2).append( ));
        /**
         * Tampilkan DatePicker dialog
         */
        datePickerDialog.show();
    }

    private void showTimeDialog() {

        /**
         * Calendar untuk mendapatkan waktu saat ini
         */
        Calendar calendar = Calendar.getInstance();

        /**
         * Initialize TimePicker Dialog
         */
        timePickerDialog = new TimePickerDialog(this, new TimePickerDialog.OnTimeSetListener() {
            @Override
            public void onTimeSet(TimePicker view, int hourOfDay, int minute) {
                /**
                 * Method ini dipanggil saat kita selesai memilih waktu di DatePicker
                 */
                tvTimeResult.setText(+hourOfDay+":"+minute);
            }
        },
                /**
                 * Tampilkan jam saat ini ketika TimePicker pertama kali dibuka
                 */
                calendar.get(Calendar.HOUR_OF_DAY), calendar.get(Calendar.MINUTE),

                /**
                 * Cek apakah format waktu menggunakan 24-hour format
                 */
                DateFormat.is24HourFormat(this));

        timePickerDialog.show();
    }
    private void showTimeDialog2() {

        /**
         * Calendar untuk mendapatkan waktu saat ini
         */
        Calendar calendar = Calendar.getInstance();

        /**
         * Initialize TimePicker Dialog
         */
        timePickerDialog = new TimePickerDialog(this, new TimePickerDialog.OnTimeSetListener() {
            @Override
            public void onTimeSet(TimePicker view, int hourOfDay, int minute) {
                /**
                 * Method ini dipanggil saat kita selesai memilih waktu di DatePicker
                 */
                tvTimeResult2.setText(""+hourOfDay+":"+minute);
            }
        },
                /**
                 * Tampilkan jam saat ini ketika TimePicker pertama kali dibuka
                 */
                calendar.get(Calendar.HOUR_OF_DAY), calendar.get(Calendar.MINUTE),

                /**
                 * Cek apakah format waktu menggunakan 24-hour format
                 */
                DateFormat.is24HourFormat(this));

        timePickerDialog.show();
    }
    private  void getData(){
        String url = "http://192.168.137.1/SistemKendaraanDinasV3/pages/Android/request.php?key=12345&iduser="+iduser+"&tujuan="+formtujuan.getText()+"&jumlah="+jmlkend.getText()+"&dari="+tvDateResult.getText()+"&darijam="+tvTimeResult.getText()+"&sampai="+tvDateResult2.getText()+"&sampaijam="+tvTimeResult2.getText()+"&ket="+keterangan.getText();

        requestQueue = Volley.newRequestQueue(this);
        JsonObjectRequest objectRequest = new JsonObjectRequest(Request.Method.GET, url,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            status = response.getInt("status");
                            msg = response.getString("msg");

                            Intent it = new Intent(Formpeminjaman.this,id.saspossible.sistempeminjamankd.daftarpinjaman.class);
                            Bundle bundle = new Bundle();
                            bundle.putString("iduser",iduser);
                            it.putExtras(bundle);
                            startActivity(it);
                            finish();

                            Toast.makeText(Formpeminjaman.this,msg,Toast.LENGTH_SHORT).show();


                        } catch (JSONException e) {
                            Toast.makeText(Formpeminjaman.this, "gagal", Toast.LENGTH_SHORT).show();
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
    public boolean TimeValidator(String time1, String time2) {

        SimpleDateFormat sdf = new SimpleDateFormat("HH:mm");
        boolean b = false;
        try {
            java.util.Date ArrTime = sdf.parse(time1);
            java.util.Date DepTime = sdf.parse(time2);

            // Function to check whether a time is after an another time
            b = DepTime.after(ArrTime);
        } catch (ParseException e) {
//             TODO Auto-generated catch block
            e.printStackTrace();
        }

        return b;
    }


}
