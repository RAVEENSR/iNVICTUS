package com.example.goldlion.bluebeacon;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.CompoundButton;
import android.widget.TextView;
import android.widget.ToggleButton;

import com.estimote.sdk.BeaconManager;
import com.estimote.sdk.Nearable;
import com.estimote.sdk.SystemRequirementsChecker;
import com.estimote.sdk.eddystone.Eddystone;

import java.util.List;

public class MainActivity extends Activity {
    public static final String TAG = "My Message";
    //AppCompatActivity

    //This is for the default maybe
    //Intent i = new Intent();
   // Activity a = new Activity();


    MyBringBack ourView;
    public Context getC() {
        return getApplicationContext();
    }

    private BeaconManager beaconManager ;
    private String scanId;

    @Override
    protected void onResume() {
        super.onResume();

        SystemRequirementsChecker.checkWithDefaultDialogs(this);
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {


        //TextView myText= (TextView)findViewById(R.id.text1);
        ourView = new MyBringBack(this);
        beaconManager= new BeaconManager(this);
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
       // myText.setText("My Awesome Text");


        //Go to wishlist
        Button next = (Button) findViewById(R.id.butList);
        next.setOnClickListener(new View.OnClickListener() {
            public void onClick(View view) {
                Intent myIntent = new Intent(view.getContext(), Wishlist.class);
                startActivityForResult(myIntent, 0);
            }

        });
        //Eddystone
        beaconManager.setEddystoneListener(new BeaconManager.EddystoneListener() {
            @Override public void onEddystonesFound(List<Eddystone> eddystones) {
                Log.d(TAG, "Nearby Eddystone beacons: " + eddystones);
                TextView text = (TextView)findViewById(R.id.t1);
                int i=0;
                text.setText(eddystones.get(i).namespace);
            }
        });
        //Toggel button
        ToggleButton toggle = (ToggleButton) findViewById(R.id.toggleBut);
        toggle.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                if (isChecked) {
                    beaconManager.setEddystoneListener(new BeaconManager.EddystoneListener() {
                        @Override public void onEddystonesFound(List<Eddystone> eddystones) {
                            Log.d(TAG, "Nearby Eddystone beacons: " + eddystones);
                            TextView text = (TextView)findViewById(R.id.t1);
                            int i=0;
                            if(eddystones.size()>0) {
                                text.setText(eddystones.get(i).namespace);
                            }
                            else{

                                text.setText("No beacons in range");
                            }
                            eddystones.clear();
                        }
                    });
                    // The toggle is enabled
                } else {
                    // The toggle is disabled
                }
            }
        });
        //Default
        /*beaconManager.setNearableListener(new BeaconManager.NearableListener() {
            @Override public void onNearablesDiscovered(List<Nearable> nearables) {
                //Log.d(TAG, "Discovered nearables: " + nearables);
                TextView text = (TextView)findViewById(R.id.t1);
                int i=0;

                text.setText(nearables.get(i).identifier);

            }
        });*/
       /* Button text = (Button) findViewById(R.id.butText);
        text.setOnClickListener(new View.OnClickListener() {
            public void onClick(View view) {
                TextView text = (TextView)findViewById(R.id.t1);
                text.setText("Welcome to android");
                beaconManager.setEddystoneListener(new BeaconManager.EddystoneListener() {
                    @Override public void onEddystonesFound(List<Eddystone> eddystones) {
                        Log.d(TAG, "Nearby Eddystone beacons: " + eddystones);
                        TextView text = (TextView)findViewById(R.id.t1);
                        int i=0;
                        text.setText(eddystones.get(i).namespace);
                       // text.setText("OK");
                    }
                });
                //text.setText("OK");
                // Intent myIntent = new Intent(view.getContext(), Wishlist.class);
                //startActivityForResult(myIntent, 0);
            }

        });*/





    }

    @Override
    protected void onStart() {
        super.onStart();

        beaconManager= new BeaconManager(this);
        //Eddystone
        beaconManager.connect(new BeaconManager.ServiceReadyCallback() {
            @Override public void onServiceReady() {
                scanId = beaconManager.startEddystoneScanning();
            }
        });

        //Default
       /* beaconManager.connect(new BeaconManager.ServiceReadyCallback() {
            @Override public void onServiceReady() {
                scanId = beaconManager.startNearableDiscovery();
            }
        });*/
    }

    @Override
    protected void onStop() {
        super.onStop();
        //Default
        //beaconManager.stopNearableDiscovery(scanId);
        //Eddystone
        beaconManager.stopEddystoneScanning(scanId);
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        beaconManager.disconnect();
    }
}
