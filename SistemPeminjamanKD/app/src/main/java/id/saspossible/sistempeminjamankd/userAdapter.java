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

public class userAdapter extends RecyclerView.Adapter<userAdapter.userHolder> {

    private ArrayList<userModel> mData;

    public userAdapter(ArrayList<userModel> mData) {
        this.mData = mData;
    }
    @Override
    public userAdapter.userHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View vRoot = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_daftar,parent,false);
        return new userHolder(vRoot);
    }

    @Override
    public void onBindViewHolder(userAdapter.userHolder holder, int position) {
        userModel moe = mData.get(position);
        holder.nama.setText(moe.getNama());
        holder.email.setText(moe.getEmail());
        holder.ket.setText(moe.getKet());
    }

    @Override
    public int getItemCount() {
        return mData.size();
    }
    public static class userHolder extends  RecyclerView.ViewHolder{

        TextView nama;
        TextView email;
        TextView ket;


        public userHolder(View itemView) {
            super(itemView);
            nama = (TextView) itemView.findViewById(R.id.tujuan);
            email = (TextView) itemView.findViewById(R.id.tanggal);
            ket = (TextView) itemView.findViewById(R.id.status);
        }
    }
}
