
@component('mail::message')
Hi Admin,

<p><strong>Full Name : </strong> {{ $record['full_name'] }} </p>
<p><strong>Email : </strong> {{ $record['email'] }} </p>
<p><strong>Phone : </strong> {{ $record['phone'] }} </p>
<p><strong>Subject : </strong> {{ $record['subject'] }} </p>
<p><strong>Message : </strong> {{ $record['message'] }} </p>

Thanks,<br>
{{ config('app.name') }} TEAM
@endcomponent