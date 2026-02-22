<?php

namespace App\Http\Controllers\Api;

use App\Actions\Press\DeleteAction as DeletePressAction;
use App\Actions\Press\StoreAction as StorePressAction;
use App\Actions\Press\UpdateAction as UpdatePressAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Press\StorePressRequest;
use App\Http\Requests\Press\UpdatePressRequest;
use App\Http\Resources\PressResource;
use App\Models\Press;
use Illuminate\Support\Facades\Storage;

class PressController extends Controller
{
	public function index()
	{
		$grouped = Press::with('project')->orderBy('year', 'desc')->get()->groupBy('year');

		return response()->json([
			'data' => $grouped->map(fn ($items) => PressResource::collection($items)),
		]);
	}

	public function store(StorePressRequest $request)
	{
		$press = (new StorePressAction)->execute($request->validated());

		return new PressResource($press->load('project'));
	}

	public function show(Press $press)
	{
		$press->load('project');

		return new PressResource($press);
	}

	public function update(UpdatePressRequest $request, Press $press)
	{
		$press = (new UpdatePressAction)->execute($press, $request->validated());

		return new PressResource($press->load('project'));
	}

	public function toggle(Press $press)
	{
		$press->update(['publish' => !$press->publish]);

		return new PressResource($press);
	}

	public function destroy(Press $press)
	{
		(new DeletePressAction)->execute($press);

		return response()->json(null, 204);
	}

	public function unlink(Press $press, string $field)
	{
		if (!in_array($field, ['media', 'file'])) {
			return response()->json(['message' => 'Invalid field'], 422);
		}

		if ($press->$field) {
			Storage::disk('public')->delete($press->$field);
			$press->update([$field => null]);
		}

		return new PressResource($press);
	}
}
