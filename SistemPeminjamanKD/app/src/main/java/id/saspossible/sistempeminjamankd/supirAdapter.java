package id.saspossible.sistempeminjamankd;

import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import java.util.ArrayList;

/**
 * Created by ASUS on 21 Jun 2017.
 */

public class supirAdapter extends RecyclerView.Adapter<supirAdapter.supirHolder> {
    private ArrayList<supirModel> mData;

    public supirAdapter(ArrayList<supirModel> mData) {
        this.mData = mData;
    }
    @Override
    public supirAdapter.supirHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View vRoot = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_daftar,parent,false);
        return new supirHolder(vRoot);
    }

    @Override
    public void onBindViewHolder(supirAdapter.supirHolder holder, int position) {
        supirModel moe = mData.get(position);
        holder.nama.setText(moe.getNama_supir());
        holder.id.setText(moe.getId_supir());
        holder.ket.setText(moe.getKet());
    }

    @Override
    public int getItemCount() {
        return mData.size();
    }
    public static class supirHolder extends  RecyclerView.ViewHolder{

        TextView nama;
        TextView id;
        TextView ket;


        public supirHolder(View itemView) {
            super(itemView);
            nama = (TextView) itemView.findViewById(R.id.tujuan);
            id = (TextView) itemView.findViewById(R.id.tanggal);
            ket = (TextView) itemView.findViewById(R.id.status);
        }
    }
}
