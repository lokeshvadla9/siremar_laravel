<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    function insertOrUpdateEvent(Request $request)
    {
        try{
            $event_name=$request->event_name;
            $event_date=$request->event_date;
            $event_time=$request->event_time;
            $event_venue=$request->event_venue;
            $is_deleted=$request->is_deleted;
            $event_id=$request->event_id;
            $sql="CALL sproc_siremar_create_event('$event_name','$event_date','$event_time','$event_venue','$is_deleted','$event_id')";
            $result=DB::select($sql);
            return json_encode(array("response"=>"success","data"=>$result[0]));
        }
        catch (Throwable $e) {
            report($e);
            return json_encode(array("response"=>"failure","data"=>NULL));
        }
    }

    function getEvents()
    {
        try {
            $sql="CALL sproc_siremar_get_events()";
            $result=DB::select($sql);
            if(sizeof($result)!=0)
                return json_encode(array("response"=>"success","data"=>$result));
            else
                return json_encode(array("response"=>"failure","data"=>$result));
        }
        catch (Throwable $e) {
            report($e);
            return json_encode(array("response"=>"failure","data"=>NULL));
        }
    }
}
