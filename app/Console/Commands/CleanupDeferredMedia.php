<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CleanupDeferredMedia extends Command
{
	protected $signature = 'media:cleanup';

	protected $description = 'Delete temp upload files older than 24 hours';

	public function handle(): int
	{
		$disk = Storage::disk('public');
		$files = $disk->files('temp');
		$count = 0;

		foreach ($files as $file) {
			$lastModified = Carbon::createFromTimestamp($disk->lastModified($file));

			if ($lastModified->lt(now()->subHours(24))) {
				$disk->delete($file);
				$count++;
			}
		}

		$this->info("Deleted {$count} temp file(s).");

		return self::SUCCESS;
	}
}
