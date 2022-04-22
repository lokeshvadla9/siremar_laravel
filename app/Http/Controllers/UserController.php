<?php

namespace App\Http\Controllers;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
class UserController extends Controller
{
    //
   function login(Request $request){
       try
       {
            $username=$request->username;
            $password=$request->password;
            $role_type=$request->role_type;
            $result=DB::select("call sproc_siremar_login('$username','$password','$role_type')");
            return json_encode(array("response"=>"success","data"=>$result[0]));     
       }
       catch (Throwable $e) {
        report($e);
        return json_encode(array("response"=>"failure","data"=>NULL));
        }
    }

    function createOrUpdateUser(Request $request)
    {
        try
       {
             $user_id=$request->user_id;
            $first_name=$request->first_name;
            $last_name= $request->last_name;
            $address=$request->address;
            $county_id= $request->county_id;
            $dob=$request->dob;
            $gender=$request->gender;
            $is_citizen=$request->is_citizen;
            $phone_no=$request->phone_no;
            $email_id=$request->email_id;
            $passcode=$request->passcode;
            $role_type=$request->role_type;
            $is_deleted=$request->is_deleted;
            if($user_id=='-1')
            {
                $sql="CALL sproc_siremar_user_registration('$first_name','$last_name','$address','$county_id','$dob','$gender','$is_citizen','$phone_no','$email_id','$passcode','$role_type','$is_deleted')";
                $details=["name"=> $first_name];
                Mail:: to($email_id)->send(new WelcomeMail($details));

            }
            else{
                $sql="CALL sproc_siremar_update_user_details('$user_id','$first_name','$last_name','$address','$county_id','$dob','$gender','$is_citizen','$phone_no','$email_id','$passcode','$role_type','$is_deleted')";
            }
            $result=DB::select($sql);
            return json_encode(array("response"=>"success","data"=>$result[0]));     
       }
       catch (Throwable $e) {
            report($e);
            return json_encode(array("response"=>"failure","data"=>NULL));
        }

    }

    function getUserDetails(Request $request,$role_type)
    {
        try{
            $sql="CALL sproc_siremar_get_userDetails('$role_type')";
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
