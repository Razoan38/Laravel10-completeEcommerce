@component('mail::message')

Hi <b>{{ $user->name }}</b>,
<p>You're almost ready to start enjoying the benefits of laravel-10-ecomerce</p>
<p>Simple Click This Button below to verify your email Address</p>

<p>
    @component('mail::button', ['url' => url('activate/'.base64_encode($user->id))])
     verify
    @endcomponent
</p>

<p>This will verify your email address , and them you'll officially be a part of the laravel-10-ecomerce </p>
    
@endcomponent