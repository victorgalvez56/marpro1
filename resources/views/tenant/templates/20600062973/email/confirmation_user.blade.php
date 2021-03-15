@component('mail::message')
# ¡Felicitaciones, usted ha confirmado su cuenta en {{$model->company->name}}!

Haga clic en el enlace de abajo para empezar el uso del portal.

@component('mail::button', ['url' => $urlNotification, 'color' => 'success'])
Ingresar al Portal
@endcomponent

Gracias,<br>
Saludos.

@endcomponent