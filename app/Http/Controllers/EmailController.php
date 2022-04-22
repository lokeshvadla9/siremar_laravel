<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;

class EmailController extends Controller
{
    //
    function forgotPassword(Request $request){
        $email_id=$request->email_id;
        $sql="CALL sproc_siremar_forgotpassword('$email_id')";
        $result=DB::select($sql);
        if($result[0]->response==1)
        {
            $details=[
                'name'=>$result[0]->Name,
                'password'=>$result[0]->Password
            ];
            Mail:: to($email_id)->send(new ForgotPasswordMail($details));
            return json_encode(array("response"=>"success","data"=>"password sent to your email, please check."));
        }
        else{
            //return $result[0]->response;
            return json_encode(array("response"=>"failure","data"=>"It seems User not existed"));
        }
    }
}
