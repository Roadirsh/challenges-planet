package com.eemi.challengesplanet;

import android.app.AlertDialog;
import android.app.ListActivity;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.Bundle;
import android.text.Html;
import android.util.Log;
import android.view.View;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.SimpleAdapter;
import android.widget.Toast;

import com.squareup.okhttp.Call;
import com.squareup.okhttp.Callback;
import com.squareup.okhttp.OkHttpClient;
import com.squareup.okhttp.Request;
import com.squareup.okhttp.Response;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;


public class MainListActivity extends ListActivity {

    protected JSONArray mEventData;
    protected ProgressBar mProgressBar;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main_list);

        mProgressBar = (ProgressBar) findViewById(R.id.progressBar);
        if(isNetWorkAvailable()) {

        OkHttpClient client = new OkHttpClient();
        Request request = new Request.Builder()
                .url("http://ns366377.ovh.net/cambour/perso/Challenges-Planet/front-cp/public/index.php?module=event&action=Eventjson")
                .build();

        Call call = client.newCall(request);
        call.enqueue(new Callback() {
            @Override
            public void onFailure(Request request, IOException e) {
                updateDisplayForError("There is no events found sorry :(");

            }

            @Override
            public void onResponse(Response response) throws IOException {



                try {
                    String jsonData = response.body().string();

                    if (response.isSuccessful()) {
                        mEventData = new JSONArray(jsonData);
                        runOnUiThread(new Runnable() {
                            @Override
                            public void run() {
                                handleResponse();

                            }
                        });
                    } else {
                        updateDisplayForError("There is no events found sorry :(");
                    }
                } catch (IOException e) {
                    Log.e("Test", "Exception caught: ", e);
                } catch (JSONException e) {
                    Log.e("Test", "Exception caught: ", e);

                }

            }
        });
    }

    else

    {
        Toast.makeText(this, "No network", Toast.LENGTH_LONG).show();
        updateDisplayForError("Please check your network :(");
    }

}



    private boolean isNetWorkAvailable() {
        ConnectivityManager manager = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = manager.getActiveNetworkInfo();
        boolean isAvailable = false;
        if(networkInfo != null && networkInfo.isConnected()){
            isAvailable = true;
        }
        return isAvailable;
    }










    private void handleResponse() {
        mProgressBar.setVisibility(View.INVISIBLE);

        if(mEventData == null){
            updateDisplayForError("There is no events found sorry :(");
        }else{
            try {
                ArrayList<HashMap<String, String>> blogPosts = new ArrayList<HashMap<String, String>>();
                for(int i =0; i < mEventData.length(); i++){
                    JSONObject post = mEventData.getJSONObject(i);
                    String name = post.getString("event_name");
                    name = Html.fromHtml(name).toString();
                    String location = post.getString("event_location");
                    location = Html.fromHtml(location).toString();

                    HashMap<String, String> blogPost = new HashMap<String, String>();
                    blogPost.put("event_name", name);
                    blogPost.put("event_location", location);
                    blogPosts.add(blogPost);
                }
                String[] keys = { "event_name", "event_location"};
                int[] ids = { android.R.id.text1, android.R.id.text2};
                SimpleAdapter adapter = new SimpleAdapter(this, blogPosts, android.R.layout.simple_list_item_2, keys, ids);
                setListAdapter(adapter);
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }





    private void updateDisplayForError(String message) {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle("Oops :(");
        builder.setMessage(message);
        builder.setPositiveButton(android.R.string.ok, null);
        AlertDialog dialog = builder.create();
        dialog.show();


    }





    @Override
    protected void onListItemClick(ListView l, View v, int position, long id) {
        super.onListItemClick(l, v, position, id);
        try {

            JSONObject jsonPost = mEventData.getJSONObject(position);
            String id_event =  jsonPost.getString("event_id");
            Intent intent = new Intent(this, GroupEventActivity.class);
            intent.putExtra("id", id_event);
            startActivity(intent);
        } catch (JSONException e) {
            e.printStackTrace();
        }

    }


}
