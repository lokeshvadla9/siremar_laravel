<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DiscountController extends Controller
{
    //
    function insertOrUpdateDiscount(Reuqest $request)
    {
        try{
            $discount_id = $request->discount_id;
            $discount_description = $request->discount_description;
            $is_active=$request->is_active;
            $expiry_date=$request->expiry_date;
            $sql="CALL sproc_siremar_InsertOrUpdateDiscount('$discount_id','$discount_description','$expiry_date','$is_active')";
            $result=DB::select($sql);
            return json_encode(array("response"=>"success","data"=>$result[0]));
        }
        catch (Throwable $e) {
            report($e);
            return json_encode(array("response"=>"failure","data"=>NULL));
        }
    }

    function getDiscounts()
    {
        try {
            $sql="CALL sproc_siremar_getDiscounts()";
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
