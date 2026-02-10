<?php

namespace App\Actions\Post;

use App\Actions\Media\DeleteAction as DeleteMediaAction;
use App\Models\Post;

class DeleteAction
{
	public function execute(Post $post): void
	{
		$deleteMedia = new DeleteMediaAction;

		foreach ($post->media as $media) {
			$deleteMedia->execute($media);
		}

		$post->delete();
	}
}
