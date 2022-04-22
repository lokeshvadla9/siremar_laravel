@component('mail::message')
# Welcome {{$details['name']}} 

Hello {{$details['name']}},<br>
 Welcome to Siremar!!!<br> we are very excited to have you in siremar and happy to serve. 
 Please feel free to reach us out for any queries. 

@component('mail::button', ['url' => 'https://siremar.herokuapp.com'])
Explore More
@endcomponent

Thanks,<br>
{{ config('app.name') }} Admin
@endcomponent
