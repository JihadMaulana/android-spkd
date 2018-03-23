package id.saspossible.sistempeminjamankd;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import org.json.JSONArray;

import java.util.ArrayList;

/**
 * Created by ASUS on 21 Jun 2017.
 */

public class pegawaiAdapter extends RecyclerView.Adapter<pegawaiAdapter.pegawaiHolder> {
    private ArrayList<permintaanModel> mData;

    public pegawaiAdapter(ArrayList<permintaanModel> mData) {
        this.mData = mData;
    }

    @Override
    public pegawaiAdapter.pegawaiHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View vRoot = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_daftar,parent,false);
        return new pegawaiHolder(vRoot);
    }

    @Override
    public void onBindViewHolder(pegawaiAdapter.pegawaiHolder holder, int position) {
        permintaanModel moe = mData.get(position);
        holder.tujuan.setText(moe.getTujuan_peminjaman());
        holder.tanggal.setText(moe.getWaktu_pinjam());
        holder.status.setText(moe.getStatus_peminjaman());
        holder.laylay.setTag(moe);

    }

    @Override
    public int getItemCount() {
        return mData.size();
    }
    public static class pegawaiHolder extends  RecyclerView.ViewHolder implements View.OnClickListener{

        TextView tujuan;
        TextView tanggal;
        TextView status;
        CardView laylay;


        public pegawaiHolder(View itemView) {
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

            if(cards.getStatus_peminjaman().equals("Pending")){
                Intent it = new Intent (v.getContext(), Detailpinjamuser.class);
                Bundle bundle = new Bundle();
                bundle.putString("id_peminjaman",cards.getId_peminjaman());
                bundle.putString("nama",cards.getNama());
                bundle.putString("tujuan_peminjaman",cards.getTujuan_peminjaman());
                bundle.putString("waktu_pinjam",cards.getWaktu_pinjam());
                bundle.putString("status",cards.getStatus_peminjaman());
                bundle.putString("jumlah_kendaraan",cards.getJumlah_kendaraan());
                it.putExtras(bundle);
                v.getContext().startActivity(it);
            }else{
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

        }
    }
}

