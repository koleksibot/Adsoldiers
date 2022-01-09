@component('mail::message')
# Reset Your Password !
Hello {{ $user->first_name }},
Hopefully you are having a great day :)
please click on the link below to finish up the reset password process
@component('mail::button', ['url' => 'http://www.vi.hit/auth' . sprintf('/reset-password/%s/%s', $user->email, $token)])
Reset Your Password
@endcomponent

Cheers,<br>
{{ config('app.name') }} !
@endcomponent
