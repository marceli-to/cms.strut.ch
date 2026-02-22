<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PressResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'project_id' => $this->project_id,
			'title' => $this->title,
			'description' => $this->description,
			'year' => $this->year,
			'url' => $this->url,
			'media' => $this->media,
			'file' => $this->file,
			'publish' => $this->publish,
			'project' => $this->whenLoaded('project'),
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		];
	}
}
