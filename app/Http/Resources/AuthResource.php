<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($this->is_active == 1)
            $is_active = 'active';
        else
        $is_active = 'not active';

        // modify user data to a specified formal
        $data = [
            'name' => $this->name,
            'username'=> $this->username,
            'password' => $this->password,
            'is_active' => $is_active,
            // to get a link to the avatar image
            'avatar' => $this->getFirstMediaUrl('avatar'),
            'type' => $this->type,
        ];

        return $data;
    }
}
