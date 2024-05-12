{{-- @extends('email.common')

@section('content') --}}

    <p><strong>Dear {{$manager}},</strong></p>
    <p>I Ask to add my device to be able to register attendance in HR System</p>

    <p class="mt-5">{{config('APP_URL')}}</p>
    <p>Thank you</p>
    <p><strong>Regards,</strong></p>
    <p><strong>{{config('app_name')}}</strong></p>
{{-- @endsection --}}
<p>Dear {employee_name},&nbsp;<br>Welcome to {app_name} HR System.</p>
<p>I Ask to add my device to be able to register attendance in HR System.</p>

<p>{app_url}</p>
<p>Thanks,<br>{app_name}</p>
