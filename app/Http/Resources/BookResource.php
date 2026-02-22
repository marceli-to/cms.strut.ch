<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'title' => $this->title,
			'description' => $this->description,
			'info' => $this->info,
			'url' => $this->url,
			'media' => $this->media,
			'order' => $this->order,
			'publish' => $this->publish,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
	}
}
