<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    function insertOrUpdateClinic(Request $request)
    {
        try{
            $clinic_id=$request->clinic_id;
            $clinic_name=$request->clinic_name;
            $clinic_address=$request->clinic_address;
            $is_deleted=$request->is_deleted;
            $sql="CALL sproc_siremar_InsertOrUpdateClinic('$clinic_id','$clinic_name','$clinic_address','$is_deleted')";
            $result=DB::select($sql);
            return json_encode(array("response"=>"success","data"=>$result[0]));
        }
        catch (Throwable $e) {
            report($e);
            return json_encode(array("response"=>"failure","data"=>NULL));
        }
    }
    function getClinics()
    {
        try {
            $sql="CALL sproc_siremar_get_clinicDetails()";
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
