<?php

namespace App\Mail\Tenant;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\CoreBizag\Core\Common\FunctionsMailer;
use App\Models\Tenant\Company;
use App\Models\Tenant\Establishment;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    private $token;
    public $expire;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
        $this->expire = config('auth.passwords.users.expire');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $establishment = Establishment::first();
        $company = Company::active();
        $configuration_smtp = FunctionsMailer::getConfigurationSMTP($establishment->email, $company->name);
        $company_template = FunctionsMailer::getCompanyTemplate($company->number, 'reset_password');
        return $this->from($configuration_smtp['from_address'], $company->name)
            ->subject('Restablecer contraseña')
            ->to($this->email)
            ->markdown('tenant.templates.' . $company_template . '.email.reset_password')
            ->with([
                'urlNotification' => $this->resetUrl(),
            ])
            ->replyTo($configuration_smtp['reply_address'], $configuration_smtp['reply_name']);
    }

    /**
     * Get the reset password URL for the given notifiable.
     *
     * @param  mixed  
     * @return string
     */
    protected function resetUrl()
    {
        $appUrl = request()->headers->get('origin') . "/hcapital";
        return url("$appUrl/password/reset/$this->token") . '?email=' . urlencode($this->email);
    }
}
