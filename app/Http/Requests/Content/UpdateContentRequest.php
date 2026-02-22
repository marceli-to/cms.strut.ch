<?php

namespace App\Http\Requests\Content;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContentRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			'key' => 'required|string|max:255|unique:content,key,' . $this->route('content')->id,
			'title' => 'required|string|max:255',
			'text' => 'nullable|string',
			'media' => 'nullable|string|max:255',
			'publish' => 'boolean',
			'has_media' => 'boolean',
		];
	}
}
