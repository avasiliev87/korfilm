<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role_names' => $this->getRoleNames(),
            'created_at' => $this->created_at->diffForHumans(),
            'email_verified' => $this->hasVerifiedEmail(),
        ];
    }
}
