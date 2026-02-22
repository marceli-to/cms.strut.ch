<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			'name' => 'required|string|max:255',
			'firstname' => 'required|string|max:255',
			'role' => 'nullable|string|max:255',
			'position' => 'nullable|string|max:255',
			'phone' => 'nullable|string|max:50',
			'email' => 'required|string|max:255',
			'cv' => 'nullable|string',
			'media' => 'nullable|string|max:255',
			'order' => 'integer|min:0',
			'publish' => 'boolean',
		];
	}
}
