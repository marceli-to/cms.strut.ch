<?php

namespace App\Http\Requests\Press;

use Illuminate\Foundation\Http\FormRequest;

class StorePressRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			'project_id' => 'nullable|exists:projects,id',
			'title' => 'required|string|max:255',
			'description' => 'nullable|string',
			'year' => 'required|string|max:10',
			'url' => 'nullable|string|max:255',
			'media' => 'nullable|string|max:255',
			'file' => 'nullable|string|max:255',
			'publish' => 'boolean',
		];
	}
}
