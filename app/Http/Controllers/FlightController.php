<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    function insertOrUpdateFlight(Request $request)
    {
        try{
                $flight_id=$request->flight_id;
                $departure=$request->departure;
                $arrival=$request->arrival;
                $arrival_date=$request->arrival_date;
                $departure_date=$request->departure_date;
                $is_deleted=$request->is_deleted;
                $sql="CALL sproc_siremar_InsertOrUpdateFlights('$flight_id','$departure','$arrival','$departure_date','$arrival_date','$is_deleted')";
                $result=DB::select($sql);
                return json_encode(array("response"=>"success","data"=>$result[0]));
        }
        catch (Throwable $e) {
            report($e);
            return json_encode(array("response"=>"failure","data"=>NULL));
            }
    }

    function getFlightDetails()
    {
        try {
            $sql="CALL sproc_siremar_get_flights()";
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
