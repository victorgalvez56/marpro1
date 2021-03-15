<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ConfigurationMailServerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($row, $key) {
            return [
                'id' => $row->id,
                'name' => $row->name,
                'host' => $row->host,
                'port' => $row->port,
                'username' => $row->username,
                'password' => $row->password,
                'encryption' => $row->encryption,
                'driver' => $row->driver,
                'protocol' => $row->protocol,
                'default_account' => $row->default_account,
                'from_address' => $row->from_address,
                'from_name' => $row->from_name,
                'reply_address' => $row->reply_address,
                'reply_name' => $row->reply_name,
                'is_active' => $row->is_active,
                'validate_cert' => (bool) $row->validate_cert,
                'is_active' => (bool) $row->is_active,
            ];
        });
    }
}
