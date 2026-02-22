<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
			'info' => 'nullable|string',
			'url' => 'nullable|string|max:255',
			'media' => 'nullable|string|max:255',
			'order' => 'integer|min:0',
			'publish' => 'boolean',
		];
	}
}
