@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Clique aqui para ativar a sua conta!
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
