<?php

namespace App\Actions\Job;

use App\Models\Job;
use Illuminate\Support\Facades\Storage;

class DeleteAction
{
	public function execute(Job $job): void
	{
		if ($job->media) {
			Storage::disk('public')->delete($job->media);
		}

		$job->delete();
	}
}
