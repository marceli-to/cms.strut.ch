<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LectureResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'title' => $this->title,
			'description' => $this->description,
			'year' => $this->year,
			'media' => $this->media,
			'file' => $this->file,
			'url' => $this->url,
			'publish' => $this->publish,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
	}
}
