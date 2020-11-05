@component('mail::message')

Hi {{ $job_apply->user->name }},

<p>{{ $job_apply->job->user->school_name }}({{ $job_apply->job->user->school_id }}) invites you to join the interview. Please <a href="{{ url('login') }}">login</a> your account to check school details. Provided the following available time.</p>


Kind regards,<br>
VISFFOR TEAM
@endcomponent