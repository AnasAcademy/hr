@extends('email.common')

@section('content')

    <p><strong>Dear {{$manager}},</strong></p>
    <p>I Ask to add my device to be able to register attendance in HR System</p>

    <p class="mt-5">{{config('APP_URL')}}</p>
    <p>Thank you</p>
    <p><strong>Regards,</strong></p>
    <p><strong>{{config('app_name')}}</strong></p>
@endsection
