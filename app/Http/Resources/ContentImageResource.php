<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContentImageResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'content_id' => $this->content_id,
			'name' => $this->name,
			'caption' => $this->caption,
			'publish' => $this->publish,
			'order' => $this->order,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
	}
}
