<?php

namespace App\Http\Requests\Lecture;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLectureRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			'title' => 'required|string|max:255',
			'description' => 'nullable|string',
			'year' => 'required|string|max:10',
			'media' => 'nullable|string|max:255',
			'file' => 'nullable|string|max:255',
			'url' => 'nullable|string|max:255',
			'publish' => 'boolean',
		];
	}
}
