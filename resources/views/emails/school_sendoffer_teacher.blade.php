@component('mail::message')

Hi {{ $offer->job_apply->user->name }},

<p>{{ $offer->school->school_id }} send you a new offer. The offer will be expired on {{ $offer->expired_date }}.  Please <a href="{{ url('login') }}">login</a> your account and check Offer. </p>

Kind regards,<br>
VISFFOR TEAM
@endcomponent