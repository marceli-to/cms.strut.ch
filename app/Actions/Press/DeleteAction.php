<?php

namespace App\Actions\Press;

use App\Models\Press;
use Illuminate\Support\Facades\Storage;

class DeleteAction
{
	public function execute(Press $press): void
	{
		if ($press->media) {
			Storage::disk('public')->delete($press->media);
		}

		if ($press->file) {
			Storage::disk('public')->delete($press->file);
		}

		$press->delete();
	}
}
