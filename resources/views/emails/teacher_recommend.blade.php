@component('mail::message')

Hi {{ $user->name }},

<p>This School ID (<b>{{ $job->user->school_id }}</b>) matched your requirements, please click here to view details. </p>

Thanks,<br>
VISFFOR TEAM
@endcomponent