<?php

namespace App\Actions\Media;

use App\Models\Media;

class SetTeaserAction
{
	public function execute(Media $media): Media
	{
		// Unset all teasers for the same entity
		Media::where('mediable_type', $media->mediable_type)
			->where('mediable_id', $media->mediable_id)
			->update(['is_teaser' => false]);

		// Set the new teaser
		$media->update(['is_teaser' => true]);

		return $media;
	}
}
