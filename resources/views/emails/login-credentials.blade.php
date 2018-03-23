@component('mail::message')
# Ваши Логин и Пароль для {{ config('app.name') }}

Используйте их для входа в систему

@component('mail::table')
  |   Логин   |   Пароль   |
  |:-----------|:------------|
  | {{ $user->email }} | {{ $password }} |
@endcomponent

@component('mail::button', ['url' => url('login')])
Войти
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
