<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'mail'      => $this->mail,
            'last_name' => $this->last_name,
            'nick_name' => $this->nick_name,
            'firstnames' => $this->whenLoaded('firstnames', fn () => $this->firstnames->map(fn ($f) => [
                'first_name' => $f->first_name,
                'order'      => $f->order,
                'default'    => $f->default,
            ])),
            'voice'      => $this->whenLoaded('voice', fn () => [
                'id'    => $this->voice->id,
                'name'  => $this->voice->name,
                'group' => $this->voice->voiceGroup?->name,
            ]),
            'roles'      => $this->whenLoaded('roles', fn () => $this->roles->pluck('name')),
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
