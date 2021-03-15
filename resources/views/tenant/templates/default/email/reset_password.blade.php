@component('mail::message')
# ¡Hola, {{$model->name}}!

Recibió este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.

@component('mail::button', ['url' => $urlNotification, 'color' => 'success'])
Restablecer contraseña
@endcomponent

Este enlace de restablecimiento de contraseña caducará en {{$expire}} horas.

Si no solicitó un restablecimiento de contraseña, no se requiere ninguna otra acción.<br>

Gracias,<br>
Saludos.

@endcomponent