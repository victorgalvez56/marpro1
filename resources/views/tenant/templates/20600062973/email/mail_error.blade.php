@component('mail::message')
# Hola, {{$email}}

{{$company->name}} le envió este correo electrónico
porqué ocurrio un error al procesar su comprobante.<br>

Error: {{$error_content}}.<br>
Asunto del mensaje: {{$subject}}.<br>
Contenido del mensaje: {{$error_body}}.<br>

Gracias,<br>
Saludos.

@endcomponent