<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'title' => $this->title,
			'lead' => $this->lead,
			'info' => $this->info,
			'media' => $this->media,
			'order' => $this->order,
			'publish' => $this->publish,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
	}
}
