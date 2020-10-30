<?php

namespace App\Http\Controllers;
use App\Device;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class DeviceController extends Controller
{
    //
    public function view_device(Request $request)
    {
        $devices = Device::get();



        return view('devices',array(
            'devices' => $devices,
        ));
    }

    public function generate_devices(Request $request)
    {
        $client = new Client([
            'base_uri' => 'http://172.17.2.24:8795/v2/',
            'cookies' => true,
            ]);
            
            $client->request('POST', 'login', [
                'json' => [
                    'name' => 'IC TEST API',
                    'password' => 'iamprogrammer',
                    'user_id' => 'dev'
                    ]
                    ]);
            $response = $client->get('devices', [  
                'query' => [
                    'offset' => 0,
                    'limit' => 100000
                    ]
                    ]);  
        if($response->getStatusCode() == 200){
            $devices = json_decode((string) $response->getBody(), true);
                foreach ($devices['records'] as $device)
                {
                    $device_exist = Device::where('id',$device['id'])->first();
                    if($device_exist == null)
                    {
                    $new_device = new Device;
                    $new_device->name = $device['name'];
                    $new_device->id = $device['id'];
                    $new_device->save();
                    }
                    else
                    {
                 
                    }
                }
            $request->session()->flash('status','IC Employee Generated Successfully');
            return back();
        }
    }
    public function edit_device(Request $request,$id)
    {
        $device_exist = Device::where('id',$id)->first();
        $device_exist->name = $request->device_name;
        $device_exist->save();
        $request->session()->flash('status','Succesfully Changed');
        return back();
    }
}