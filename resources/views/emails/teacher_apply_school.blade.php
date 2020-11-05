@component('mail::message')

Hi {{ $job_apply->job->user->school_name }},

<p>{{ $job_apply->user->name }}({{ $job_apply->user->teacher_id }}) invites you to join the interview. Please <a href="{{ url('login') }}">login</a> your account to check school details. Provided the following available time.</p>

Kind regards,<br>
VISFFOR TEAM
@endcomponent