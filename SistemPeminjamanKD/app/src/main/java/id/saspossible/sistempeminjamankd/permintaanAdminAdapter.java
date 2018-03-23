package id.saspossible.sistempeminjamankd;


import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;

import java.util.ArrayList;

/**
 * Created by ASUS on 21 Jun 2017.
 */

public class permintaanAdminAdapter extends RecyclerView.Adapter<permintaanAdminAdapter.adminHolder> {
   // private final Context mcontext;

    private ArrayList<permintaanModel> xData;
    Context context;
    Bundle bundle = new Bundle();

    public  permintaanAdminAdapter(ArrayList<permintaanModel> xData){
        this.xData = xData;
    }
    @Override
    public permintaanAdminAdapter.adminHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View vRoot = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_daftar,parent,false);
        return new adminHolder(vRoot);
    }

    @Override
    public void onBindViewHolder(permintaanAdminAdapter.adminHolder holder, int position) {
        permintaanModel moe = xData.get(position);
        holder.tujuan.setText(moe.getTujuan_peminjaman());
 //       holder.tujuan.setTag(moe.getTujuan_peminjaman());
        holder.tanggal.setText(moe.getWaktu_pinjam());
        holder.status.setText(moe.getStatus_peminjaman());
        String tujuan = moe.getTujuan_peminjaman();
        holder.laylay.setTag(moe);
      /*  holder.laylay.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final Intent it = new Intent(mcontext,id.saspossible.sistempeminjamankd.DetailPeminjaman.class );
                it.putExtra("detail_permintaan", (android.os.Parcelable) moe);
                mcontext.startActivity(it);

            }
        });*/


    }

    @Override
    public int getItemCount() {
        return xData.size();
    }
    public static class adminHolder extends  RecyclerView.ViewHolder implements View.OnClickListener{

        TextView tujuan;
        TextView tanggal;
        TextView status;
       CardView laylay;


        public adminHolder(View itemView) {
            super(itemView);
            tujuan = (TextView) itemView.findViewById(R.id.tujuan);
            tanggal = (TextView) itemView.findViewById(R.id.tanggal);
            status = (TextView) itemView.findViewById(R.id.status);
            laylay = (CardView) itemView.findViewById(R.id.laylay);

            laylay.setOnClickListener(this);
        }

        @Override
        public void onClick(View v) {

            permintaanModel cards=(permintaanModel) v.getTag();
            if (cards.getStatus_peminjaman().equals("Pending")){
                Intent it = new Intent (v.getContext(), DetailPeminjaman.class);
                Bundle bundle = new Bundle();
                bundle.putString("id_peminjaman",cards.getId_peminjaman());
                bundle.putString("nama",cards.getNama());
                bundle.putString("tujuan_peminjaman",cards.getTujuan_peminjaman());
                bundle.putString("waktu_pinjam",cards.getWaktu_pinjam());
                bundle.putString("status",cards.getStatus_peminjaman());
                bundle.putString("jumlah_kendaraan",cards.getJumlah_kendaraan());
                it.putExtras(bundle);
                v.getContext().startActivity(it);

            }else {
                Intent it = new Intent (v.getContext(), DetailPeminjaman2.class);
                Bundle bundle = new Bundle();
                bundle.putString("id_peminjaman",cards.getId_peminjaman());
                bundle.putString("nama",cards.getNama());
                bundle.putString("tujuan_peminjaman",cards.getTujuan_peminjaman());
                bundle.putString("waktu_pinjam",cards.getWaktu_pinjam());
                bundle.putString("status",cards.getStatus_peminjaman());
                bundle.putString("jumlah_kendaraan",cards.getJumlah_kendaraan());
                it.putExtras(bundle);
                v.getContext().startActivity(it);

            }
//            String id_pijaman =  cards.getId_peminjam();

        }
    }
}
