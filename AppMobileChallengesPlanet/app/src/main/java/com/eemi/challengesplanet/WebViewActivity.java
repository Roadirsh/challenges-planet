package com.eemi.challengesplanet;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.webkit.WebView;


public class WebViewActivity extends ActionBarActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_web_view);

        Intent intent= getIntent();
        Uri blogUri = intent.getData();

        WebView webView = (WebView) findViewById(R.id.webView);
        webView.loadUrl(blogUri.toString());
    }



}
