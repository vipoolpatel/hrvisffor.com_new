@component('mail::message')

Hi {{ $school->school_name }},

<p>This Teacher ID (<b>{{ $teacher->teacher_id }}</b>) matched your requirements, please click here to view details. </p>

Thanks,<br>
VISFFOR TEAM
@endcomponent