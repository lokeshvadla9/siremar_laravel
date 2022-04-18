<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    //
    function registerToSchool(Request $request)
    {
        try{
            $user_id=$request->user_id;
            $school_id=$request->school_id;
            $course_name=$request->course_name;
            $is_deleted=$request->is_deleted;
            $sql="CALL sproc_siremar_InsertOrUpdateSchoolRegistration('$user_id','$school_id','$course_name','$is_deleted')";
            $result=DB::select($sql);
            return json_encode(array("response"=>"success","data"=>$result[0]));
        }
        catch (Throwable $e) {
            report($e);
            return json_encode(array("response"=>"failure","data"=>NULL));
        }
    }
    function getSchools()
    {
        try {
            $sql="CALL sproc_siremar_get_schools()";
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

    function getSchoolRegistrationById(Request $request,$user_id)
    {
        try {
            $sql="CALL sproc_siremar_get_schoolRegistrationByUserId('$user_id')";
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
