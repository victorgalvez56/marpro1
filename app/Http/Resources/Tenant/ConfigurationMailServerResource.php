<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Resources\Json\JsonResource;

class ConfigurationMailServerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'host' => $this->host,
            'port' => $this->port,
            'username' => $this->username,
            'password' => $this->password,
            'encryption' => $this->encryption,
            'driver' => $this->driver,
            'protocol' => $this->protocol,
            'default_account' => $this->default_account,
            'from_address' => $this->from_address,
            'from_name' => $this->from_name,
            'reply_address' => $this->reply_address,
            'reply_name' => $this->reply_name,
            'is_active' => $this->is_active,
            'validate_cert' => (bool) $this->validate_cert,
            'is_active' => (bool) $this->is_active,

        ];
    }
}
