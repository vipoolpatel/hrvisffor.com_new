@component('mail::message')

Hi Admin,

<p>{{ $job_apply->user->name }}({{ $job_apply->user->teacher_id }}) invited {{ $job_apply->job->user->school_name }}({{ $job_apply->job->user->school_id }}) for interview. Provided the following available time.</p>

@foreach($job_apply->get_interview_time as $interview_time)
<p>{{ date('Y-m-d h:i A',$interview_time->interview_date_time) }} - {{ $interview_time->duration }} min</p>
@endforeach


Thanks,<br>
VISFFOR TEAM
@endcomponent