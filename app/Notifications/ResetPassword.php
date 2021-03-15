<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $expire = config('auth.passwords.users.expire');
        // $expiration_in_hours = $expire / 60;

        return (new MailMessage)
            ->from($notifiable->establishment->email, $notifiable->company->name)
            ->greeting('Hola!')
            ->subject('Restablecer contraseña')
            ->line('Recibió este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.')
            ->action('Restablecer contraseña', $this->resetUrl($notifiable))
            ->line("Este enlace de restablecimiento de contraseña caducará en {$expire} horas.")
            ->line('Si no solicitó un restablecimiento de contraseña, no se requiere ninguna otra acción.');
    }

    /**
     * Get the reset password URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function resetUrl($notifiable)
    {

        $appUrl = request()->headers->get('origin') . "/extranet";

        return url("$appUrl/password/reset/$this->token") . '?email=' . urlencode($notifiable->email);
    }
}
