<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class QueriesController extends Controller
{
    function contactus(Request $request)
    {
        try{
            $first_name=$request->first_name;
            $last_name= $request->last_name;
            $email_id=$request->email_id;
            $phone_no=$request-> phone_no;
            $description=$request-> description;
            $sql="CALL sproc_siremar_insert_contact_us('$first_name','$last_name','$phone_no','$email_id','$description')";
            $result=DB::select($sql);
            return json_encode(array("response"=>"success","data"=>$result[0]));
        }
        catch (Throwable $e) {
            report($e);
            return json_encode(array("response"=>"failure","data"=>NULL));
        }
    }

    function getQueries()
    {
        
    }
}
