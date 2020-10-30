<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Attendance;
use App\Schedule;

use Carbon;

class AttendanceJob extends Command
{
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'attendance:today';
    
    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = "Today's attendance successfully stored";
    
    /**
    * Create a new command instance.
    *
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
    * Execute the console command.
    *
    * @return mixed
    */
    public function handle()
    {
        $attendance_get = Attendance::orderBy('current_time','desc')->first();
        if($attendance_get == null)
        {
            $date_last_from = '2019-05-17';
            $hour_last_to = '00:00:00';
        }
        else
        {
        $date_last_from = date('Y-m-d',strtotime($attendance_get->current_time));
        $hour_last_to = date('H:i:s',strtotime($attendance_get->current_time));
        }
        $date_today = date('Y-m-d');
        $date_hour_today = date('H:i:s');  

        // $date_today = '2019-06-07';
        // $date_hour_today = '23:59:59';  
        $client = new Client([
            'base_uri' => 'http://172.17.2.24:8795/v2/',
            'cookies' => true,
            ]);
        $client->request('POST', 'login', [
            'json' => [
                'name' => 'BACKGROUND API',
                'password' => '{iamprogrammer}',
                'user_id' => 'backgrounduser'
                ]
                ]);
            $response = $client->request('POST', 'monitoring/event_log/search', [
            'json' => [
                'datetime' => [$date_last_from.'T'.$hour_last_to.'.00Z',$date_today.'T'.$date_hour_today.'.59Z'],
                'limit' => 1000000,
                'offset' => 0
                ]
                ]);
        
        $client->request('GET','logout');
        if($response->getStatusCode() == 200)
        {
            $attendances = json_decode((string) $response->getBody(), true);
            foreach(array_reverse($attendances['records']) as $value)
            {
                if(array_key_exists('tna_key',$value))
                {
                    if($value['tna_key'] == 1)
                    {
                        $attendance = new Attendance;
                        $attendance->laborer_id  = $value['user']['user_id'];   
                        $attendance->time_in = date('Y-m-d H:i:s', strtotime ( '+0 hour' ,strtotime($value['datetime'])));
                        $attendance->device_in = $value['device']['id'];
                        $attendance->current_time = date('Y-m-d H:i:s', strtotime ( '-8 hour' ,strtotime($value['datetime'])));
                        $attendance->save();   
                    }
                    else
                    {
                        $time_in_after = date('Y-m-d H:i:s',strtotime($value['datetime']." UTC"));
                        $time_in_before = date('Y-m-d H:i:s', strtotime ( '-24 hour' , strtotime ( $time_in_after ) )) ;
                        $update = [
                            'time_out' =>  date('Y-m-d H:i:s', strtotime ( '+0 hour' ,strtotime($value['datetime']))),
                            'device_out' => $value['device']['id'],
                            'current_time' =>date('Y-m-d H:i:s', strtotime ( '-8 hour' ,strtotime($value['datetime']))),
                        ];
                        Attendance::where('laborer_id',$value['user']['user_id'])
                        ->whereBetween('time_in',[$time_in_before,$time_in_after])
                        ->update($update);
                    }
                }
            }
        }
    }
}
                    