<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    function insertOrUpdateBusiness(Request $request)
    {
        try{
                $business_name=$request->business_name;
                $business_address=$request->business_address;
                $is_deleted=$request->is_deleted;
                $business_id=$request->business_id;
                $sql="CALL sproc_siremar_InsertOrUpdateBusinessDetails('$business_name','$business_address','$is_deleted','$business_id')";
                $result=DB::select($sql);
                return json_encode(array("response"=>"success","data"=>$result[0]));
        }
        catch (Throwable $e) {
            report($e);
            return json_encode(array("response"=>"failure","data"=>NULL));
        }
    }

    function getBusinessDetails()
    {
        try{
            $sql="CALL sproc_siremar_get_BusinessDetails()";
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
