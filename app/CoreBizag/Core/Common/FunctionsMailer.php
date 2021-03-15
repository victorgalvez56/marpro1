<?php

namespace App\CoreBizag\Core\Common;

use App\Models\Tenant\ConfigurationMailServer;
use Illuminate\Support\Facades\Mail;
use \Swift_Mailer;
use \Swift_SmtpTransport;
use Throwable;
use Exception;

class FunctionsMailer
{

    #region config email 
    public static function getConfigurationSMTP($from_address = 'hello@example.com', $form_name = 'Example', $name_config = 'compras')
    {
        try {
            $configuration_mail_server_smtp = ConfigurationMailServer::where("name", $name_config)->where("is_active", true)->first();
            if ($configuration_mail_server_smtp) {
                return [
                    'from_address' => $configuration_mail_server_smtp->from_address ? $configuration_mail_server_smtp->from_address : env('MAIL_FROM_ADDRESS', $from_address),
                    'from_name' => $configuration_mail_server_smtp->from_name ? $configuration_mail_server_smtp->from_name : $form_name,
                    'reply_address' => $configuration_mail_server_smtp->reply_address ? $configuration_mail_server_smtp->reply_address : env('MAIL_REPLY_ADDRESS', $from_address),
                    'reply_name' => $configuration_mail_server_smtp->reply_name ? $configuration_mail_server_smtp->reply_name : $form_name,
                    'cc_address' => $configuration_mail_server_smtp->cc_address ? $configuration_mail_server_smtp->cc_address : 'hello@example.com',
                ];
            } else {

                return [
                    'from_address' => env('MAIL_FROM_ADDRESS', $from_address),
                    'from_name' => $form_name,
                    'reply_address' => env('MAIL_REPLY_ADDRESS', $from_address),
                    'reply_name' => $form_name,
                    'cc_address' => 'hello@example.com',
                ];
            }
        } catch (Throwable $th) {
            return false;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function getCompanyTemplate($company_number = null, $template)
    {
        $path_view_template = resource_path('views' . DIRECTORY_SEPARATOR . 'tenant' . DIRECTORY_SEPARATOR . 'templates');
        $path_template = $company_number . DIRECTORY_SEPARATOR . 'email' . DIRECTORY_SEPARATOR . $template;
        if (file_exists($path_view_template . DIRECTORY_SEPARATOR . $path_template . '.blade.php')) {
            return $company_number;
        }
        return 'default';
    }

    public static function changeMailSenderPurchaseSwiftMailer($name_config = 'compras')
    {
        try {
            $configuration_mail_server_smtp = ConfigurationMailServer::where("name", $name_config)->where("is_active", true)->first();
            if ($configuration_mail_server_smtp) {
                // Backup your default mailer
                $backup = Mail::getSwiftMailer();
                // Setup your gmail mailer
                $transport = new Swift_SmtpTransport(
                    $configuration_mail_server_smtp->host,
                    $configuration_mail_server_smtp->port,
                    $configuration_mail_server_smtp->encryption
                );
                $mail_sender = $configuration_mail_server_smtp->from_address ? $configuration_mail_server_smtp->from_address : $configuration_mail_server_smtp->username;
                $transport->setUsername($mail_sender);
                $transport->setPassword($configuration_mail_server_smtp->password);
                // Any other mailer configuration stuff needed...
                $mailer = new Swift_Mailer($transport);
                return [
                    'success' => true,
                    'mailer' => $mailer,
                    'backup' => $backup,
                ];
            } else {
                return [
                    'success' => false,
                    'mailer' => null,
                    'backup' => null,
                ];
            }
        } catch (Throwable $th) {
            return false;
        } catch (Exception $ex) {
            return false;
        }
    }
    #endregion

    #region methods for send email
    public static function sentMailModel($model_mailer)
    {
        Mail::send($model_mailer);
        sleep(15);
    }

    public static function sentMailModelTo($model_mailer, $email)
    {
        Mail::to($email)->send($model_mailer);
        sleep(15);
    }

    public static function sentMailSwiftMailerModel($swift_mailer, $swift_backup, $model_mailer)
    {
        Mail::setSwiftMailer($swift_mailer);
        Mail::send($model_mailer);
        sleep(15);
        Mail::setSwiftMailer($swift_backup);
    }


    public static function sentMailSwiftMailerModelTo($swift_mailer, $swift_backup, $model_mailer, $email)
    {
        Mail::setSwiftMailer($swift_mailer);
        Mail::to($email)->send($model_mailer);
        sleep(15);
        Mail::setSwiftMailer($swift_backup);
    }


    public static function sendMailerModel($model_mailer, $name_config = 'compras')
    {
        try {
            $change_mail = self::changeMailSenderPurchaseSwiftMailer($name_config);
            $change_mail['success'] ? self::sentMailSwiftMailerModel($change_mail['mailer'], $change_mail['backup'], $model_mailer) : self::sentMailModel($model_mailer);
            return true;
        } catch (Throwable $th) {
            return false;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function sendMailerModeTo($model_mailer, $email, $name_config = 'compras')
    {
        try {
            $change_mail = self::changeMailSenderPurchaseSwiftMailer($name_config);
            $change_mail['success'] ? self::sentMailSwiftMailerModelTo($change_mail['mailer'], $change_mail['backup'], $model_mailer, $email) : self::sentMailModelTo($model_mailer, $email);
            return true;
        } catch (Throwable $th) {
            return false;
        } catch (Exception $ex) {
            return false;
        }
    }
    #region

}
