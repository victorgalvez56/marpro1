@component('mail::message')
# Hola, {{$model->name}}

{{$model->company->name}} le envió este correo electrónico para que se registre en el portal de proveedores.

@component('mail::button', ['url' => $urlNotification, 'color' => 'success'])
Registrarse
@endcomponent

Este enlace de registro caducará en {{$expire}} horas.<br>

Gracias,<br>
Saludos.

@endcomponent