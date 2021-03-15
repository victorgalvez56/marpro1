<?php

namespace App\Models\Tenant;

use Illuminate\Support\Facades\Config;

class ConfigurationMailServer extends ModelTenant
{

    protected $fillable = [
        'name',
        'host',
        'port',
        'username',
        'password',
        'encryption',
        'driver',
        'protocol',
        'default_account',
        'validate_cert',
        'from_address',
        'from_name',
        'reply_address',
        'reply_name',
        'cc_address',
        'is_active'
    ];

    public static function setCustomerSMTP($server_smtp)
    {
        config([
            'mail' => [
                'host' => $server_smtp->host,
                'port' => $server_smtp->port,
                'username' => $server_smtp->username,
                'password' => $server_smtp->password,
                'encryption' => $server_smtp->encryption,
                'from' => [
                    'address' => $server_smtp->from_address,
                    'name' => $server_smtp->from_name,
                ],
                'reply_to' => [
                    'address' => $server_smtp->reply_address,
                    'name' => $server_smtp->reply_name,
                ],
                'driver' => $server_smtp->driver ? $server_smtp->driver : $server_smtp->name,
            ],
        ]);
    }

    public static function setDefaultSMTP()
    {
        config([
            'mail' => [
                'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
                'port' => env('MAIL_PORT', 587),
                'username' => env('MAIL_USERNAME'),
                'password' => env('MAIL_PASSWORD'),
                'encryption' => env('MAIL_ENCRYPTION', 'tls'),
                'from' => [
                    'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
                    'name' => env('MAIL_FROM_NAME', 'Example'),
                ],
                'reply_to' => [
                    'address' => env('MAIL_REPLY_ADDRESS', 'email@domain.com'),
                    'name' => env('MAIL_REPLY_NAME', 'Reply Name'),
                ],
                'driver' => env('MAIL_DRIVER', 'smtp'),
            ],
        ]);
    }
}
