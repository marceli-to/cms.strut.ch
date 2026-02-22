<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamMemberResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'firstname' => $this->firstname,
			'role' => $this->role,
			'position' => $this->position,
			'phone' => $this->phone,
			'email' => $this->email,
			'cv' => $this->cv,
			'media' => $this->media,
			'order' => $this->order,
			'publish' => $this->publish,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
	}
}
