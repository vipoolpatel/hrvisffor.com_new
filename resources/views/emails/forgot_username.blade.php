@component('mail::message')
Hi, {{$user->name}}. Forgot Your Username?

<p>Your Username: <b>{{$user->username}}</b></p>



Thanks,<br>
VISFFOR TEAM
@endcomponent