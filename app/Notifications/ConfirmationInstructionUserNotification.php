<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use App\CoreBizag\Core\Common\Functions as FunctionsCoreBizag;

class ConfirmationInstructionUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $model, $token_data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($model, $token_data)
    {
        $this->model = $model;
        $this->token_data = $token_data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        FunctionsCoreBizag::changeMailSenderPurchaseSMTP();

        return (new MailMessage)
            ->success()
            ->from($this->model->establishment["email"], $this->model->company->name)
            ->subject('Instrucciones de confirmación')
            ->greeting("¡Gracias por registrarte en {$this->model->company->name}!")
            ->line('Para comenzar, haga clic en el enlace de abajo para confirmar su cuenta.')
            ->action('Confirme su cuenta', $this->resetUrl($notifiable));
    }


    /**
     * Get the reset password URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function resetUrl($notifiable)
    {
        // $appUrl = request()->headers->get('origin') . "/extranet";
        // return url("$appUrl/login/$this->token_data");
        $url = URL::signedRoute(
            'extranet.login',
            ['token_data' => Crypt::encryptString($this->token_data)]
        );

        return str_replace(url('/api/extranet'), url('/extranet'), $url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
