<?php

namespace App\Http\Requests\Job;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			'title' => 'required|string|max:255',
			'lead' => 'nullable|string',
			'info' => 'nullable|string',
			'media' => 'nullable|string|max:255',
			'order' => 'integer|min:0',
			'publish' => 'boolean',
		];
	}
}
