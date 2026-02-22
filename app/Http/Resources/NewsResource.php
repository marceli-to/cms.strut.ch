<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'date' => $this->date,
			'subtitle' => $this->subtitle,
			'title' => $this->title,
			'text' => $this->text,
			'link' => $this->link,
			'link_text' => $this->link_text,
			'media' => $this->media,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
	}
}
