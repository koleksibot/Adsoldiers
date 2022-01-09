@component('mail::message')
# Adsoldiers Email Activation
Hello {{ $user->username }},
We are glad that you are joining us, Let's hope you enjoy our website
We know It's really annoying to activate your account, but the world is full of spammers.
Just press the link below and we are done.

@component('mail::button', ['url' => 'http://www.vi.hit/auth/activate/'. $user->email .'/' . $token])
Activate Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
