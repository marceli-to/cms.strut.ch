<?php

namespace App\Http\Controllers\Api;

use App\Actions\News\DeleteAction as DeleteNewsAction;
use App\Actions\News\StoreAction as StoreNewsAction;
use App\Actions\News\UpdateAction as UpdateNewsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
	public function index()
	{
		$news = News::orderBy('created_at', 'desc')->get();

		return NewsResource::collection($news);
	}

	public function store(StoreNewsRequest $request)
	{
		$news = (new StoreNewsAction)->execute($request->validated());

		return new NewsResource($news);
	}

	public function show(News $news)
	{
		return new NewsResource($news);
	}

	public function update(UpdateNewsRequest $request, News $news)
	{
		$news = (new UpdateNewsAction)->execute($news, $request->validated());

		return new NewsResource($news);
	}

	public function destroy(News $news)
	{
		(new DeleteNewsAction)->execute($news);

		return response()->json(null, 204);
	}

	public function unlink(News $news)
	{
		if ($news->media) {
			Storage::disk('public')->delete($news->media);
			$news->update(['media' => null]);
		}

		return new NewsResource($news);
	}
}
