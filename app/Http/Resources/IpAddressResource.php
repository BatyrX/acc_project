<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IpAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'ip_address' => $this->ip_address,
            'subnet' => $this->subnet,
            'mac_address' => $this->mac_address,
            'status' => $this->status,
            'user_id' => $this->user_id, 
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
