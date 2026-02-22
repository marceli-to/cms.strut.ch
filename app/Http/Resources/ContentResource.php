<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'key' => $this->key,
			'title' => $this->title,
			'text' => $this->text,
			'media' => $this->media,
			'publish' => $this->publish,
			'has_media' => $this->has_media,
			'images' => ContentImageResource::collection($this->whenLoaded('images')),
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
	}
}
