@component('mail::message')
# ¡Gracias por registrarte en {{$model->company->name}}!

Para comenzar, haga clic en el enlace de abajo para confirmar su cuenta.

@component('mail::button', ['url' => $urlNotification, 'color' => 'success'])
Confirme su cuenta
@endcomponent

Gracias,<br>
Saludos.

@endcomponent