<?php

namespace App\Http\Controllers\Api;

use App\Actions\Award\DeleteAction as DeleteAwardAction;
use App\Actions\Award\StoreAction as StoreAwardAction;
use App\Actions\Award\UpdateAction as UpdateAwardAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Award\StoreAwardRequest;
use App\Http\Requests\Award\UpdateAwardRequest;
use App\Http\Resources\AwardResource;
use App\Models\Award;
use Illuminate\Support\Facades\Storage;

class AwardController extends Controller
{
	public function index()
	{
		$grouped = Award::orderBy('year', 'desc')->get()->groupBy('year');

		return response()->json([
			'data' => $grouped->map(fn ($items) => AwardResource::collection($items)),
		]);
	}

	public function store(StoreAwardRequest $request)
	{
		$award = (new StoreAwardAction)->execute($request->validated());

		return new AwardResource($award);
	}

	public function show(Award $award)
	{
		return new AwardResource($award);
	}

	public function update(UpdateAwardRequest $request, Award $award)
	{
		$award = (new UpdateAwardAction)->execute($award, $request->validated());

		return new AwardResource($award);
	}

	public function toggle(Award $award)
	{
		$award->update(['publish' => !$award->publish]);

		return new AwardResource($award);
	}

	public function destroy(Award $award)
	{
		(new DeleteAwardAction)->execute($award);

		return response()->json(null, 204);
	}

	public function unlink(Award $award, string $field)
	{
		if (!in_array($field, ['media', 'file'])) {
			return response()->json(['message' => 'Invalid field'], 422);
		}

		if ($award->$field) {
			Storage::disk('public')->delete($award->$field);
			$award->update([$field => null]);
		}

		return new AwardResource($award);
	}
}
