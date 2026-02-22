<?php

namespace App\Actions\Award;

use App\Models\Award;
use Illuminate\Support\Facades\Storage;

class DeleteAction
{
	public function execute(Award $award): void
	{
		if ($award->media) {
			Storage::disk('public')->delete($award->media);
		}

		if ($award->file) {
			Storage::disk('public')->delete($award->file);
		}

		$award->delete();
	}
}
