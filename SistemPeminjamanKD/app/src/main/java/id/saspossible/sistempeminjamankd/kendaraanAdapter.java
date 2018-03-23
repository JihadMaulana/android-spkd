package id.saspossible.sistempeminjamankd;

import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import java.util.ArrayList;

/**
 * Created by ASUS on 22 Jun 2017.
 */

public class kendaraanAdapter extends RecyclerView.Adapter<kendaraanAdapter.kendaraanHolder> {
    private ArrayList<kendaraanModel> mData;

    public  kendaraanAdapter(ArrayList<kendaraanModel> mData){
        this.mData = mData;
    }

    @Override
    public kendaraanAdapter.kendaraanHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View vRoot = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_daftar,parent,false);
        return new kendaraanHolder(vRoot);
    }

    @Override
    public void onBindViewHolder(kendaraanAdapter.kendaraanHolder holder, int position) {
        kendaraanModel moe = mData.get(position);
        holder.nama.setText(moe.getNama_kendaraan());
        holder.id.setText(moe.getId_kendaraan());
        holder.ket.setText(moe.getKet());

    }

    @Override
    public int getItemCount() {
        return mData.size();
    }
    public static class kendaraanHolder extends  RecyclerView.ViewHolder{

        TextView nama;
        TextView id;
        TextView ket;


        public kendaraanHolder(View itemView) {
            super(itemView);
            nama = (TextView) itemView.findViewById(R.id.tujuan);
            id = (TextView) itemView.findViewById(R.id.tanggal);
            ket = (TextView) itemView.findViewById(R.id.status);
        }
    }
}
