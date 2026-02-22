<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			'date' => 'nullable|string|max:50',
			'subtitle' => 'nullable|string|max:255',
			'title' => 'required|string|max:255',
			'text' => 'nullable|string',
			'link' => 'nullable|string|max:255',
			'link_text' => 'nullable|string|max:255',
			'media' => 'nullable|string|max:255',
		];
	}
}
