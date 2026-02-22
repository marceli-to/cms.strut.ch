<?php

namespace App\Actions\News;

use App\Models\News;
use Illuminate\Support\Facades\Storage;

class DeleteAction
{
	public function execute(News $news): void
	{
		if ($news->media) {
			Storage::disk('public')->delete($news->media);
		}

		$news->delete();
	}
}
