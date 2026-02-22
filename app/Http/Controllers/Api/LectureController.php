<?php

namespace App\Http\Controllers\Api;

use App\Actions\Lecture\DeleteAction as DeleteLectureAction;
use App\Actions\Lecture\StoreAction as StoreLectureAction;
use App\Actions\Lecture\UpdateAction as UpdateLectureAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Lecture\StoreLectureRequest;
use App\Http\Requests\Lecture\UpdateLectureRequest;
use App\Http\Resources\LectureResource;
use App\Models\Lecture;
use Illuminate\Support\Facades\Storage;

class LectureController extends Controller
{
	public function index()
	{
		$grouped = Lecture::orderBy('year', 'desc')->get()->groupBy('year');

		return response()->json([
			'data' => $grouped->map(fn ($items) => LectureResource::collection($items)),
		]);
	}

	public function store(StoreLectureRequest $request)
	{
		$lecture = (new StoreLectureAction)->execute($request->validated());

		return new LectureResource($lecture);
	}

	public function show(Lecture $lecture)
	{
		return new LectureResource($lecture);
	}

	public function update(UpdateLectureRequest $request, Lecture $lecture)
	{
		$lecture = (new UpdateLectureAction)->execute($lecture, $request->validated());

		return new LectureResource($lecture);
	}

	public function toggle(Lecture $lecture)
	{
		$lecture->update(['publish' => !$lecture->publish]);

		return new LectureResource($lecture);
	}

	public function destroy(Lecture $lecture)
	{
		(new DeleteLectureAction)->execute($lecture);

		return response()->json(null, 204);
	}

	public function unlink(Lecture $lecture, string $field)
	{
		if (!in_array($field, ['media', 'file'])) {
			return response()->json(['message' => 'Invalid field'], 422);
		}

		if ($lecture->$field) {
			Storage::disk('public')->delete($lecture->$field);
			$lecture->update([$field => null]);
		}

		return new LectureResource($lecture);
	}
}
