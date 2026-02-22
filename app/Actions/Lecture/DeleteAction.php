<?php

namespace App\Actions\Lecture;

use App\Models\Lecture;
use Illuminate\Support\Facades\Storage;

class DeleteAction
{
	public function execute(Lecture $lecture): void
	{
		if ($lecture->media) {
			Storage::disk('public')->delete($lecture->media);
		}

		if ($lecture->file) {
			Storage::disk('public')->delete($lecture->file);
		}

		$lecture->delete();
	}
}
