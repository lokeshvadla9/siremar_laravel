@component('mail::message')
# Forgot Password

Hello {{$details["name"]}},<br>
 
As you requested you forgot your password !!!<br> your password is: <h1>{{$details["password"]}}</h1><br> 
This mail is confedential and not disclosable.Also advised you to change your password.

@component('mail::button', ['url' => 'https://siremar.herokuapp.com'])
Login Here
@endcomponent

Thanks,<br>
{{ config('app.name') }} Admin
@endcomponent
