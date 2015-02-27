package com.eemi.challengesplanet;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.view.View;


public class MainActivity extends ActionBarActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
    }

    public void launchApp(View v){
        Intent intent = new Intent(this, MainListActivity.class);
        startActivity(intent);
    }
    public void launchTeams(View v){
        Intent intent = new Intent(this, GroupActivity.class);
        startActivity(intent);
    }


}
